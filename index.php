<?php
// Simple router untuk OpenLiteSpeed
$request = $_SERVER['REQUEST_URI'];

// Abaikan query string
$path = parse_url($request, PHP_URL_PATH);

// Jika root atau bukan file yang ada di public
if ($path === '/' || !file_exists(__DIR__ . '/public' . $path)) {
    // Arahkan ke Laravel
    require __DIR__ . '/public/index.php';
    exit;
}

// Jika file ada di public, serve langsung
$file = __DIR__ . '/public' . $path;
if (file_exists($file)) {
    // Set content type berdasarkan extension
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $mime_types = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
        'ico'  => 'image/x-icon',
        'ttf'  => 'font/ttf',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
    ];
    
    if (isset($mime_types[$ext])) {
        header('Content-Type: ' . $mime_types[$ext]);
    }
    
    readfile($file);
    exit;
}

// Fallback ke Laravel
require __DIR__ . '/public/index.php';