<?php
declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

use Gmg\Events\Controllers\PublicCareerController;
use Gmg\Events\Core\SchemaGuard;

try {
    SchemaGuard::requireTables([
        'job_vacancies',
        'job_applications'
    ]);

    SchemaGuard::requireColumns(
        'job_vacancies',
        ['company_name']
    );

    SchemaGuard::requireColumns(
        'job_applications',
        ['company_name']
    );

    $controller = new PublicCareerController();

    /*
     * Main Careers page is primarily a landing page now.
     * POST support is kept for backward compatibility.
     */
    if (
        strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET')
        === 'POST'
    ) {
        $controller->apply();
    } else {
        $controller->index();
    }

} catch (Throwable $exception) {
    error_log(
        'Careers page failed: '
        . $exception->getMessage()
    );

    http_response_code(500);

    echo '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Database Upgrade Required</title>
</head>
<body style="font-family:Arial;padding:40px;background:#f4f7fb;color:#102033">
<div style="max-width:760px;margin:auto;background:#fff;padding:28px;border-radius:16px">
<h1 style="color:#20366c">Database upgrade required</h1>
<p>Import <strong>database/companies_careers_company_name_upgrade.sql</strong> into the <strong>gmigroup</strong> database, then reload the Careers page.</p>
</div>
</body>
</html>';
}