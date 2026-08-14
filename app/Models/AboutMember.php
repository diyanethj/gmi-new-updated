<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use InvalidArgumentException;
use PDO;

final class AboutMember
{
    private const TYPES = ['director', 'management'];

    public function __construct(private readonly PDO $db)
    {
    }

    public function activeByType(string $type): array
    {
        $this->assertType($type);
        $statement = $this->db->prepare(
            "SELECT * FROM about_members
             WHERE member_type = :member_type AND status = 'active'
             ORDER BY sort_order ASC, id ASC"
        );
        $statement->execute([':member_type' => $type]);
        return $statement->fetchAll();
    }

    public function adminByType(string $type): array
    {
        $this->assertType($type);
        $statement = $this->db->prepare(
            'SELECT m.*, a.username AS creator_username
             FROM about_members m
             LEFT JOIN admins a ON a.id = m.created_by
             WHERE m.member_type = :member_type
             ORDER BY m.sort_order ASC, m.id ASC'
        );
        $statement->execute([':member_type' => $type]);
        return $statement->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM about_members WHERE id = :id LIMIT 1');
        $statement->execute([':id' => $id]);
        $member = $statement->fetch();
        return $member ?: null;
    }

    public function create(array $data): int
    {
        $this->assertType((string) $data['member_type']);
        $statement = $this->db->prepare(
            'INSERT INTO about_members
             (member_type, name, position, image_path, status, sort_order, created_by, updated_by, created_at, updated_at)
             VALUES
             (:member_type, :name, :position, :image_path, :status, :sort_order, :created_by, :updated_by, NOW(), NOW())'
        );
        $statement->execute([
            ':member_type' => $data['member_type'],
            ':name' => $data['name'],
            ':position' => $data['position'],
            ':image_path' => $data['image_path'],
            ':status' => $data['status'],
            ':sort_order' => $data['sort_order'],
            ':created_by' => $data['created_by'],
            ':updated_by' => $data['updated_by'],
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $this->assertType((string) $data['member_type']);
        $statement = $this->db->prepare(
            'UPDATE about_members SET
                member_type = :member_type,
                name = :name,
                position = :position,
                image_path = :image_path,
                status = :status,
                sort_order = :sort_order,
                updated_by = :updated_by,
                updated_at = NOW()
             WHERE id = :id'
        );
        $statement->execute([
            ':member_type' => $data['member_type'],
            ':name' => $data['name'],
            ':position' => $data['position'],
            ':image_path' => $data['image_path'],
            ':status' => $data['status'],
            ':sort_order' => $data['sort_order'],
            ':updated_by' => $data['updated_by'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $statement = $this->db->prepare('DELETE FROM about_members WHERE id = :id');
        $statement->execute([':id' => $id]);
    }

    public function updateOrders(string $type, array $orders, int $adminId): void
    {
        $this->assertType($type);
        $statement = $this->db->prepare(
            'UPDATE about_members
             SET sort_order = :sort_order, updated_by = :updated_by, updated_at = NOW()
             WHERE id = :id AND member_type = :member_type'
        );
        foreach ($orders as $id => $order) {
            $statement->bindValue(':sort_order', (int) $order, PDO::PARAM_INT);
            $statement->bindValue(':updated_by', $adminId, PDO::PARAM_INT);
            $statement->bindValue(':id', (int) $id, PDO::PARAM_INT);
            $statement->bindValue(':member_type', $type, PDO::PARAM_STR);
            $statement->execute();
        }
    }

    public function countActiveByType(string $type): int
    {
        $this->assertType($type);
        $statement = $this->db->prepare(
            "SELECT COUNT(*) FROM about_members WHERE member_type = :member_type AND status = 'active'"
        );
        $statement->execute([':member_type' => $type]);
        return (int) $statement->fetchColumn();
    }

    private function assertType(string $type): void
    {
        if (!in_array($type, self::TYPES, true)) {
            throw new InvalidArgumentException('Invalid About page member type.');
        }
    }
}
