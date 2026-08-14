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
        $login = trim($login);
        $stmt = $this->db->prepare(
            'SELECT * FROM admins
             WHERE username = :username_login OR email = :email_login
             LIMIT 1'
        );
        $stmt->execute([
            ':username_login' => $login,
            ':email_login' => $login,
        ]);
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
        return $this->db->query(
            'SELECT a.id, a.username, a.email, a.role, a.is_active, a.created_by,
                    a.last_login_at, a.created_at, creator.username AS creator_username
             FROM admins a
             LEFT JOIN admins creator ON creator.id = a.created_by
             ORDER BY a.created_at ASC'
        )->fetchAll();
    }

    public function createdBy(int $creatorId): array
    {
        $stmt = $this->db->prepare(
            'SELECT a.id, a.username, a.email, a.role, a.is_active, a.created_by,
                    a.last_login_at, a.created_at, creator.username AS creator_username
             FROM admins a
             LEFT JOIN admins creator ON creator.id = a.created_by
             WHERE a.created_by = :creator_id
             ORDER BY a.created_at ASC'
        );
        $stmt->execute([':creator_id' => $creatorId]);
        return $stmt->fetchAll();
    }

    public function create(array $data, ?int $creatorId): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO admins
             (username, email, password_hash, role, is_active, created_by, created_at, updated_at)
             VALUES (:username, :email, :password_hash, :role, :is_active, :created_by, NOW(), NOW())'
        );
        $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role' => $data['role'],
            ':is_active' => (int) ($data['is_active'] ?? 1),
            ':created_by' => $creatorId,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $fields = [
            'username = :username',
            'email = :email',
            'role = :role',
            'is_active = :is_active',
            'updated_at = NOW()',
        ];
        $params = [
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':role' => $data['role'],
            ':is_active' => (int) $data['is_active'],
            ':id' => $id,
        ];
        if (!empty($data['password'])) {
            $fields[] = 'password_hash = :password_hash';
            $params[':password_hash'] = password_hash((string) $data['password'], PASSWORD_DEFAULT);
        }
        $stmt = $this->db->prepare('UPDATE admins SET ' . implode(', ', $fields) . ' WHERE id = :id');
        $stmt->execute($params);
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

    public function existsByUsernameOrEmail(string $username, string $email, ?int $ignoreId = null): bool
    {
        $sql = 'SELECT COUNT(*) FROM admins WHERE (username = :username OR email = :email)';
        $params = [':username' => $username, ':email' => $email];
        if ($ignoreId !== null) {
            $sql .= ' AND id <> :ignore_id';
            $params[':ignore_id'] = $ignoreId;
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetchColumn() > 0;
    }

    public function canBeManagedBy(array $target, int $managerId, bool $managerIsSuper): bool
    {
        return $managerIsSuper || ((int) ($target['created_by'] ?? 0) === $managerId && $target['role'] !== 'super_admin');
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
