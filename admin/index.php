<?php
declare(strict_types=1);

require dirname(__DIR__) . '/bootstrap.php';

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

use Gmg\Events\Controllers\Admin\AdminController;
use Gmg\Events\Controllers\Admin\ApplicationController;
use Gmg\Events\Controllers\Admin\AuthController;
use Gmg\Events\Controllers\Admin\AboutController;
use Gmg\Events\Controllers\Admin\CareerController;
use Gmg\Events\Controllers\Admin\CompanyController;
use Gmg\Events\Controllers\Admin\CounterController;
use Gmg\Events\Controllers\Admin\DashboardController;
use Gmg\Events\Controllers\Admin\EventController;
use Gmg\Events\Controllers\Admin\FooterContactController;
use Gmg\Events\Controllers\Admin\PartnerController;
use Gmg\Events\Controllers\Admin\PageBreadcrumbController;
use Gmg\Events\Core\SchemaGuard;

$action = (string) ($_GET['action'] ?? 'dashboard');
$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

$routes = [
    'GET' => [
        'login' => [AuthController::class, 'loginForm'],
        'dashboard' => [DashboardController::class, 'index'],

        'events' => [EventController::class, 'index'],
        'events-create' => [EventController::class, 'create'],
        'events-edit' => [EventController::class, 'edit'],

        'counters' => [CounterController::class, 'index'],

        // Footer contact settings
        'footer-contact' => [FooterContactController::class, 'index'],

        'partners' => [PartnerController::class, 'index'],
        'partners-create' => [PartnerController::class, 'create'],
        'partners-edit' => [PartnerController::class, 'edit'],

        'companies' => [CompanyController::class, 'index'],
        'companies-create' => [CompanyController::class, 'create'],
        'companies-edit' => [CompanyController::class, 'edit'],

        'about' => [AboutController::class, 'index'],

        // Central breadcrumb page-name editor
        'page-names' => [PageBreadcrumbController::class, 'index'],
        // Backward-compatible alias from the earlier About-only editor
        'about-breadcrumb' => [PageBreadcrumbController::class, 'index'],
        'about-directors' => [AboutController::class, 'directors'],
        'about-directors-create' => [AboutController::class, 'directorsCreate'],
        'about-directors-edit' => [AboutController::class, 'directorsEdit'],
        'about-management' => [AboutController::class, 'management'],
        'about-management-create' => [AboutController::class, 'managementCreate'],
        'about-management-edit' => [AboutController::class, 'managementEdit'],
        'about-teams' => [AboutController::class, 'teams'],
        'about-teams-create' => [AboutController::class, 'teamsCreate'],
        'about-teams-edit' => [AboutController::class, 'teamsEdit'],

        'careers-vacancies' => [CareerController::class, 'index'],
        'careers-vacancies-create' => [CareerController::class, 'create'],
        'careers-vacancies-edit' => [CareerController::class, 'edit'],
        'careers-applications' => [ApplicationController::class, 'index'],
        'careers-application-view' => [ApplicationController::class, 'view'],
        'careers-application-download' => [ApplicationController::class, 'download'],

        'admins' => [AdminController::class, 'index'],
        'admins-create' => [AdminController::class, 'create'],
        'admins-edit' => [AdminController::class, 'edit'],
    ],

    'POST' => [
        'login' => [AuthController::class, 'login'],
        'logout' => [AuthController::class, 'logout'],

        'events-store' => [EventController::class, 'store'],
        'events-update' => [EventController::class, 'update'],
        'events-delete' => [EventController::class, 'delete'],
        'events-order' => [EventController::class, 'order'],

        'counters-update' => [CounterController::class, 'update'],

        // Footer contact settings
        'footer-contact-update' => [FooterContactController::class, 'update'],

        'partners-store' => [PartnerController::class, 'store'],
        'partners-update' => [PartnerController::class, 'update'],
        'partners-delete' => [PartnerController::class, 'delete'],
        'partners-order' => [PartnerController::class, 'order'],

        'companies-store' => [CompanyController::class, 'store'],
        'companies-update' => [CompanyController::class, 'update'],
        'companies-delete' => [CompanyController::class, 'delete'],
        'companies-order' => [CompanyController::class, 'order'],

        // Central breadcrumb page-name editor
        'page-names-update' => [PageBreadcrumbController::class, 'update'],
        // Backward-compatible alias
        'about-breadcrumb-update' => [PageBreadcrumbController::class, 'update'],

        'about-directors-store' => [AboutController::class, 'directorsStore'],
        'about-directors-update' => [AboutController::class, 'directorsUpdate'],
        'about-directors-delete' => [AboutController::class, 'directorsDelete'],
        'about-directors-order' => [AboutController::class, 'directorsOrder'],

        'about-management-store' => [AboutController::class, 'managementStore'],
        'about-management-update' => [AboutController::class, 'managementUpdate'],
        'about-management-delete' => [AboutController::class, 'managementDelete'],
        'about-management-order' => [AboutController::class, 'managementOrder'],

        'about-teams-store' => [AboutController::class, 'teamsStore'],
        'about-teams-update' => [AboutController::class, 'teamsUpdate'],
        'about-teams-delete' => [AboutController::class, 'teamsDelete'],
        'about-teams-order' => [AboutController::class, 'teamsOrder'],

        'careers-vacancies-store' => [CareerController::class, 'store'],
        'careers-vacancies-update' => [CareerController::class, 'update'],
        'careers-vacancies-delete' => [CareerController::class, 'delete'],
        'careers-vacancies-order' => [CareerController::class, 'order'],
        'careers-application-delete' => [ApplicationController::class, 'delete'],

        'admins-store' => [AdminController::class, 'store'],
        'admins-update' => [AdminController::class, 'update'],
        'admins-delete' => [AdminController::class, 'delete'],
    ],
];

