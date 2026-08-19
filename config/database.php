<?php
declare(strict_types=1);

return [
    'host' => getenv('GMG_DB_HOST') ?: '127.0.0.1',
    'port' => getenv('GMG_DB_PORT') ?: '3306',
    'database' => getenv('GMG_DB_NAME') ?: 'u838229316_gmi_new',
    'username' => getenv('GMG_DB_USER') ?: 'u838229316_gmi_new',
    'password' => getenv('GMG_DB_PASS') ?: 'Gmigroup@2026#',
    'charset' => 'utf8mb4',
];
