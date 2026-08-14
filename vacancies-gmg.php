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

    if (
        strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET')
        === 'POST'
    ) {
        /*
         * Employee page accepts GMG vacancies only.
         */
        $controller->apply('GMG');
    } else {
        $controller->employee();
    }

} catch (Throwable $exception) {
    error_log(
        'Employee careers page failed: '
        . $exception->getMessage()
    );

    http_response_code(500);

    echo '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Careers Error</title>
</head>
<body style="font-family:Arial;padding:40px;background:#f4f7fb;color:#102033">
<div style="max-width:760px;margin:auto;background:#fff;padding:28px;border-radius:16px">
<h1 style="color:#20366c">Unable to load Employee Careers</h1>
<p>Please try again later.</p>
</div>
</body>
</html>';
}