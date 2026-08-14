-- Complete GMG website database installer
-- Database: gmigroup
-- Includes events, homepage counters, business partners, About page,
-- career vacancies/applications, and administrator permissions.
-- Global Marine Group Events MVC - Complete Installer for database `gmigroup`
-- Import this single file in phpMyAdmin.
-- It creates the database, all tables, and existing event data in the correct order.

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `gmigroup`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `gmigroup`;

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

SET FOREIGN_KEY_CHECKS = 1;

-- Existing event data
-- Optional seed data migrated from the supplied static Events page.

INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('GMG Avurudu Celebration 2026', 'gmg-avurudu-celebration-2026', '2026-04-16', NULL, 'Global Marine Group', 'Global Marine Group proudly celebrates the spirit of unity, culture, and new beginnings this Sinhala and Tamil New Year', 'images/events/gmg-avurudu-celebration-2026/main.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('SLANA Battle of the NVOCCs 2026', 'slana-battle-of-the-nvoccs-2026', '2026-03-21', NULL, 'Global Marine Group', 'Cordelia Container Line Lanka, a member of the Global Marine Group took part in this year''s SLANA Battle of the NVOCCs, where we were able to showcase teamwork and competitive spirit.', 'images/events/slana-battle-of-the nvoccs-2026/main.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('CASA Sixes 2026', 'casa-sixes-2026', '2026-02-21', NULL, 'Global Marine Group', 'Global Marine Group participated in the CASA Sixes 2026, celebrating the spirit of sportsmanship and teamwork.', 'images/events/casa-sixes-2026/main.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Vessel Visit', 'vessel-visit', '2026-01-30', NULL, 'Global Marine Group', 'Global Marine Group arranged a familiarization tour on board a GFS vessel for some of our staff members.', 'images/events/vessel-visit/01.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Marine Group Receives Great Place To Work™ Certification!', 'global-marine-group-receives-great-place-to-worktm-certification', '2026-01-30', NULL, 'Global Marine Group', 'Global Marine Group is proud to announce its certification as a Great Place to Work™ for 2026/27.', 'images/events/great_place_to_work/Website.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Annual Trip 2025', 'annual-trip-2025', '2025-10-25', NULL, 'Global Marine Group', 'The Global Marine Group team enjoyed a refreshing and energizing annual trip at the stunning Cinnamon Bentota Beach Resort. A day filled with relaxation, team bonding, and unforgettable moments.', 'images/events/annual_trip_2025/1.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('McLarens Containers Depot Yard Visit', 'mclarens-containers-depot-yard-visit', '2025-10-15', NULL, 'Global Marine Group', 'The Global Marine Group team visited the McLarens Containers Depot Yard for an insightful tour and productive discussions.', 'images/events/mclarens_containers_depot_yard_visit/13.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Pirith Chanting Ceremony', 'pirith-chanting-ceremony', '2025-09-26', NULL, 'Global Marine Group', 'Global Marine Group to commemorate our 2nd anniversary held a Pirith Chanting and religious blessings Ceremony, seeking blessings for continued success.', 'images/events/pirith_chanting_ceremony/main.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Marine Group Partners with Happy Mind to Strengthen Employee Mental Well-Being', 'global-marine-group-partners-with-happy-mind-to-strengthen-employee-mental-well-being', '2025-09-22', NULL, 'Global Marine Group', 'At Global Marine Group, our people are at the heart of everything we do. In line with our commitment to fostering a supportive, resilient, and people-first culture...', 'images/events/events-global-marine-group-partners-with-happy-mind-to-trengthen-employee-mental-well-being/GMG-Happy Minds.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Outbound Training Program at CHE Adventure Park', 'outbound-training-program-at-che-adventure-park', '2025-09-14', NULL, 'Global Marine Group', 'Global Marine Group successfully organized an Outbound Training Programme at Che Adventure Park, designed to strengthen leadership, enhance communication, and foster effective team building.', 'images/events/outbound-training-program-at-CHE-adventure-park/events.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Marine Group partners with FitsOil', 'global-marine-group-partners-with-fitsoil', '2025-08-11', NULL, 'Global Marine Group', 'Global Marine Group and FitsOil (Pvt) Ltd signed an agreement today to formalize their collaborative entry into the bunkering business in Sri Lanka.', 'images/events/global_marine_group_partners_with_fitsoil/events.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Marine Services Signs Agreement with CINEC and MSTI', 'global-marine-services-signs-agreement-with-cinec-and-msti', '2025-08-01', NULL, 'Global Marine Group', 'Global Marine Services, the Group''s seafarer recruitment and placement services (SRPS) company signed an agreement with CINEC and MSTI Campuses on the 1st of August 2025.', 'images/events/global_marine_services_signs_agreement_with_cinec_and_msti/events.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Appointment of Our Non-Executive Directors', 'appointment-of-our-non-executive-directors', '2025-07-17', NULL, 'Global Marine Group', 'We are delighted to announce the appointment of Ms. Gayani De Alwis and Mr. Rohan Pandithakorralage to our Director Board as Non-Executive Directors.', 'images/events/appointment_of_our_non_executive_directors/events.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Staff Educational Tour to the Port of Colombo', 'staff-educational-tour-to-the-port-of-colombo', '2025-06-20', NULL, 'Global Marine Group', 'Global Marine Group in line with our value of "nurturing growth", organized an educational tour for some of our staff members to the Port of Colombo.', 'images/events/staff_educational_tour_to_the_port_of_colombo/events.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Vesak Celebration', 'vesak-celebration', '2025-05-15', NULL, 'Global Marine Group', 'Global Marine Group celebrated the Vesak festival with decorations and handing out snacks and tea to the people in the area.', 'images/events/vesak_celebration/events.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('CSR - Donating Medicine and Nutritional Supplements to the Cancer Hospital', 'csr-donating-medicine-and-nutritional-supplements-to-the-cancer-hospital', '2025-04-28', NULL, 'Global Marine Group', 'Global Marine Group commemorated the dawn of the Sinhala and Tamil new year by donating medicine and nutritional supplements to the National Cancer Institute Apeksha Hospital in Colombo.', 'images/events/donating_medicine_and_nutritional_supplements_to_the_cancer_hospital/events.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Sinhala and Tamil New Year Celebration', 'sinhala-and-tamil-new-year-celebration', '2025-04-17', NULL, 'Global Marine Group', 'Global Marine Group celebrated the dawn of the Sinhala and Tamil New Year with traditionality and solidarity.', 'images/events/sinhala_and_tamil_new_year_celebration/events.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Marine Group Participates in the "CASA Sixes 2025"', 'global-marine-group-participates-in-the-casa-sixes-2025', '2025-02-08', NULL, 'Global Marine Group', 'Global Marine Group participated at the "CASA sixes 2025" which was held on the 8th of February. This annual event is organized by CASA to facilitate...', 'images/events/casa_sixes/events.jpeg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('SLANA Sixes 2025 - Battle of the NVOCC''s', 'slana-sixes-2025-battle-of-the-nvocc-s', '2025-01-11', NULL, 'Global Marine Group', 'The Sri Lanka Association of NVOCC Agents (SLANA) six a side cricket tournament was held on the 11th of January 2025 at the MCA grounds. Global Feeder Shipping was the principal...', 'images/events/slana_sixes_battle_of_the_NVOCC/events.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Marine Group Celebrates the New Year 2025', 'global-marine-group-celebrates-the-new-year-2025', '2025-01-01', NULL, 'Global Marine Group', 'Global Marine Group begins the new year with renewed energy, looking forward to new opportunities and challenges. Driven by hope and optimism...', 'images/events/global_marine_group_celebrates_the_new_year/events.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Marine Group CSR Project 02', 'global-marine-group-csr-project-02', '2024-12-07', NULL, 'Global Marine Group', 'Global Marine Group in line with their purpose of "uplifting lives" and corporate value of "nurturing growth" donated books, uniforms, stationery and other items required for the upcoming school year...', 'images/events/global_marine_group_csr_project_2/gmi_event.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Feeders Lanka: A Certified Great Place to Work!', 'global-feeders-lanka-a-certified-great-place-to-work', '2024-11-01', NULL, 'Global Feeders Lanka', 'Global Feeders Lanka is proud to announce its certification as a "Great Place to Work" in November 2024, a significant milestone reflecting the dedication, teamwork, and professionalism of our incredible team.', 'images/events/certified_great_place_to_work/great_events.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('GMG first Anniversary Celebration', 'gmg-first-anniversary-celebration', '2024-10-11', NULL, 'The Kingsbury Colombo', 'Global Marine Group celebrated a year''s successful journey with a gala event that was held at Kingsbury Hotel on the 11th of October 2024. At the event, the Group launched their website...', 'images/events/gmg_first_anniversary/home-blog-one.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('CASA Futsal Tournament – Quarter Finalists', 'casa-futsal-tournament-quarter-finalists', '2024-10-05', NULL, 'Club Fusion', 'Global Feeders Lanka football team became quarter finalists at the CASA Futsal tournament 2024. The team competed aggressively to score a top 8 position out of the 26 teams that participated...', 'images/events/casa_futsal_tournament/home-blog-one.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Marine Services Partners with Rotary Sri Lanka for a Tree Planting Project', 'global-marine-services-partners-with-rotary-sri-lanka-for-a-tree-planting-project', '2024-08-22', NULL, 'Global Marine Services', 'Global Marine Services a Global Marine Group company had a CSR event on the 28th of July 2024 where they pledged to plant 2000 trees in line with their commitment to reducing the carbon footprint of the maritime industry...', 'images/events/tree_planting/home-blog-two.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Office Opening Ceremony of KSL Resources (Pvt) Ltd and Global Marine Services (Pvt.) Ltd', 'office-opening-ceremony-of-ksl-resources-pvt-ltd-and-global-marine-services-pvt-ltd', '2024-07-22', NULL, 'KSL Resources (Pvt) Ltd', 'The newest addition to Global Marine Group, KSL Resources Pvt Ltd opened their new office premises at 292, R A De Mel Mawatha. The opening ceremony followed the Sri Lankan traditions and formalities...', 'images/events/ksl_opening/home-blog-three.jpg', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Seminar Organized for Women''s Day', 'seminar-organized-for-women-s-day', '2024-03-07', NULL, 'DHPL Training Arena', 'Global Marine Group organized a seminar in an effort to raise awareness among their teams about the challenges faced by women in our society and to emphasize the importance of inclusion...', 'images/events/seminar_organized_for_women’s/home-blog-one.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('SSL Agency Lanka - New Agency Office in Colombo', 'ssl-agency-lanka-new-agency-office-in-colombo', '2024-03-01', NULL, 'R.A.De mel Mw, Colombo 03', 'On the 1st of March 2024, we were proud to announce the grand opening of SSL Agency Lanka (Pvt) Ltd, the exclusive agent for Samudera Shipping Line in Sri Lanka and a vital member of...', 'images/events/ssl_agency_lanka/home-blog-one.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Cordelia Container Shipping Line – New Office in Colombo', 'cordelia-container-shipping-line-new-office-in-colombo', '2024-01-02', NULL, 'R.A.De mel Mw, Colombo 03', 'Cordelia Container Shipping Line, one of the largest NVOCC operators in the region opened their new agency office in Colombo on the 2nd of January 2024. The office is located at R.A De Mel Mawatha, Colombo 03...', 'images/events/cordelia_container_shipping/home-blog-one.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';
INSERT INTO events (name, slug, event_date, event_time, company, description, main_image, status, sort_order, created_by, updated_by, created_at, updated_at) VALUES ('Global Feeder Shipping – New Agency Office in Colombo', 'global-feeder-shipping-new-agency-office-in-colombo', '2023-09-15', NULL, '104, Galle Rd, Colombo 02', 'Global Feeder Shipping LLC, the Dubai based feeder shipping giant opened its new joint venture office in Colombo Sri Lanka on the 15th of September 2023. The Office is situated in the central business area at 109, Galle road, Colombo 03...', 'images/events/global_feeder_shipping/home-blog-one.png', 'published', NULL, NULL, NULL, NOW(), NOW()) ON DUPLICATE KEY UPDATE name=VALUES(name), event_date=VALUES(event_date), company=VALUES(company), description=VALUES(description), main_image=VALUES(main_image), status='published';

SET @avurudu_id = (SELECT id FROM events WHERE slug = 'gmg-avurudu-celebration-2026' LIMIT 1);
DELETE FROM event_images WHERE event_id = @avurudu_id;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/01.jpg', 1, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/02.jpg', 2, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/03.jpg', 3, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/04.jpg', 4, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/05.jpg', 5, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/06.jpg', 6, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/07.jpg', 7, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/08.jpg', 8, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/09.jpg', 9, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/10.jpg', 10, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/11.jpg', 11, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/12.jpg', 12, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/13.jpg', 13, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/14.jpg', 14, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/15.jpg', 15, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/16.jpg', 16, NOW() WHERE @avurudu_id IS NOT NULL;
INSERT INTO event_images (event_id, image_path, sort_order, created_at) SELECT @avurudu_id, 'images/events/gmg-avurudu-celebration-2026/17.jpg', 17, NOW() WHERE @avurudu_id IS NOT NULL;


-- Homepage counters and business partners
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


-- ABOUT PAGE MODULE
-- GMG About Page Admin Upgrade
-- Import once into the existing gmigroup database.
SET NAMES utf8mb4;
SET time_zone = '+05:30';
CREATE DATABASE IF NOT EXISTS gmigroup CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gmigroup;

CREATE TABLE IF NOT EXISTS about_members (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    member_type ENUM('director', 'management') NOT NULL,
    name VARCHAR(160) NOT NULL,
    position VARCHAR(255) NOT NULL,
    image_path VARCHAR(500) NOT NULL,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    sort_order INT UNSIGNED NOT NULL DEFAULT 9999,
    created_by BIGINT UNSIGNED NULL,
    updated_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_about_members_type_name (member_type, name),
    KEY idx_about_members_public (member_type, status, sort_order, id),
    CONSTRAINT fk_about_members_created_by FOREIGN KEY (created_by) REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_about_members_updated_by FOREIGN KEY (updated_by) REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS about_teams (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(180) NOT NULL,
    image_path VARCHAR(500) NOT NULL,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    sort_order INT UNSIGNED NOT NULL DEFAULT 9999,
    created_by BIGINT UNSIGNED NULL,
    updated_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_about_teams_company_name (company_name),
    KEY idx_about_teams_public (status, sort_order, id),
    CONSTRAINT fk_about_teams_created_by FOREIGN KEY (created_by) REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_about_teams_updated_by FOREIGN KEY (updated_by) REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Capt. Joseph Ranchigoda', 'Chairman', 'images/directors/Captain Joseph Ranchigoda.jpg', 'active', 10);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Mevan Peiris', 'Group Managing Director', 'images/directors/Mevan Peiris.jpg', 'active', 20);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Gayani De Alwis', 'Non-Executive Director', 'images/directors/Gayani De Alwis.jpg', 'active', 30);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Rohan Pandithakoralage', 'Non-Executive Director – HR', 'images/directors/Rohan Pandithakorralage.jpg', 'active', 40);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Wasantha Galagoda', 'Director – Finance', 'images/directors/Wasantha Galagoda.jpg', 'active', 50);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Capt. A.V. Rajendra', 'Chairman/CEO, SSL Agency Lanka', 'images/directors/Capt. A.V. Rajendra.jpg', 'active', 60);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Kavan Aluwihare', 'Director/COO, Global Feeders Lanka', 'images/directors/Kavan Aluwihare.jpg', 'active', 70);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Capt. Channa Abeygunawardena', 'Managing Director, Global Marine Services / Global Port Services', 'images/directors/Capt. Channa  Abeygunawardena.jpg', 'active', 80);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Nishan Doranegama', 'Director/COO, Cordelia Container Line / Global Multimodal Logistics', 'images/directors/Nishan Doranagama.jpg', 'active', 90);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Capt. Kapila Perera', 'Managing Director, Global Marine Ship Management / KSL Resources', 'images/directors/Capt. Kapila Perera - Managing Director - Global Marine Shipmanagement Pvt Ltd _ KSL Resources (Private) Limited.jpg', 'active', 100);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Medepalli Srinath', 'Executive Director, MPSS Shipping Pte Ltd', 'images/directors/Medapalli Srinath.jpg', 'active', 110);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('director', 'Capt. Shankar Narayanan', 'Director, MPSS Shipping Pte Ltd', 'images/directors/Capt. Narayanan Shankar.jpg', 'active', 120);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Azad Rawdin', 'General Manager', 'images/management_team/01. Azad Rawdin - General Manager.jpg', 'active', 10);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Hirantha Perera', 'Assistant General Manager', 'images/management_team/02. Hirantha Perera - Assistant General Manager.jpg', 'active', 20);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Graham Fernandesz', 'Assistant General Manager - Operations', 'images/management_team/03. Graham Fernandesz - Assistant General Manager - Operations.jpg', 'active', 30);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Champa Seneviratne', 'Senior Manager - Sales and Marketing', 'images/management_team/04. Champa Senevirathne - Senior Manager - Sales and Marketing.jpg', 'active', 40);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Dulip Kumara', 'Senior Manager - Group IT', 'images/management_team/05. Dulip Kumara - Senior Manager - Group IT.jpg', 'active', 50);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Enoka Siriwardena', 'Senior Manager - Operations', 'images/management_team/06. Enoka Siriwardena - Senior Manager - Operations.jpg', 'active', 60);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Niraj Perera', 'Manager - Logistics', 'images/management_team/07. Niraj Perera - Manager - Logistics.jpg', 'active', 70);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Kulandaivelu Rajesvari', 'Manager - Documentation', 'images/management_team/08. Kulandaivelu Rajesvari - Manager - Documentation.jpg', 'active', 80);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Binoy Chaminda', 'Manager – Operations (Equipment Controller)', 'images/management_team/09. Binoy Chaminda - Manager – Operations (Equipment Controller).jpg', 'active', 90);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Yeshani Kumarasinghe', 'Manager - Marine HR', 'images/management_team/10. Yeshani Kumarasinghe - Manager - Marine HR.jpg', 'active', 100);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Kalimuthu Ramesh', 'Assistant Manager - Documentation', 'images/management_team/11. Kalimuthu Ramesh - Assistant Manager - Documentation.jpg', 'active', 110);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Thinamany Praveen', 'Assistant Manager - Sales & Marketing', 'images/management_team/15. Thinamany Praveen - Assistant Manager - Sales & Marketing.jpg', 'active', 120);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Kaushalya Dawakelle', 'Assistant Manager - Customer Service & Export Documentation', 'images/management_team/16. Kaushalya Dawakella - Assistant Manager - Customer Service and Export Documentation.jpg', 'active', 130);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Isuru Dharmasuriya', 'Assistant Manager - Group Finance', 'images/management_team/17. Isuru Dharmasuriya - Assistant Manager - Group Finance.jpg', 'active', 140);
