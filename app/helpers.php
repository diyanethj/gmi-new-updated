<?php
declare(strict_types=1);

use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\Flash;

function config(?string $key = null, mixed $default = null): mixed
{
    $config = $GLOBALS['app_config'] ?? [];
    if ($key === null) {
        return $config;
    }
    return $config[$key] ?? $default;
}

function db_config(?string $key = null, mixed $default = null): mixed
{
    $config = $GLOBALS['db_config'] ?? [];
    if ($key === null) {
        return $config;
    }
    return $config[$key] ?? $default;
}


function text_length(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
}

function text_lower(string $value): string
{
    return function_exists('mb_strtolower') ? mb_strtolower($value, 'UTF-8') : strtolower($value);
}

function text_substr(string $value, int $start, ?int $length = null): string
{
    if (function_exists('mb_substr')) {
        return $length === null ? mb_substr($value, $start, null, 'UTF-8') : mb_substr($value, $start, $length, 'UTF-8');
    }
    return $length === null ? substr($value, $start) : substr($value, $start, $length);
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function base_url(string $path = ''): string
{
    $base = rtrim((string) config('base_url', ''), '/');
    $path = ltrim($path, '/');
    if ($base === '') {
        return $path === '' ? '/' : '/' . $path;
    }
    return $path === '' ? $base . '/' : $base . '/' . $path;
}

function asset_url(string $path): string
{
    if (preg_match('~^https?://~i', $path)) {
        return $path;
    }
    return base_url($path);
}

function admin_url(string $action = 'dashboard', array $params = []): string
{
    $query = array_merge(['action' => $action], $params);
    return base_url('admin/index.php') . '?' . http_build_query($query);
}

function redirect(string $url): never
{
    header('Location: ' . $url, true, 303);
    exit;
}

function csrf_field(): string
{
    return '<input type="hidden" name="_token" value="' . e(Csrf::token()) . '">';
}

function old(string $key, mixed $default = ''): mixed
{
    $values = $_SESSION['_old'] ?? [];
    return $values[$key] ?? $default;
}

function errors(string $key): array
{
    $errors = $_SESSION['_errors'] ?? [];
    return $errors[$key] ?? [];
}

function clear_form_state(): void
{
    unset($_SESSION['_old'], $_SESSION['_errors']);
}

function remember_form(array $old, array $errors): void
{
    $_SESSION['_old'] = $old;
    $_SESSION['_errors'] = $errors;
}

function flash(string $key, ?string $message = null): ?string
{
    if ($message !== null) {
        Flash::set($key, $message);
        return null;
    }
    return Flash::get($key);
}

function format_event_date(string $date): string
{
    $timestamp = strtotime($date);
    return $timestamp ? date('d F Y', $timestamp) : $date;
}

function excerpt(string $text, int $length = 185): string
{
    $clean = trim(preg_replace('/\s+/u', ' ', strip_tags($text)) ?? '');
    if (text_length($clean) <= $length) {
        return $clean;
    }
    return rtrim(text_substr($clean, 0, $length - 1)) . '…';
}

function description_paragraphs(string $description): array
{
    $parts = preg_split('/\R{2,}/u', trim($description)) ?: [];
    return array_values(array_filter(array_map('trim', $parts), static fn(string $item): bool => $item !== ''));
}
