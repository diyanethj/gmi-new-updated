<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class Event
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function published(): array
    {
        $sql = "SELECT e.*,
                       (SELECT COUNT(*) FROM event_images i WHERE i.event_id = e.id) AS gallery_count
                FROM events e
                WHERE e.status = 'published'
                ORDER BY CASE WHEN e.sort_order IS NULL THEN 1 ELSE 0 END ASC,
                         e.sort_order ASC,
                         e.event_date DESC,
                         e.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function latestPublished(int $limit = 3): array
    {
        $limit = max(1, min(12, $limit));
        $statement = $this->db->prepare(
            "SELECT e.*,
                    (SELECT COUNT(*) FROM event_images i WHERE i.event_id = e.id) AS gallery_count
             FROM events e
             WHERE e.status = 'published'
             ORDER BY e.event_date DESC, e.id DESC
             LIMIT :limit"
        );
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function adminAll(): array
    {
        $sql = "SELECT e.*,
                       (SELECT COUNT(*) FROM event_images i WHERE i.event_id = e.id) AS gallery_count,
                       a.username AS creator_username
                FROM events e
                LEFT JOIN admins a ON a.id = e.created_by
                ORDER BY CASE WHEN e.sort_order IS NULL THEN 1 ELSE 0 END ASC,
                         e.sort_order ASC,
                         e.event_date DESC,
                         e.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM events WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $event = $stmt->fetch();
        return $event ?: null;
    }

    public function findPublishedBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE slug = :slug AND status = 'published' LIMIT 1");
        $stmt->execute([':slug' => $slug]);
        $event = $stmt->fetch();
        return $event ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare('INSERT INTO events
            (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at)
            VALUES
            (:name, :slug, :event_date, :event_time, :company, :description, :main_image, :status, :sort_order, :created_by, :updated_by, NOW(), NOW())');
        $stmt->execute([
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':event_date' => $data['event_date'],
            ':event_time' => $data['event_time'] ?: null,
            ':company' => $data['company'],
            ':description' => $data['description'],
            ':main_image' => $data['main_image'],
            ':status' => $data['status'],
            ':sort_order' => $data['sort_order'],
            ':created_by' => $data['created_by'],
            ':updated_by' => $data['updated_by'],
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare('UPDATE events SET
            name = :name,
            event_date = :event_date,
            event_time = :event_time,
            company = :company,
            description = :description,
            main_image = :main_image,
            status = :status,
            sort_order = :sort_order,
            updated_by = :updated_by,
            updated_at = NOW()
            WHERE id = :id');
        $stmt->execute([
            ':name' => $data['name'],
            ':event_date' => $data['event_date'],
            ':event_time' => $data['event_time'] ?: null,
            ':company' => $data['company'],
            ':description' => $data['description'],
            ':main_image' => $data['main_image'],
            ':status' => $data['status'],
            ':sort_order' => $data['sort_order'],
            ':updated_by' => $data['updated_by'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM events WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    public function updateOrders(array $orders): void
    {
        $stmt = $this->db->prepare('UPDATE events SET sort_order = :sort_order, updated_at = NOW() WHERE id = :id');
        foreach ($orders as $id => $order) {
            $stmt->bindValue(':sort_order', $order, $order === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function slugExists(string $slug): bool
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM events WHERE slug = :slug');
        $stmt->execute([':slug' => $slug]);
        return (int) $stmt->fetchColumn() > 0;
    }

    public function counts(): array
    {
        $row = $this->db->query("SELECT COUNT(*) AS total,
            SUM(status = 'published') AS published,
            SUM(status = 'draft') AS drafts
            FROM events")->fetch();
        return [
            'total' => (int) ($row['total'] ?? 0),
            'published' => (int) ($row['published'] ?? 0),
            'drafts' => (int) ($row['drafts'] ?? 0),
        ];
    }
}
