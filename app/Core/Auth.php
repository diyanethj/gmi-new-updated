<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

use Gmg\Events\Models\Admin;
use Gmg\Events\Models\AdminPermission;

final class Auth
{
    private static bool $checkedThisRequest = false;
    private static ?array $cachedUser = null;
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

        $permissions = $admin['role'] === 'super_admin'
            ? Permission::keys()
            : (new AdminPermission($db))->forAdmin((int) $admin['id']);

        $limiter->clear($login, $ip);
        Session::regenerate();
        $_SESSION['admin'] = [
            'id' => (int) $admin['id'],
            'username' => (string) $admin['username'],
            'email' => (string) $admin['email'],
            'role' => (string) $admin['role'],
            'permissions' => $permissions,
            'login_at' => time(),
            'last_activity' => time(),
            'ua_hash' => hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? ''),
            'verified_at' => time(),
        ];

        self::$checkedThisRequest = false;
        self::$cachedUser = null;
        $adminModel->markLogin((int) $admin['id']);
        AuditLogger::log('login', 'admin', (int) $admin['id']);
        return ['success' => true, 'message' => ''];
    }

    public static function check(): bool
    {
        if (self::$checkedThisRequest) {
            return self::$cachedUser !== null;
        }

        $admin = $_SESSION['admin'] ?? null;
        if (!is_array($admin) || empty($admin['id'])) {
            self::$checkedThisRequest = true;
            self::$cachedUser = null;
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

        $db = Database::connection();
        $record = (new Admin($db))->find((int) $admin['id']);
        if (!$record || !(bool) $record['is_active']) {
            self::logout();
            return false;
        }

        $_SESSION['admin']['username'] = (string) $record['username'];
        $_SESSION['admin']['email'] = (string) $record['email'];
        $_SESSION['admin']['role'] = (string) $record['role'];
        $_SESSION['admin']['permissions'] = $record['role'] === 'super_admin'
            ? Permission::keys()
            : (new AdminPermission($db))->forAdmin((int) $record['id']);
        $_SESSION['admin']['verified_at'] = $now;
        $_SESSION['admin']['last_activity'] = $now;
        self::$checkedThisRequest = true;
        self::$cachedUser = $_SESSION['admin'];
        return true;
    }

    public static function user(): ?array
    {
        return self::check() ? self::$cachedUser : null;
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

    /** @return list<string> */
    public static function permissions(): array
    {
        $user = self::user();
        return $user ? array_values(array_map('strval', $user['permissions'] ?? [])) : [];
    }

    public static function can(string $permission): bool
    {
        $user = self::user();
        if (!$user) {
            return false;
        }
        return $user['role'] === 'super_admin' || in_array($permission, $user['permissions'] ?? [], true);
    }

    public static function canAny(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (self::can((string) $permission)) {
                return true;
            }
        }
        return false;
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            flash('error', 'Please sign in to continue.');
            redirect(admin_url('login'));
        }
    }

    public static function requirePermission(string $permission): void
    {
        self::requireLogin();
        if (!self::can($permission)) {
            http_response_code(403);
            exit('You do not have permission to perform this action.');
        }
    }

    public static function requireSuperAdmin(): void
    {
        self::requireLogin();
        if (!self::isSuperAdmin()) {
            http_response_code(403);
            exit('This action is limited to super administrators.');
        }
    }

    public static function logout(): void
    {
        if (!empty($_SESSION['admin']['id'])) {
            AuditLogger::log('logout', 'admin', (int) $_SESSION['admin']['id']);
        }
        self::$checkedThisRequest = true;
        self::$cachedUser = null;
        Session::destroy();
    }
}
