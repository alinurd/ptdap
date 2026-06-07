#!/bin/bash
# =============================================================================
# setup-docker.sh — Jalankan sekali di folder project
# Usage: bash setup-docker.sh
# =============================================================================

set -e

PROJECT_DIR=$(pwd)
PROJECT_NAME=$(basename "$PROJECT_DIR")

echo "========================================"
echo " Setup Docker: $PROJECT_NAME"
echo " Folder: $PROJECT_DIR"
echo "========================================"
echo ""

# --- Tanya port ---
read -p "Port nginx (contoh: 8010): " NGINX_PORT
read -p "Nama database: " DB_NAME
read -p "Password MySQL root: " DB_PASS
echo ""

# --- Cek nama network infra ---
INFRA_NET=$(docker network ls --format '{{.Name}}' | grep infra | head -1)
if [ -z "$INFRA_NET" ]; then
    echo "[!] Infra network tidak ditemukan. Pastikan infra stack sudah jalan:"
    echo "    cd /data/project/docker/infra && docker compose up -d"
    exit 1
fi
echo "[✓] Infra network ditemukan: $INFRA_NET"
echo ""

# --- Buat struktur folder ---
mkdir -p docker/nginx/logs docker/php

# --- compose.yml ---
cat > compose.yml << EOF
name: ${PROJECT_NAME}

services:

  nginx:
    image: nginx:1.27-alpine
    container_name: ${PROJECT_NAME}-nginx
    restart: unless-stopped
    ports:
      - "${NGINX_PORT}:80"
    volumes:
      - ./:/var/www/html:ro
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf:ro
      - ./docker/nginx/logs:/var/log/nginx
    depends_on:
      - php
    networks:
      - project_net
      - infra_net

  php:
    build:
      context: ./docker/php
      dockerfile: Dockerfile
    container_name: ${PROJECT_NAME}-php
    restart: unless-stopped
    working_dir: /var/www/html
    volumes:
      - ./:/var/www/html
      - ./docker/php/php.ini:/usr/local/etc/php/conf.d/custom.ini:ro
    environment:
      DB_HOST: mysql8
      DB_PORT: 3306
      DB_DATABASE: ${DB_NAME}
      DB_USERNAME: root
      DB_PASSWORD: ${DB_PASS}
      REDIS_HOST: redis
      REDIS_PORT: 6379
    networks:
      - project_net
      - infra_net

  node:
    image: node:22-alpine
    container_name: ${PROJECT_NAME}-node
    working_dir: /var/www/html
    volumes:
      - ./:/var/www/html
    profiles:
      - tools
    networks:
      - project_net

networks:
  project_net:
    driver: bridge
    name: ${PROJECT_NAME}_net
  infra_net:
    external: true
    name: ${INFRA_NET}
EOF

# --- nginx config ---
cat > docker/nginx/default.conf << 'EOF'
server {
    listen 80;
    server_name _;
    root /var/www/html/public;
    index index.php index.html;
    charset utf-8;
    client_max_body_size 50M;

    access_log /var/log/nginx/access.log;
    error_log  /var/log/nginx/error.log warn;

    location ~* \.(jpg|jpeg|png|gif|ico|css|js|woff2?|ttf|svg|webp)$ {
        expires 30d;
        try_files $uri =404;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass   php:9000;
        fastcgi_index  index.php;
        include        fastcgi_params;
        fastcgi_param  SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param  PATH_INFO       $fastcgi_path_info;
        fastcgi_read_timeout 120;
    }

    location ~ /\.  { deny all; }
    location ~* \.(env|log|sh|sql|bak)$ { deny all; }
}
EOF

# --- PHP Dockerfile ---
cat > docker/php/Dockerfile << 'EOF'
FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    bash curl git unzip zip \
    libpng-dev libzip-dev oniguruma-dev \
    icu-dev freetype-dev libjpeg-turbo-dev libwebp-dev \
    linux-headers $PHPIZE_DEPS

RUN docker-php-ext-configure gd \
        --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo pdo_mysql mbstring zip bcmath intl exif gd pcntl opcache

RUN pecl install redis && docker-php-ext-enable redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN sed -i \
    -e 's/^listen = .*/listen = 9000/' \
    -e 's/^;clear_env = .*/clear_env = no/' \
    /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/html
EXPOSE 9000
CMD ["php-fpm"]
EOF

# --- php.ini ---
cat > docker/php/php.ini << 'EOF'
memory_limit        = 256M
max_execution_time  = 120
upload_max_filesize = 50M
post_max_size       = 50M
display_errors      = On
log_errors          = On
date.timezone       = Asia/Jakarta
opcache.enable      = 1
opcache.memory_consumption = 128
opcache.validate_timestamps = 1
EOF

