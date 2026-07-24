<?php
declare(strict_types=1);

return [
    'host' => getenv('GMG_DB_HOST') ?: '127.0.0.1',
    'port' => getenv('GMG_DB_PORT') ?: '3306',
    'database' => getenv('GMG_DB_NAME') ?: 'gmg_events',
    'username' => getenv('GMG_DB_USER') ?: 'root',
    'password' => getenv('GMG_DB_PASS') ?: '',
    'charset' => 'utf8mb4',
];
