<?php
declare(strict_types=1);

require dirname(__DIR__) . '/bootstrap.php';

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

use Gmg\Events\Controllers\Admin\AdminController;
use Gmg\Events\Controllers\Admin\AuthController;
use Gmg\Events\Controllers\Admin\DashboardController;
use Gmg\Events\Controllers\Admin\EventController;

$action = (string) ($_GET['action'] ?? 'dashboard');
$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

$routes = [
    'GET' => [
        'login' => [AuthController::class, 'loginForm'],
        'dashboard' => [DashboardController::class, 'index'],
        'events' => [EventController::class, 'index'],
        'events-create' => [EventController::class, 'create'],
        'events-edit' => [EventController::class, 'edit'],
        'admins' => [AdminController::class, 'index'],
    ],
    'POST' => [
        'login' => [AuthController::class, 'login'],
        'logout' => [AuthController::class, 'logout'],
        'events-store' => [EventController::class, 'store'],
        'events-update' => [EventController::class, 'update'],
        'events-delete' => [EventController::class, 'delete'],
        'events-order' => [EventController::class, 'order'],
        'admins-store' => [AdminController::class, 'store'],
        'admins-delete' => [AdminController::class, 'delete'],
    ],
];

$route = $routes[$method][$action] ?? null;
if (!$route) {
    http_response_code(404);
    exit('Admin route not found.');
}

[$controllerClass, $controllerMethod] = $route;
$controller = new $controllerClass();
$controller->{$controllerMethod}();
