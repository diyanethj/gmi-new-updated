<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class BusinessPartner
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function active(): array
    {
        return $this->db->query(
            "SELECT * FROM business_partners
             WHERE status = 'active'
             ORDER BY sort_order ASC, id ASC"
        )->fetchAll();
    }

    public function adminAll(): array
    {
        return $this->db->query(
            'SELECT p.*, a.username AS creator_username
             FROM business_partners p
             LEFT JOIN admins a ON a.id = p.created_by
             ORDER BY p.sort_order ASC, p.id ASC'
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare(
            'SELECT * FROM business_partners WHERE id = :id LIMIT 1'
        );
        $statement->execute([':id' => $id]);
        $partner = $statement->fetch();
        return $partner ?: null;
    }

    public function create(array $data): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO business_partners
             (name, alt_text, website_url, image_path, status, sort_order, created_by, updated_by, created_at, updated_at)
             VALUES
             (:name, :alt_text, :website_url, :image_path, :status, :sort_order, :created_by, :updated_by, NOW(), NOW())'
        );
        $statement->execute([
            ':name' => $data['name'],
            ':alt_text' => $data['alt_text'],
            ':website_url' => $data['website_url'] ?: null,
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
            'UPDATE business_partners SET
                name = :name,
                alt_text = :alt_text,
                website_url = :website_url,
                image_path = :image_path,
                status = :status,
                sort_order = :sort_order,
                updated_by = :updated_by,
                updated_at = NOW()
             WHERE id = :id'
        );
        $statement->execute([
            ':name' => $data['name'],
            ':alt_text' => $data['alt_text'],
            ':website_url' => $data['website_url'] ?: null,
            ':image_path' => $data['image_path'],
            ':status' => $data['status'],
            ':sort_order' => $data['sort_order'],
            ':updated_by' => $data['updated_by'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $statement = $this->db->prepare('DELETE FROM business_partners WHERE id = :id');
        $statement->execute([':id' => $id]);
    }

    public function updateOrders(array $orders, int $adminId): void
    {
        $statement = $this->db->prepare(
            'UPDATE business_partners
             SET sort_order = :sort_order, updated_by = :updated_by, updated_at = NOW()
             WHERE id = :id'
        );
        foreach ($orders as $id => $order) {
            $statement->bindValue(':sort_order', $order, PDO::PARAM_INT);
            $statement->bindValue(':updated_by', $adminId, PDO::PARAM_INT);
            $statement->bindValue(':id', (int) $id, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public function countActive(): int
    {
        return (int) $this->db->query(
            "SELECT COUNT(*) FROM business_partners WHERE status = 'active'"
        )->fetchColumn();
    }
}
