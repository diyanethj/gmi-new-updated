<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class JobApplication
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function all(): array
    {
        return $this->db->query(
            'SELECT ja.*, v.position AS current_vacancy_position, v.company_name AS current_company_name
             FROM job_applications ja
             LEFT JOIN job_vacancies v ON v.id = ja.vacancy_id
             ORDER BY ja.created_at DESC, ja.id DESC'
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT ja.*, v.position AS current_vacancy_position, v.company_name AS current_company_name
             FROM job_applications ja
             LEFT JOIN job_vacancies v ON v.id = ja.vacancy_id
             WHERE ja.id = :id LIMIT 1'
        );
        $stmt->execute([':id' => $id]);
        $record = $stmt->fetch();
        return $record ?: null;
    }


    public function hasRecentSubmission(string $ipHash, int $vacancyId): bool
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) FROM job_applications
             WHERE ip_hash = :ip_hash AND vacancy_id = :vacancy_id
               AND created_at >= DATE_SUB(NOW(), INTERVAL 2 MINUTE)'
        );
        $stmt->execute([':ip_hash' => $ipHash, ':vacancy_id' => $vacancyId]);
        return (int) $stmt->fetchColumn() > 0;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO job_applications
             (vacancy_id, vacancy_position, company, company_name, applicant_name, email, phone, cv_path, original_cv_name, cv_mime, cv_size, ip_hash, created_at)
             VALUES (:vacancy_id, :vacancy_position, :company, :company_name, :applicant_name, :email, :phone, :cv_path, :original_cv_name, :cv_mime, :cv_size, :ip_hash, NOW())'
        );
        $stmt->execute([
            ':vacancy_id' => $data['vacancy_id'],
            ':vacancy_position' => $data['vacancy_position'],
            ':company' => $data['company'],
            ':company_name' => $data['company_name'],
            ':applicant_name' => $data['applicant_name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':cv_path' => $data['cv_path'],
            ':original_cv_name' => $data['original_cv_name'],
            ':cv_mime' => $data['cv_mime'],
            ':cv_size' => $data['cv_size'],
            ':ip_hash' => $data['ip_hash'],
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM job_applications WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    public function count(): int
    {
        return (int) $this->db->query('SELECT COUNT(*) FROM job_applications')->fetchColumn();
    }
}
