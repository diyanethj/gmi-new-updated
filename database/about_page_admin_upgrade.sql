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