<?php

// Prepare required temporary directories for Vercel serverless environment
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL')) {
    $storagePath = getenv('APP_STORAGE') ?: '/tmp/storage';
    $directories = [
        $storagePath . '/framework/views',
        $storagePath . '/framework/cache',
        $storagePath . '/framework/cache/data',
        $storagePath . '/framework/sessions',
        $storagePath . '/logs',
        $storagePath . '/app/public',
        '/tmp/bootstrap/cache',
        '/tmp/views',
    ];

    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }
}

// Forward Vercel serverless requests to Laravel public entry point
require __DIR__ . '/../public/index.php';
