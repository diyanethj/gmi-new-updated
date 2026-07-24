<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

abstract class Controller
{
    protected function render(string $view, array $data = [], ?string $layout = null): void
    {
        $viewFile = BASE_PATH . '/app/Views/' . $view . '.php';
        if (!is_file($viewFile)) {
            throw new \RuntimeException('View not found: ' . $view);
        }

        extract($data, EXTR_SKIP);

        if ($layout === null) {
            require $viewFile;
            return;
        }

        ob_start();
        require $viewFile;
        $content = (string) ob_get_clean();
        require BASE_PATH . '/app/Views/' . $layout . '.php';
    }

    protected function abort(int $status, string $message = 'Not found'): never
    {
        http_response_code($status);
        echo '<!doctype html><html><head><meta charset="utf-8"><title>' . e($status) . '</title></head><body style="font-family:Arial;padding:40px"><h1>' . e($status) . '</h1><p>' . e($message) . '</p></body></html>';
        exit;
    }
}
