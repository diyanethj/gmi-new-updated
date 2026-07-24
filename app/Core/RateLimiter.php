<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

use PDO;

final class RateLimiter
{
    public function __construct(private readonly PDO $db)
    {
    }

    private function hash(string $value): string
    {
        return hash_hmac('sha256', text_lower(trim($value)), (string) config('app_key'));
    }

    public function tooManyAttempts(string $identifier, string $ip, int $maximum = 5, int $windowMinutes = 15): bool
    {
        $sql = 'SELECT COUNT(*) FROM login_attempts
                WHERE success = 0
                  AND attempted_at >= :cutoff
                  AND (identifier_hash = :identifier OR ip_hash = :ip)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':cutoff', date('Y-m-d H:i:s', time() - ($windowMinutes * 60)));
        $stmt->bindValue(':identifier', $this->hash($identifier));
        $stmt->bindValue(':ip', $this->hash($ip));
        $stmt->execute();
        return (int) $stmt->fetchColumn() >= $maximum;
    }

    public function record(string $identifier, string $ip, bool $success): void
    {
        $stmt = $this->db->prepare('INSERT INTO login_attempts (identifier_hash, ip_hash, success, attempted_at) VALUES (:identifier, :ip, :success, NOW())');
        $stmt->execute([
            ':identifier' => $this->hash($identifier),
            ':ip' => $this->hash($ip),
            ':success' => $success ? 1 : 0,
        ]);

        if (random_int(1, 20) === 1) {
            $this->db->exec('DELETE FROM login_attempts WHERE attempted_at < (NOW() - INTERVAL 30 DAY)');
        }
    }

    public function clear(string $identifier, string $ip): void
    {
        $stmt = $this->db->prepare('DELETE FROM login_attempts WHERE identifier_hash = :identifier AND ip_hash = :ip');
        $stmt->execute([
            ':identifier' => $this->hash($identifier),
            ':ip' => $this->hash($ip),
        ]);
    }
}
