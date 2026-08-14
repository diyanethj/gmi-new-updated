<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class AdminPermission
{
    public function __construct(private readonly PDO $db)
    {
    }

    /** @return list<string> */
    public function forAdmin(int $adminId): array
    {
        $statement = $this->db->prepare('SELECT permission_key FROM admin_permissions WHERE admin_id = :admin_id ORDER BY permission_key');
        $statement->execute([':admin_id' => $adminId]);
        return array_map('strval', $statement->fetchAll(PDO::FETCH_COLUMN));
    }

    /** @param list<string> $permissions */
    public function replace(int $adminId, array $permissions, ?int $grantedBy): void
    {
        $this->db->beginTransaction();
        try {
            $delete = $this->db->prepare('DELETE FROM admin_permissions WHERE admin_id = :admin_id');
            $delete->execute([':admin_id' => $adminId]);

            if ($permissions !== []) {
                $insert = $this->db->prepare(
                    'INSERT INTO admin_permissions (admin_id, permission_key, granted_by, created_at)
                     VALUES (:admin_id, :permission_key, :granted_by, NOW())'
                );
                foreach ($permissions as $permission) {
                    $insert->execute([
                        ':admin_id' => $adminId,
                        ':permission_key' => $permission,
                        ':granted_by' => $grantedBy,
                    ]);
                }
            }
            $this->db->commit();
        } catch (\Throwable $exception) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $exception;
        }
    }
}