INSERT IGNORE INTO about_members (member_type, name, position, image_path, status, sort_order) VALUES ('management', 'Shemara Fonseka', 'Senior Executive - Group HR', 'images/management_team/18. Shemara Fonseka - Senior Executive - Group HR.jpg', 'active', 150);

INSERT IGNORE INTO about_teams (company_name, image_path, status, sort_order) VALUES ('Global Marine Group', 'images/our_teams/Global Marine Group.jpg', 'active', 10);
INSERT IGNORE INTO about_teams (company_name, image_path, status, sort_order) VALUES ('Cordelia Container Line Lanka', 'images/our_teams/Cordelia Container Line Lanka.jpg', 'active', 20);
INSERT IGNORE INTO about_teams (company_name, image_path, status, sort_order) VALUES ('Global Feeders Lanka', 'images/our_teams/Global Feeders Lanka.jpg', 'active', 30);
INSERT IGNORE INTO about_teams (company_name, image_path, status, sort_order) VALUES ('Global Marine Services', 'images/our_teams/Global Marine Services.jpg', 'active', 40);
INSERT IGNORE INTO about_teams (company_name, image_path, status, sort_order) VALUES ('Global Multimodal Logistics', 'images/our_teams/Global Multimodal Logistics.jpg', 'active', 50);
INSERT IGNORE INTO about_teams (company_name, image_path, status, sort_order) VALUES ('SSL Agency Lanka', 'images/our_teams/SSL Agency Lanka.jpg', 'active', 60);

SELECT 'About page upgrade completed.' AS result;

-- CAREERS AND PERMISSIONS MODULE
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


-- =========================================================
-- COMPANIES PAGE + CAREER COMPANY NAME UPGRADE
-- =========================================================
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
