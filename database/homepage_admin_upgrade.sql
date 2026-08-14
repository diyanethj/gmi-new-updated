-- GMG Homepage Administration Upgrade
-- Database: gmigroup
-- Safe for the existing Events MVC installation.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `gmigroup`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `gmigroup`;

CREATE TABLE IF NOT EXISTS homepage_counters (
    id TINYINT UNSIGNED NOT NULL PRIMARY KEY,
    counter_key VARCHAR(80) NOT NULL,
    label VARCHAR(160) NOT NULL,
    counter_value BIGINT UNSIGNED NOT NULL DEFAULT 0,
    icon_path VARCHAR(500) NOT NULL,
    sort_order TINYINT UNSIGNED NOT NULL DEFAULT 1,
    updated_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_homepage_counters_key (counter_key),
    UNIQUE KEY uq_homepage_counters_order (sort_order),
    CONSTRAINT fk_homepage_counters_updated_by
        FOREIGN KEY (updated_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO homepage_counters
    (id, counter_key, label, counter_value, icon_path, sort_order)
VALUES
    (1, 'teu_handled', 'TEU''S Handled Per Year', 621374, 'images/icons/tue.png', 1),
    (2, 'customer_base', 'Customer Base', 304, 'images/icons/cus.png', 2),
    (3, 'foreign_partnerships', 'Foreign Partnerships', 17, 'images/icons/for.png', 3),
    (4, 'personnel_trained', 'Personnel Trained Per Year', 2417, 'images/icons/tra.png', 4)
ON DUPLICATE KEY UPDATE
    counter_key = VALUES(counter_key),
    label = VALUES(label),
    icon_path = VALUES(icon_path),
    sort_order = VALUES(sort_order);

CREATE TABLE IF NOT EXISTS business_partners (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(160) NOT NULL,
    alt_text VARCHAR(190) NOT NULL DEFAULT '',
    website_url VARCHAR(500) NULL,
    image_path VARCHAR(500) NOT NULL,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    sort_order INT UNSIGNED NOT NULL DEFAULT 9999,
    created_by BIGINT UNSIGNED NULL,
    updated_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_business_partners_public (status, sort_order, id),
    CONSTRAINT fk_business_partners_created_by
        FOREIGN KEY (created_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_business_partners_updated_by
        FOREIGN KEY (updated_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT IGNORE INTO business_partners
    (id, name, alt_text, website_url, image_path, status, sort_order)
VALUES
    (1, 'GFSSM', 'GFSSM logo', NULL, 'images/partness/GFSSM-n.png', 'active', 1),
    (2, 'Seaspan', 'Seaspan logo', NULL, 'images/partness/SEASPAN-n.png', 'active', 2),
    (3, 'Eastern', 'Eastern logo', NULL, 'images/partness/eastern.png', 'active', 3),
    (4, 'Cordelia Container Shipping Line', 'Cordelia Container Shipping Line logo', 'https://www.cordelialine.com/', 'images/partness/Cordelia-n.png', 'active', 4),
    (5, 'Global Feeder Shipping', 'Global Feeder Shipping logo', NULL, 'images/partness/Global Feeder Shipping-n.png', 'active', 5),
    (6, 'KSA', 'KSA logo', NULL, 'images/partness/KSA-n.png', 'active', 6),
    (7, 'Phoenix Containers', 'Phoenix Containers logo', NULL, 'images/partness/Phoenix Containers-n.png', 'active', 7),
    (8, 'Resorts World Cruises', 'Resorts World Cruises logo', NULL, 'images/partness/Resort World Cruises-n.png', 'active', 8),
    (9, 'Samudera Shipping', 'Samudera Shipping logo', 'https://www.samudera.id/', 'images/partness/Samudera-n.png', 'active', 9);

SET FOREIGN_KEY_CHECKS = 1;
