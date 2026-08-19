<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class PageBreadcrumb
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function get(string $pageKey, string $defaultName = ''): array
    {
        $statement = $this->db->prepare(
            'SELECT page_key, page_name, updated_by, created_at, updated_at
             FROM page_breadcrumb_settings
             WHERE page_key = :page_key
             LIMIT 1'
        );
        $statement->execute([':page_key' => $pageKey]);

        $row = $statement->fetch();

        if (is_array($row)) {
            return $row;
        }

        return [
            'page_key' => $pageKey,
            'page_name' => $defaultName,
            'updated_by' => null,
            'created_at' => null,
            'updated_at' => null,
        ];
    }

    /**
     * @param array<string,string> $defaults
     * @return array<string,array<string,mixed>>
     */
    public function getMany(array $defaults): array
    {
        if ($defaults === []) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($defaults), '?'));
        $statement = $this->db->prepare(
            'SELECT page_key, page_name, updated_by, created_at, updated_at
             FROM page_breadcrumb_settings
             WHERE page_key IN (' . $placeholders . ')'
        );
        $statement->execute(array_keys($defaults));

        $rows = [];
        foreach ($statement->fetchAll() as $row) {
            if (is_array($row) && isset($row['page_key'])) {
                $rows[(string) $row['page_key']] = $row;
            }
        }

        $result = [];
        foreach ($defaults as $pageKey => $defaultName) {
            $result[$pageKey] = $rows[$pageKey] ?? [
                'page_key' => $pageKey,
                'page_name' => $defaultName,
                'updated_by' => null,
                'created_at' => null,
                'updated_at' => null,
            ];
        }

        return $result;
    }

    public function update(string $pageKey, string $pageName, int $adminId): void
    {
        $statement = $this->db->prepare(
            'INSERT INTO page_breadcrumb_settings
                (page_key, page_name, updated_by, created_at, updated_at)
             VALUES
                (:page_key, :page_name, :updated_by, NOW(), NOW())
             ON DUPLICATE KEY UPDATE
                page_name = VALUES(page_name),
                updated_by = VALUES(updated_by),
                updated_at = NOW()'
        );

        $statement->execute([
            ':page_key' => $pageKey,
            ':page_name' => $pageName,
            ':updated_by' => $adminId,
        ]);
    }
}
