<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class Admin
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function findByLogin(string $login): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM admins WHERE username = :login OR email = :login LIMIT 1');
        $stmt->execute([':login' => trim($login)]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM admins WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    public function all(): array
    {
        return $this->db->query('SELECT id, username, email, role, is_active, last_login_at, created_at FROM admins ORDER BY created_at ASC')->fetchAll();
    }

    public function create(array $data, ?int $creatorId): int
    {
        $stmt = $this->db->prepare('INSERT INTO admins (username, email, password_hash, role, is_active, created_by, created_at, updated_at)
                                    VALUES (:username, :email, :password_hash, :role, 1, :created_by, NOW(), NOW())');
        $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role' => $data['role'],
            ':created_by' => $creatorId,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM admins WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    public function countSuperAdmins(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM admins WHERE role = 'super_admin' AND is_active = 1")->fetchColumn();
    }

    public function existsByUsernameOrEmail(string $username, string $email): bool
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM admins WHERE username = :username OR email = :email');
        $stmt->execute([':username' => $username, ':email' => $email]);
        return (int) $stmt->fetchColumn() > 0;
    }

    public function updatePasswordHash(int $id, string $hash): void
    {
        $stmt = $this->db->prepare('UPDATE admins SET password_hash = :hash, updated_at = NOW() WHERE id = :id');
        $stmt->execute([':hash' => $hash, ':id' => $id]);
    }

    public function markLogin(int $id): void
    {
        $stmt = $this->db->prepare('UPDATE admins SET last_login_at = NOW() WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }
}
