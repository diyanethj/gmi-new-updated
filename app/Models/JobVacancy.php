<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class JobVacancy
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function activeByCompany(string $company): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM job_vacancies
             WHERE company = :company AND status = 'active'
             ORDER BY sort_order ASC, id DESC"
        );
        $stmt->execute([':company' => $company]);
        return $stmt->fetchAll();
    }

    public function allActive(): array
    {
        return $this->db->query(
            "SELECT * FROM job_vacancies
             WHERE status = 'active'
             ORDER BY FIELD(company, 'GMG', 'GMS'), company_name ASC, sort_order ASC, id DESC"
        )->fetchAll();
    }

    public function adminAll(): array
    {
        return $this->db->query(
            "SELECT v.*, a.username AS creator_username,
                    (SELECT COUNT(*) FROM job_applications ja WHERE ja.vacancy_id = v.id) AS application_count
             FROM job_vacancies v
             LEFT JOIN admins a ON a.id = v.created_by
             ORDER BY FIELD(v.company, 'GMG', 'GMS'), v.company_name ASC, v.sort_order ASC, v.id DESC"
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM job_vacancies WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    public function findActive(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM job_vacancies WHERE id = :id AND status = 'active' LIMIT 1");
        $stmt->execute([':id' => $id]);
        $record = $stmt->fetch();
        return $record ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO job_vacancies
             (company, company_name, position, responsibilities, qualifications, status, sort_order, created_by, updated_by, created_at, updated_at)
             VALUES (:company, :company_name, :position, :responsibilities, :qualifications, :status, :sort_order, :created_by, :updated_by, NOW(), NOW())'
        );
        $stmt->execute([
            ':company' => $data['company'],
            ':company_name' => $data['company_name'],
            ':position' => $data['position'],
            ':responsibilities' => $data['responsibilities'],
            ':qualifications' => $data['qualifications'],
            ':status' => $data['status'],
            ':sort_order' => $data['sort_order'],
            ':created_by' => $data['created_by'],
            ':updated_by' => $data['updated_by'],
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            'UPDATE job_vacancies SET
                company = :company,
                company_name = :company_name,
                position = :position,
                responsibilities = :responsibilities,
                qualifications = :qualifications,
                status = :status,
                sort_order = :sort_order,
                updated_by = :updated_by,
                updated_at = NOW()
             WHERE id = :id'
        );
        $stmt->execute([
            ':company' => $data['company'],
            ':company_name' => $data['company_name'],
            ':position' => $data['position'],
            ':responsibilities' => $data['responsibilities'],
            ':qualifications' => $data['qualifications'],
            ':status' => $data['status'],
            ':sort_order' => $data['sort_order'],
            ':updated_by' => $data['updated_by'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM job_vacancies WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    public function updateOrders(array $orders, int $adminId): void
    {
        $stmt = $this->db->prepare(
            'UPDATE job_vacancies SET sort_order = :sort_order, updated_by = :updated_by, updated_at = NOW() WHERE id = :id'
        );
        foreach ($orders as $id => $order) {
            $stmt->bindValue(':sort_order', (int) $order, PDO::PARAM_INT);
            $stmt->bindValue(':updated_by', $adminId, PDO::PARAM_INT);
            $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function countActive(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM job_vacancies WHERE status = 'active'")->fetchColumn();
    }
}