echo "[✓] Semua file Docker berhasil dibuat"
echo ""

# --- Tanya langsung jalankan atau tidak ---
read -p "Jalankan docker compose sekarang? (y/n): " RUN_NOW
if [ "$RUN_NOW" != "y" ]; then
    echo ""
    echo "Untuk menjalankan nanti:"
    echo "  docker compose up -d --build"
    exit 0
fi

# =============================================================================
# BUILD & START CONTAINERS
# =============================================================================
echo ""
echo "[1/5] Building & starting containers..."
docker compose up -d --build

# Tunggu PHP container siap
echo ""
echo "      Menunggu PHP container siap..."
sleep 5

PHP_CONTAINER="${PROJECT_NAME}-php"

# =============================================================================
# COMPOSER
# =============================================================================
echo "[2/5] Composer install..."
if [ -d "vendor" ]; then
    echo "      vendor/ sudah ada, dilewati"
elif [ -f "composer.json" ]; then
    # Fix git safe directory
    docker exec "$PHP_CONTAINER" git config --global --add safe.directory /var/www/html 2>/dev/null || true
    docker exec "$PHP_CONTAINER" composer install --no-interaction --prefer-dist --no-audit
    echo "      [✓] Composer selesai"
else
    echo "      [!] composer.json tidak ditemukan, dilewati"
fi

# =============================================================================
# .ENV LARAVEL
# =============================================================================
echo ""
echo "[3/5] Setup Laravel .env..."
if [ ! -f ".env" ] && [ -f ".env.example" ]; then
    cp .env.example .env
    echo "      .env dibuat dari .env.example"
fi

if [ -f ".env" ]; then
    # Update nilai DB & Redis di .env Laravel
    sed -i "s|^DB_HOST=.*|DB_HOST=mysql8|"         .env
    sed -i "s|^DB_PORT=.*|DB_PORT=3306|"            .env
    sed -i "s|^DB_DATABASE=.*|DB_DATABASE=${DB_NAME}|" .env
    sed -i "s|^DB_USERNAME=.*|DB_USERNAME=root|"    .env
    sed -i "s|^DB_PASSWORD=.*|DB_PASSWORD=${DB_PASS}|" .env
    sed -i "s|^REDIS_HOST=.*|REDIS_HOST=redis|"     .env
    sed -i "s|^REDIS_PORT=.*|REDIS_PORT=6379|"      .env
    echo "      [✓] .env diupdate (DB, Redis)"
fi

# =============================================================================
# ARTISAN COMMANDS
# =============================================================================
echo ""
echo "[4/5] Menjalankan artisan commands..."

if [ -f "artisan" ]; then
    # Fix permissions storage & bootstrap/cache
    docker exec "$PHP_CONTAINER" chmod -R 775 storage bootstrap/cache
    docker exec "$PHP_CONTAINER" chown -R www-data:www-data storage bootstrap/cache
    echo "      [✓] permissions storage & bootstrap/cache"

    # Generate app key
    docker exec "$PHP_CONTAINER" php artisan key:generate --ansi
    echo "      [✓] key:generate"

    # Storage link
    docker exec "$PHP_CONTAINER" php artisan storage:link 2>/dev/null || true
    echo "      [✓] storage:link"

    # Migrate (tanya dulu)
    echo ""
    read -p "      Jalankan migrate? (y/n): " RUN_MIGRATE
    if [ "$RUN_MIGRATE" = "y" ]; then
        docker exec "$PHP_CONTAINER" php artisan migrate --force
        echo "      [✓] migrate selesai"
    fi

    # Optimize
    docker exec "$PHP_CONTAINER" php artisan optimize:clear
    echo "      [✓] optimize:clear"
else
    echo "      [!] bukan project Laravel, artisan dilewati"
fi

# =============================================================================
# NPM BUILD
# =============================================================================
echo "[5/5] NPM build..."
read -p "      Jalankan npm build? (y/n): " RUN_NPM
if [ "$RUN_NPM" = "y" ]; then
    if [ -f "package.json" ]; then
        docker compose run --rm node npm install
        docker compose run --rm node npm run build
        echo "      [✓] npm build selesai"
    else
        echo "      [!] package.json tidak ditemukan, dilewati"
    fi
else
    echo "      dilewati"
fi

# =============================================================================
# SELESAI
# =============================================================================
echo ""
echo "========================================"
echo " SELESAI!"
echo ""
echo " Akses : http://localhost:${NGINX_PORT}"
echo " Logs  : docker compose logs -f"
echo " Shell : docker exec -it ${PROJECT_NAME}-php bash"
echo "========================================"
