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
