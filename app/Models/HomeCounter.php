<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class HomeCounter
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function all(): array
    {
        return $this->db->query(
            'SELECT * FROM homepage_counters ORDER BY sort_order ASC, id ASC'
        )->fetchAll();
    }

    public function updateValues(array $values, int $adminId): void
    {
        $statement = $this->db->prepare(
            'UPDATE homepage_counters
             SET counter_value = :counter_value,
                 updated_by = :updated_by,
                 updated_at = NOW()
             WHERE id = :id'
        );

        foreach ($values as $id => $value) {
            $statement->bindValue(':counter_value', $value, PDO::PARAM_INT);
            $statement->bindValue(':updated_by', $adminId, PDO::PARAM_INT);
            $statement->bindValue(':id', (int) $id, PDO::PARAM_INT);
            $statement->execute();
        }
    }
}
