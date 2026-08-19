<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class JobApplication
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function all(string $company = '', ?int $vacancyId = null): array
    {
        $company = strtoupper(trim($company));

        $sql = 'SELECT ja.*, v.position AS current_vacancy_position, v.company_name AS current_company_name
                FROM job_applications ja
                LEFT JOIN job_vacancies v ON v.id = ja.vacancy_id';

        $conditions = [];
        $params = [];

        if (in_array($company, ['GMG', 'GMS'], true)) {
            $conditions[] = 'ja.company = :company';
            $params[':company'] = $company;
        }

        if ($vacancyId !== null && $vacancyId > 0) {
            $conditions[] = 'ja.vacancy_id = :vacancy_id';
            $params[':vacancy_id'] = $vacancyId;
        }

        if ($conditions !== []) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $sql .= ' ORDER BY ja.created_at DESC, ja.id DESC';

        $stmt = $this->db->prepare($sql);

        foreach ($params as $name => $value) {
            if ($name === ':vacancy_id') {
                $stmt->bindValue($name, (int) $value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue($name, (string) $value, PDO::PARAM_STR);
            }
        }

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function vacancyFilterOptions(string $company = ''): array
    {
        $company = strtoupper(trim($company));

        $sql = 'SELECT
                    ja.vacancy_id,
                    MAX(ja.vacancy_position) AS vacancy_position,
                    MAX(ja.company) AS company,
                    MAX(ja.company_name) AS company_name,
                    COUNT(*) AS application_count
                FROM job_applications ja';

        $params = [];

        if (in_array($company, ['GMG', 'GMS'], true)) {
            $sql .= ' WHERE ja.company = :company';
            $params[':company'] = $company;
        }

        $sql .= ' GROUP BY ja.vacancy_id
                  ORDER BY MAX(ja.company) ASC,
                           MAX(ja.vacancy_position) ASC,
                           ja.vacancy_id DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
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
