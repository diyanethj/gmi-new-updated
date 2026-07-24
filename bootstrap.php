<?php
declare(strict_types=1);

use Gmg\Events\Core\Security;
use Gmg\Events\Core\Session;

if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__);
}

$GLOBALS['app_config'] = require BASE_PATH . '/config/app.php';
$GLOBALS['db_config'] = require BASE_PATH . '/config/database.php';

require BASE_PATH . '/app/helpers.php';

date_default_timezone_set((string) config('timezone', 'Asia/Colombo'));

spl_autoload_register(static function (string $class): void {
    $prefix = 'Gmg\\Events\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $file = BASE_PATH . '/app/' . str_replace('\\', '/', $relative) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

$logDirectory = BASE_PATH . '/storage/logs';
if (!is_dir($logDirectory)) {
    @mkdir($logDirectory, 0750, true);
}

ini_set('log_errors', '1');
ini_set('error_log', $logDirectory . '/php-error.log');
ini_set('display_errors', config('debug', false) ? '1' : '0');
error_reporting(E_ALL);

set_exception_handler(static function (Throwable $exception): void {
    error_log(sprintf(
        "[%s] %s in %s:%d\n%s\n",
        date('c'),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
        $exception->getTraceAsString()
    ));

    if (!headers_sent()) {
        http_response_code(500);
        header('Content-Type: text/html; charset=UTF-8');
    }

    if (config('debug', false)) {
        echo '<pre>' . e((string) $exception) . '</pre>';
        return;
    }

    echo '<!doctype html><html><head><meta charset="utf-8"><title>Server Error</title></head><body style="font-family:Arial;padding:40px"><h1>Something went wrong</h1><p>Please try again later.</p></body></html>';
});

Security::sendHeaders();
Session::start();
