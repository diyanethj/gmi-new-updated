<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

use Gmg\Events\Core\Database;
use Gmg\Events\Models\PageBreadcrumb;

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

$defaults = [
    'about-us' => 'About Us',
    'companies' => 'Our Companies',
    'events' => 'Events',
    'careers' => 'Careers @ Global Marine Group',
    'join-employee' => 'Join as Employee',
    'join-crew' => 'Join as Crew',
    'contact-us' => 'Contact Us',
];

try {
    $settings = (new PageBreadcrumb(Database::connection()))->getMany($defaults);
    $data = [];

    foreach ($defaults as $pageKey => $defaultName) {
        $name = trim((string) ($settings[$pageKey]['page_name'] ?? $defaultName));
        $data[$pageKey] = $name !== '' ? $name : $defaultName;
    }

    echo json_encode(
        ['success' => true, 'data' => $data],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
} catch (Throwable $exception) {
    error_log('Public page-names endpoint failed: ' . $exception->getMessage());

    echo json_encode(
        ['success' => true, 'data' => $defaults],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
}