$route = $routes[$method][$action] ?? null;

if (!$route) {
    http_response_code(404);
    exit('Admin route not found.');
}

try {
    $baseTables = [
        'admins',
        'admin_permissions',
        'login_attempts',
        'audit_logs',
    ];

    $requiredTables = match (true) {
        $action === 'login'
            => ['admins', 'admin_permissions', 'login_attempts'],

        str_starts_with($action, 'counters')
            => array_merge($baseTables, ['homepage_counters']),

        str_starts_with($action, 'footer-contact')
            => array_merge($baseTables, ['footer_contact_settings']),

        str_starts_with($action, 'partners')
            => array_merge($baseTables, ['business_partners']),

        str_starts_with($action, 'companies')
            => array_merge($baseTables, ['website_companies']),

        (str_starts_with($action, 'page-names') || str_starts_with($action, 'about-breadcrumb'))
            => array_merge($baseTables, ['page_breadcrumb_settings']),

        str_starts_with($action, 'about')
            => array_merge($baseTables, ['about_members', 'about_teams']),

        str_starts_with($action, 'careers')
            => array_merge($baseTables, ['job_vacancies', 'job_applications']),

        str_starts_with($action, 'events')
            => array_merge($baseTables, ['events', 'event_images']),

        $action === 'dashboard'
            => array_merge(
                $baseTables,
                [
                    'events',
                    'event_images',
                    'homepage_counters',
                    'business_partners',
                    'website_companies',
                    'about_members',
                    'about_teams',
                    'job_vacancies',
                    'job_applications',
                ]
            ),

        default => $baseTables,
    };

    SchemaGuard::requireTables($requiredTables);

    if (str_starts_with($action, 'careers') || $action === 'dashboard') {
        SchemaGuard::requireColumns('job_vacancies', ['company_name']);
        SchemaGuard::requireColumns('job_applications', ['company_name']);
    }
} catch (Throwable $exception) {
    error_log('Admin schema preflight failed: ' . $exception->getMessage());
    http_response_code(500);

    $message = htmlspecialchars(
        $exception->getMessage(),
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );

    echo '<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Database Setup Required</title></head>';
    echo '<body style="margin:0;background:#f4f7fb;color:#102033;font-family:Arial,sans-serif;padding:40px"><div style="max-width:760px;margin:auto;background:#fff;border:1px solid #dfe7ef;border-radius:16px;padding:28px">';
    echo '<h1 style="margin-top:0;color:#20366c">Database setup required</h1><p>' . $message . '</p>';
    echo '<p>Make sure all required database upgrade SQL files have been imported, including the footer contact settings table.</p></div></body></html>';
    exit;
}

[$controllerClass, $controllerMethod] = $route;
$controller = new $controllerClass();
$controller->{$controllerMethod}();