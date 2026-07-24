<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class EventImage
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function forEvent(int $eventId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM event_images WHERE event_id = :event_id ORDER BY sort_order ASC, id ASC');
        $stmt->execute([':event_id' => $eventId]);
        return $stmt->fetchAll();
    }

    public function insertMany(int $eventId, array $paths, int $startOrder = 1): void
    {
        if ($paths === []) {
            return;
        }
        $stmt = $this->db->prepare('INSERT INTO event_images (event_id, image_path, sort_order, created_at) VALUES (:event_id, :image_path, :sort_order, NOW())');
        foreach ($paths as $index => $path) {
            $stmt->execute([
                ':event_id' => $eventId,
                ':image_path' => $path,
                ':sort_order' => $startOrder + $index,
            ]);
        }
    }

    public function findByIds(int $eventId, array $ids): array
    {
        $ids = array_values(array_filter(array_map('intval', $ids), static fn(int $id): bool => $id > 0));
        if ($ids === []) {
            return [];
        }
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare("SELECT * FROM event_images WHERE event_id = ? AND id IN ({$placeholders})");
        $stmt->execute(array_merge([$eventId], $ids));
        return $stmt->fetchAll();
    }

    public function deleteIds(int $eventId, array $ids): void
    {
        $ids = array_values(array_filter(array_map('intval', $ids), static fn(int $id): bool => $id > 0));
        if ($ids === []) {
            return;
        }
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare("DELETE FROM event_images WHERE event_id = ? AND id IN ({$placeholders})");
        $stmt->execute(array_merge([$eventId], $ids));
    }

    public function updateOrders(int $eventId, array $orders): void
    {
        $stmt = $this->db->prepare('UPDATE event_images SET sort_order = :sort_order WHERE id = :id AND event_id = :event_id');
        foreach ($orders as $id => $order) {
            $value = max(1, min(9999, (int) $order));
            $stmt->execute([':sort_order' => $value, ':id' => (int) $id, ':event_id' => $eventId]);
        }
    }

    public function maxOrder(int $eventId): int
    {
        $stmt = $this->db->prepare('SELECT COALESCE(MAX(sort_order), 0) FROM event_images WHERE event_id = :event_id');
        $stmt->execute([':event_id' => $eventId]);
        return (int) $stmt->fetchColumn();
    }
}
