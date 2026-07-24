<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

final class Csrf
{
    public static function token(): string
    {
        $created = (int) ($_SESSION['_csrf_created'] ?? 0);
        if (empty($_SESSION['_csrf']) || (time() - $created) > 1800) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
            $_SESSION['_csrf_created'] = time();
        }
        return (string) $_SESSION['_csrf'];
    }

    public static function validate(?string $token): bool
    {
        $stored = $_SESSION['_csrf'] ?? '';
        return is_string($token) && is_string($stored) && $stored !== '' && hash_equals($stored, $token);
    }

    public static function requireValid(): void
    {
        if (!self::validate($_POST['_token'] ?? null)) {
            http_response_code(419);
            exit('The form session expired. Please go back, refresh the page, and try again.');
        }
    }
}
