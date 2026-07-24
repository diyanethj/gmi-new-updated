<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

use Gmg\Events\Models\Admin;

final class Auth
{
    public static function attempt(string $login, string $password): array
    {
        $login = trim($login);
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $db = Database::connection();
        $limiter = new RateLimiter($db);

        if ($limiter->tooManyAttempts($login, $ip)) {
            return ['success' => false, 'message' => 'Too many failed login attempts. Try again in 15 minutes.'];
        }

        $adminModel = new Admin($db);
        $admin = $adminModel->findByLogin($login);
        $valid = $admin && (bool) $admin['is_active'] && password_verify($password, (string) $admin['password_hash']);

        $limiter->record($login, $ip, $valid);

        if (!$valid) {
            usleep(random_int(150000, 350000));
            return ['success' => false, 'message' => 'Invalid login details.'];
        }

        if (password_needs_rehash((string) $admin['password_hash'], PASSWORD_DEFAULT)) {
            $adminModel->updatePasswordHash((int) $admin['id'], password_hash($password, PASSWORD_DEFAULT));
        }

        $limiter->clear($login, $ip);
        Session::regenerate();
        $_SESSION['admin'] = [
            'id' => (int) $admin['id'],
            'username' => (string) $admin['username'],
            'email' => (string) $admin['email'],
            'role' => (string) $admin['role'],
            'login_at' => time(),
            'last_activity' => time(),
            'ua_hash' => hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? ''),
            'verified_at' => time(),
        ];

        $adminModel->markLogin((int) $admin['id']);
        AuditLogger::log('login', 'admin', (int) $admin['id']);
        return ['success' => true, 'message' => ''];
    }

    public static function check(): bool
    {
        $admin = $_SESSION['admin'] ?? null;
        if (!is_array($admin) || empty($admin['id'])) {
            return false;
        }

        $now = time();
        $lastActivity = (int) ($admin['last_activity'] ?? 0);
        $loginAt = (int) ($admin['login_at'] ?? 0);
        $uaHash = hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? '');

        if (!hash_equals((string) ($admin['ua_hash'] ?? ''), $uaHash)
            || ($now - $lastActivity) > (int) config('session_idle_timeout', 1800)
            || ($now - $loginAt) > (int) config('session_absolute_timeout', 28800)) {
            self::logout();
            return false;
        }

        $record = (new Admin(Database::connection()))->find((int) $admin['id']);
        if (!$record || !(bool) $record['is_active']) {
            self::logout();
            return false;
        }

        $_SESSION['admin']['username'] = (string) $record['username'];
        $_SESSION['admin']['email'] = (string) $record['email'];
        $_SESSION['admin']['role'] = (string) $record['role'];
        $_SESSION['admin']['verified_at'] = $now;
        $_SESSION['admin']['last_activity'] = $now;
        return true;
    }

    public static function user(): ?array
    {
        return self::check() ? $_SESSION['admin'] : null;
    }

    public static function id(): ?int
    {
        $user = self::user();
        return $user ? (int) $user['id'] : null;
    }

    public static function isSuperAdmin(): bool
    {
        $user = self::user();
        return $user && $user['role'] === 'super_admin';
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            flash('error', 'Please sign in to continue.');
            redirect(admin_url('login'));
        }
    }

    public static function requireSuperAdmin(): void
    {
        self::requireLogin();
        if (!self::isSuperAdmin()) {
            http_response_code(403);
            exit('You do not have permission to manage administrators.');
        }
    }

    public static function logout(): void
    {
        if (!empty($_SESSION['admin']['id'])) {
            AuditLogger::log('logout', 'admin', (int) $_SESSION['admin']['id']);
        }
        Session::destroy();
    }
}
