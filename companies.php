<?php
declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

use Gmg\Events\Controllers\PublicCompanyController;
use Gmg\Events\Core\SchemaGuard;

try {
    SchemaGuard::requireTables(['website_companies']);
    (new PublicCompanyController())->index();
} catch (Throwable $exception) {
    error_log('Companies page failed: ' . $exception->getMessage());
    http_response_code(500);
    echo '<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Database Upgrade Required</title></head>';
    echo '<body style="margin:0;padding:40px;background:#f4f7fb;color:#102033;font-family:Arial,sans-serif">';
    echo '<div style="max-width:760px;margin:auto;padding:28px;border:1px solid #dfe7ef;border-radius:16px;background:#fff">';
    echo '<h1 style="margin-top:0;color:#20366c">Database upgrade required</h1>';
    echo '<p>Import <strong>database/companies_careers_company_name_upgrade.sql</strong> into the <strong>gmigroup</strong> database, then reload this page.</p>';
    echo '</div></body></html>';
}
