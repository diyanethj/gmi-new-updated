<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class AboutTeam
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function active(): array
    {
        return $this->db->query(
            "SELECT * FROM about_teams
             WHERE status = 'active'
             ORDER BY sort_order ASC, id ASC"
        )->fetchAll();
    }

    public function adminAll(): array
    {
        return $this->db->query(
            'SELECT t.*, a.username AS creator_username
             FROM about_teams t
             LEFT JOIN admins a ON a.id = t.created_by
             ORDER BY t.sort_order ASC, t.id ASC'
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM about_teams WHERE id = :id LIMIT 1');
        $statement->execute([':id' => $id]);
        $team = $statement->fetch();
        return $team ?: null;
    }

    public function create(array $data): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO about_teams
             (company_name, image_path, status, sort_order, created_by, updated_by, created_at, updated_at)
             VALUES
             (:company_name, :image_path, :status, :sort_order, :created_by, :updated_by, NOW(), NOW())'
        );
        $statement->execute([
            ':company_name' => $data['company_name'],
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
        $statement = $this->db->prepare(
            'UPDATE about_teams SET
                company_name = :company_name,
                image_path = :image_path,
                status = :status,
                sort_order = :sort_order,
                updated_by = :updated_by,
                updated_at = NOW()
             WHERE id = :id'
        );
        $statement->execute([
            ':company_name' => $data['company_name'],
            ':image_path' => $data['image_path'],
            ':status' => $data['status'],
            ':sort_order' => $data['sort_order'],
            ':updated_by' => $data['updated_by'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $statement = $this->db->prepare('DELETE FROM about_teams WHERE id = :id');
        $statement->execute([':id' => $id]);
    }

    public function updateOrders(array $orders, int $adminId): void
    {
        $statement = $this->db->prepare(
            'UPDATE about_teams
             SET sort_order = :sort_order, updated_by = :updated_by, updated_at = NOW()
             WHERE id = :id'
        );
        foreach ($orders as $id => $order) {
            $statement->bindValue(':sort_order', (int) $order, PDO::PARAM_INT);
            $statement->bindValue(':updated_by', $adminId, PDO::PARAM_INT);
            $statement->bindValue(':id', (int) $id, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public function countActive(): int
    {
        return (int) $this->db->query(
            "SELECT COUNT(*) FROM about_teams WHERE status = 'active'"
        )->fetchColumn();
    }
}
