<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

use Gmg\Events\Core\Database;
use Gmg\Events\Models\FooterContact;

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

$defaults = [
    'address' => '292 R. A. De Mel Mawatha, Colombo, Sri Lanka',
    'phone' => '+94 11 2 345 678',
    'email' => 'info@gmigroup.lk',
    'office_hours' => 'Mon - Fri: 8:30 AM - 5:30 PM',
    'linkedin_url' => null,
    'facebook_url' => null,
    'instagram_url' => null,
    'tiktok_url' => null,
    'youtube_url' => null,
];

try {
    $data = (new FooterContact(Database::connection()))->get();

    echo json_encode(
        [
            'success' => true,
            'data' => array_merge($defaults, is_array($data) ? $data : []),
        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
} catch (Throwable $exception) {
    error_log('Public footer contact endpoint failed: ' . $exception->getMessage());

    echo json_encode(
        [
            'success' => true,
            'data' => $defaults,
        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
}