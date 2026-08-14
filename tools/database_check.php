<?php
declare(strict_types=1);

require dirname(__DIR__) . '/bootstrap.php';

use Gmg\Events\Core\Database;
use Gmg\Events\Core\SchemaGuard;

header('Content-Type: text/html; charset=UTF-8');
$required = ['admins', 'admin_permissions', 'events', 'event_images', 'homepage_counters', 'business_partners', 'website_companies', 'about_members', 'about_teams', 'job_vacancies', 'job_applications', 'login_attempts', 'audit_logs'];

try {
    $pdo = Database::connection();
    $missing = SchemaGuard::missingTables($required);
    $version = (string) $pdo->query('SELECT VERSION()')->fetchColumn();
    $missingVacancyColumns = SchemaGuard::missingColumns('job_vacancies', ['company_name']);
    $missingApplicationColumns = SchemaGuard::missingColumns('job_applications', ['company_name']);
    $database = (string) db_config('database');
} catch (Throwable $exception) {
    http_response_code(500);
    echo '<h1>Database connection failed</h1><pre>' . e($exception->getMessage()) . '</pre>';
    exit;
}
?>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>GMG Database Check</title>
<style>body{font-family:Arial,sans-serif;background:#f4f7fb;color:#102033;padding:30px}.card{max-width:760px;margin:auto;background:#fff;border:1px solid #dfe7ef;border-radius:16px;padding:25px}code{background:#eef3f8;padding:3px 6px;border-radius:5px}.ok{color:#067647}.bad{color:#b42318}</style></head><body><div class="card">
<h1>GMG Website Database Check</h1>
<p>Database: <code><?= e($database) ?></code></p>
<p>Server: <code><?= e($version) ?></code></p>
<?php if ($missing === []): ?>
<p class="ok"><strong>All required tables exist.</strong></p>
<?php if ($missingVacancyColumns !== [] || $missingApplicationColumns !== []): ?><p class="bad"><strong>Career company-name columns are missing.</strong></p><?php else: ?><p class="ok"><strong>Career company-name columns exist.</strong></p><?php endif; ?>
<?php else: ?>
<p class="bad"><strong>Missing:</strong> <?= e(implode(', ', $missing)) ?></p>
<p>Import <code>database/companies_careers_company_name_upgrade.sql</code>.</p>
<?php endif; ?>
<ul><?php foreach ($required as $table): ?><li><?= e($table) ?> — <?= in_array($table, $missing, true) ? '<span class="bad">missing</span>' : '<span class="ok">available</span>' ?></li><?php endforeach; ?></ul>
<p>Delete or block this diagnostic file after setup.</p>
</div></body></html>
