-- Global Marine Group Events MVC
-- MySQL 8.0+ / MariaDB 10.4+

CREATE DATABASE IF NOT EXISTS gmg_events
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE gmg_events;

CREATE TABLE IF NOT EXISTS admins (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(190) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('super_admin', 'admin') NOT NULL DEFAULT 'admin',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_by BIGINT UNSIGNED NULL,
    last_login_at DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_admins_username (username),
    UNIQUE KEY uq_admins_email (email),
    KEY idx_admins_role_active (role, is_active),
    CONSTRAINT fk_admins_created_by
        FOREIGN KEY (created_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS events (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(220) NOT NULL,
    event_date DATE NOT NULL,
    event_time VARCHAR(100) NULL,
    company VARCHAR(160) NOT NULL,
    description LONGTEXT NOT NULL,
    main_image VARCHAR(500) NOT NULL,
    status ENUM('draft', 'published') NOT NULL DEFAULT 'published',
    sort_order INT UNSIGNED NULL,
    created_by BIGINT UNSIGNED NULL,
    updated_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_events_slug (slug),
    KEY idx_events_public_order (status, sort_order, event_date, id),
    KEY idx_events_date (event_date),
    CONSTRAINT fk_events_created_by
        FOREIGN KEY (created_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_events_updated_by
        FOREIGN KEY (updated_by) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS event_images (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    event_id BIGINT UNSIGNED NOT NULL,
    image_path VARCHAR(500) NOT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_event_images_event_order (event_id, sort_order, id),
    CONSTRAINT fk_event_images_event
        FOREIGN KEY (event_id) REFERENCES events(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS login_attempts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    identifier_hash CHAR(64) NOT NULL,
    ip_hash CHAR(64) NOT NULL,
    success TINYINT(1) NOT NULL DEFAULT 0,
    attempted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_login_attempt_identifier (identifier_hash, attempted_at),
    KEY idx_login_attempt_ip (ip_hash, attempted_at),
    KEY idx_login_attempt_cleanup (attempted_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS audit_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    admin_id BIGINT UNSIGNED NULL,
    action VARCHAR(80) NOT NULL,
    entity_type VARCHAR(80) NOT NULL,
    entity_id BIGINT UNSIGNED NULL,
    metadata_json JSON NULL,
    ip_hash CHAR(64) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_audit_admin_date (admin_id, created_at),
    KEY idx_audit_entity (entity_type, entity_id, created_at),
    CONSTRAINT fk_audit_admin
        FOREIGN KEY (admin_id) REFERENCES admins(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;
