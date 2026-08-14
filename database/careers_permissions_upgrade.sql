-- GMG Careers + administrator permission upgrade
-- Import this file into the existing `gmigroup` database.

CREATE DATABASE IF NOT EXISTS `gmigroup`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `gmigroup`;

CREATE TABLE IF NOT EXISTS admin_permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    admin_id BIGINT UNSIGNED NOT NULL,
    permission_key VARCHAR(100) NOT NULL,
    granted_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_admin_permission (admin_id, permission_key),
    KEY idx_admin_permissions_key (permission_key),
    KEY idx_admin_permissions_granted_by (granted_by),
    CONSTRAINT fk_admin_permissions_admin
        FOREIGN KEY (admin_id) REFERENCES admins(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_admin_permissions_granted_by
        FOREIGN KEY (granted_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS job_vacancies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company ENUM('GMG', 'GMI') NOT NULL,
    position VARCHAR(180) NOT NULL,
    responsibilities LONGTEXT NOT NULL,
    qualifications LONGTEXT NOT NULL,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    sort_order INT UNSIGNED NOT NULL DEFAULT 9999,
    created_by BIGINT UNSIGNED NULL,
    updated_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_job_vacancies_public (status, company, sort_order, id),
    CONSTRAINT fk_job_vacancies_created_by
        FOREIGN KEY (created_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_job_vacancies_updated_by
        FOREIGN KEY (updated_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS job_applications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    vacancy_id BIGINT UNSIGNED NULL,
    vacancy_position VARCHAR(180) NOT NULL,
    company ENUM('GMG', 'GMI') NOT NULL,
    applicant_name VARCHAR(160) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(40) NOT NULL,
    cv_path VARCHAR(500) NOT NULL,
    original_cv_name VARCHAR(255) NOT NULL,
    cv_mime VARCHAR(150) NOT NULL,
    cv_size INT UNSIGNED NOT NULL,
    ip_hash CHAR(64) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_job_applications_created (created_at, id),
    KEY idx_job_applications_vacancy (vacancy_id),
    KEY idx_job_applications_email (email),
    CONSTRAINT fk_job_applications_vacancy
        FOREIGN KEY (vacancy_id) REFERENCES job_vacancies(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Preserve the access existing normal administrators had before this upgrade.
-- Super administrators always receive every permission automatically in PHP.
INSERT IGNORE INTO admin_permissions (admin_id, permission_key, granted_by, created_at)
SELECT a.id, p.permission_key, NULL, NOW()
FROM admins a
CROSS JOIN (
    SELECT 'events.view' permission_key UNION ALL SELECT 'events.create' UNION ALL SELECT 'events.edit' UNION ALL SELECT 'events.delete' UNION ALL SELECT 'events.order'
    UNION ALL SELECT 'counters.view' UNION ALL SELECT 'counters.edit'
    UNION ALL SELECT 'partners.view' UNION ALL SELECT 'partners.create' UNION ALL SELECT 'partners.edit' UNION ALL SELECT 'partners.delete' UNION ALL SELECT 'partners.order'
    UNION ALL SELECT 'about.directors.view' UNION ALL SELECT 'about.directors.create' UNION ALL SELECT 'about.directors.edit' UNION ALL SELECT 'about.directors.delete' UNION ALL SELECT 'about.directors.order'
    UNION ALL SELECT 'about.management.view' UNION ALL SELECT 'about.management.create' UNION ALL SELECT 'about.management.edit' UNION ALL SELECT 'about.management.delete' UNION ALL SELECT 'about.management.order'
    UNION ALL SELECT 'about.teams.view' UNION ALL SELECT 'about.teams.create' UNION ALL SELECT 'about.teams.edit' UNION ALL SELECT 'about.teams.delete' UNION ALL SELECT 'about.teams.order'
    UNION ALL SELECT 'careers.vacancies.view' UNION ALL SELECT 'careers.vacancies.create' UNION ALL SELECT 'careers.vacancies.edit' UNION ALL SELECT 'careers.vacancies.delete' UNION ALL SELECT 'careers.vacancies.order'
    UNION ALL SELECT 'careers.applications.view' UNION ALL SELECT 'careers.applications.download' UNION ALL SELECT 'careers.applications.delete'
) p
WHERE a.role = 'admin';
