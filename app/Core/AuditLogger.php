<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

final class AuditLogger
{
    public static function log(string $action, string $entityType, ?int $entityId = null, array $metadata = []): void
    {
        try {
            $db = Database::connection();
            $stmt = $db->prepare('INSERT INTO audit_logs (admin_id, action, entity_type, entity_id, metadata_json, ip_hash, created_at)
                                  VALUES (:admin_id, :action, :entity_type, :entity_id, :metadata, :ip_hash, NOW())');
            $stmt->execute([
                ':admin_id' => $_SESSION['admin']['id'] ?? null,
                ':action' => text_substr($action, 0, 80),
                ':entity_type' => text_substr($entityType, 0, 80),
                ':entity_id' => $entityId,
                ':metadata' => $metadata === [] ? null : json_encode($metadata, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                ':ip_hash' => hash_hmac('sha256', $_SERVER['REMOTE_ADDR'] ?? 'unknown', (string) config('app_key')),
            ]);
        } catch (\Throwable $exception) {
            error_log('Audit log failed: ' . $exception->getMessage());
        }
    }
}
