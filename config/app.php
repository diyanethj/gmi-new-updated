<?php
declare(strict_types=1);

return [
    'name' => 'Global Marine Group Website Admin',
    'base_url' => '/gmigroup', // Example: '/gmg' when installed in a subfolder. Leave blank at domain root.
    'timezone' => 'Asia/Colombo',
    'debug' => false,
    'app_key' => '1668d9bd41f8eae2edd0bb13bea6d1707eea2b7fd07c6134c38cd8a63bfad690', // Change in production.
    'session_name' => 'gmigroup_admin',
    'session_idle_timeout' => 1800,
    'session_absolute_timeout' => 28800,
    'upload_directory' => dirname(__DIR__) . '/uploads/events',
    'upload_public_prefix' => 'uploads/events',
    'max_image_bytes' => 8 * 1024 * 1024,
    'max_gallery_images' => 40,
    'partner_upload_directory' => dirname(__DIR__) . '/uploads/partners',
    'partner_upload_public_prefix' => 'uploads/partners',
    'company_upload_directory' => dirname(__DIR__) . '/uploads/companies',
    'company_upload_public_prefix' => 'uploads/companies',
    'about_member_upload_directory' => dirname(__DIR__) . '/uploads/about-members',
    'about_member_upload_public_prefix' => 'uploads/about-members',
    'about_team_upload_directory' => dirname(__DIR__) . '/uploads/about-teams',
    'about_team_upload_public_prefix' => 'uploads/about-teams',
    'cv_upload_directory' => dirname(__DIR__) . '/uploads/cv',
    'cv_upload_public_prefix' => 'uploads/cv',
    'max_cv_bytes' => 5 * 1024 * 1024,
];
