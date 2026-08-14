USE gmigroup;

/* =========================================================
   1. COMPANY PAGE MANAGEMENT
   ========================================================= */
CREATE TABLE IF NOT EXISTS website_companies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(180) NOT NULL,
    image_path VARCHAR(500) NOT NULL,
    website_url VARCHAR(500) NULL,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    sort_order INT UNSIGNED NOT NULL DEFAULT 9999,
    created_by BIGINT UNSIGNED NULL,
    updated_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_website_companies_name (company_name),
    KEY idx_website_companies_public (status, sort_order, id),
    CONSTRAINT fk_website_companies_created_by
        FOREIGN KEY (created_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_website_companies_updated_by
        FOREIGN KEY (updated_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT IGNORE INTO website_companies
(company_name, image_path, website_url, status, sort_order, created_by, updated_by, created_at, updated_at)
VALUES
('SSL Agency Lanka', 'images/logofinal/SSL.png', 'http://www.samudera.id/', 'active', 1, NULL, NULL, NOW(), NOW()),
('Global Port Services', 'images/logofinal/GPS.png', 'port-agency-services.php', 'active', 2, NULL, NULL, NOW(), NOW()),
('Global Feeders Lanka', 'images/logofinal/GFL.png', 'http://www.globalfeeders.com/', 'active', 3, NULL, NULL, NOW(), NOW()),
('Global Marine Services', 'images/logofinal/GMS.png', 'https://globalmarineservices.lk/', 'active', 4, NULL, NULL, NOW(), NOW()),
('Global Multimodal Logistics', 'images/logofinal/GML.png', 'freight-forwarding-and-logistics.php', 'active', 5, NULL, NULL, NOW(), NOW()),
('Cordelia Container Line Lanka', 'images/logofinal/CSL.png', 'http://www.cordelialine.com/', 'active', 6, NULL, NULL, NOW(), NOW()),
('MPSS Shipping', 'images/logofinal/MPSS.png', 'contact-us.php', 'active', 7, NULL, NULL, NOW(), NOW()),
('KSL Resources', 'images/logofinal/KSL.png', 'foreign-employment-agency.php', 'active', 8, NULL, NULL, NOW(), NOW()),
('Global Marine Ship Management', 'images/logofinal/MPSS.png', 'contact-us.php', 'active', 9, NULL, NULL, NOW(), NOW());

/* =========================================================
   2. CAREERS: GMG/GMS GROUP + REQUIRED COMPANY NAME
   ========================================================= */
ALTER TABLE job_vacancies MODIFY company VARCHAR(10) NOT NULL;
ALTER TABLE job_applications MODIFY company VARCHAR(10) NOT NULL;

UPDATE job_vacancies SET company = 'GMS' WHERE company = 'GMI';
UPDATE job_applications SET company = 'GMS' WHERE company = 'GMI';

SET @vacancy_company_name_exists = (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'job_vacancies'
      AND COLUMN_NAME = 'company_name'
);
SET @sql = IF(
    @vacancy_company_name_exists = 0,
    'ALTER TABLE job_vacancies ADD COLUMN company_name VARCHAR(180) NULL AFTER company',
    'SELECT 1'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @application_company_name_exists = (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'job_applications'
      AND COLUMN_NAME = 'company_name'
);
SET @sql = IF(
    @application_company_name_exists = 0,
    'ALTER TABLE job_applications ADD COLUMN company_name VARCHAR(180) NULL AFTER company',
    'SELECT 1'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

UPDATE job_vacancies
SET company_name = CASE
    WHEN company = 'GMS' THEN 'Global Marine Services'
    ELSE 'Global Marine Group'
END
WHERE company_name IS NULL OR TRIM(company_name) = '';

UPDATE job_applications
SET company_name = CASE
    WHEN company = 'GMS' THEN 'Global Marine Services'
    ELSE 'Global Marine Group'
END
WHERE company_name IS NULL OR TRIM(company_name) = '';

ALTER TABLE job_vacancies MODIFY company_name VARCHAR(180) NOT NULL;
ALTER TABLE job_applications MODIFY company_name VARCHAR(180) NOT NULL;

/* =========================================================
   3. PERMISSIONS FOR EXISTING NORMAL ADMINS
   ========================================================= */
INSERT IGNORE INTO admin_permissions (admin_id, permission_key, granted_by, created_at)
SELECT a.id, p.permission_key, NULL, NOW()
FROM admins a
CROSS JOIN (
    SELECT 'companies.view' permission_key
    UNION ALL SELECT 'companies.create'
    UNION ALL SELECT 'companies.edit'
    UNION ALL SELECT 'companies.delete'
    UNION ALL SELECT 'companies.order'
) p
WHERE a.role = 'admin';
