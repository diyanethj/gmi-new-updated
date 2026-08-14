<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

use PDO;
use RuntimeException;

final class SchemaGuard
{
    /**
     * @param list<string> $requiredTables
     */
    public static function missingTables(array $requiredTables): array
    {
        if ($requiredTables === []) {
            return [];
        }

        $db = Database::connection();
        $database = (string) db_config('database');
        $placeholders = implode(',', array_fill(0, count($requiredTables), '?'));
        $sql = "SELECT TABLE_NAME
                FROM INFORMATION_SCHEMA.TABLES
                WHERE TABLE_SCHEMA = ?
                  AND TABLE_NAME IN ({$placeholders})";

        $statement = $db->prepare($sql);
        $statement->execute(array_merge([$database], $requiredTables));
        $existing = array_map(
            static fn(array $row): string => (string) $row['TABLE_NAME'],
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );

        return array_values(array_diff($requiredTables, $existing));
    }

    /**
     * @param list<string> $requiredTables
     */
    public static function requireTables(array $requiredTables): void
    {
        $missing = self::missingTables($requiredTables);
        if ($missing !== []) {
            throw new RuntimeException(
                'Database schema incomplete. Missing table(s): ' . implode(', ', $missing)
            );
        }
    }
    /**
     * @param list<string> $requiredColumns
     */
    public static function missingColumns(string $table, array $requiredColumns): array
    {
        if ($requiredColumns === []) {
            return [];
        }

        $db = Database::connection();
        $database = (string) db_config('database');
        $placeholders = implode(',', array_fill(0, count($requiredColumns), '?'));
        $sql = "SELECT COLUMN_NAME
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = ?
                  AND TABLE_NAME = ?
                  AND COLUMN_NAME IN ({$placeholders})";
        $statement = $db->prepare($sql);
        $statement->execute(array_merge([$database, $table], $requiredColumns));
        $existing = array_map(
            static fn(array $row): string => (string) $row['COLUMN_NAME'],
            $statement->fetchAll(PDO::FETCH_ASSOC)
        );
        return array_values(array_diff($requiredColumns, $existing));
    }

    /**
     * @param list<string> $requiredColumns
     */
    public static function requireColumns(string $table, array $requiredColumns): void
    {
        $missing = self::missingColumns($table, $requiredColumns);
        if ($missing !== []) {
            throw new RuntimeException(
                'Database schema incomplete. Missing column(s) in ' . $table . ': ' . implode(', ', $missing)
            );
        }
    }

}
