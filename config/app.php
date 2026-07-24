<?php
declare(strict_types=1);

return [
    'name' => 'Global Marine Group Events',
    'base_url' => '', // Example: '/gmg' when installed in a subfolder. Leave blank at domain root.
    'timezone' => 'Asia/Colombo',
    'debug' => false,
    'app_key' => '1668d9bd41f8eae2edd0bb13bea6d1707eea2b7fd07c6134c38cd8a63bfad690', // Change in production.
    'session_name' => 'gmg_events_admin',
    'session_idle_timeout' => 1800,
    'session_absolute_timeout' => 28800,
    'upload_directory' => dirname(__DIR__) . '/uploads/events',
    'upload_public_prefix' => 'uploads/events',
    'max_image_bytes' => 8 * 1024 * 1024,
    'max_gallery_images' => 40,
];
