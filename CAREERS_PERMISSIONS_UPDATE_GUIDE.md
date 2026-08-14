# Careers and Administrator Permissions Update

Database: `gmigroup`

## 1. Back up the website and database

Create a copy of the current `gmi-new` folder and export the `gmigroup` database before replacing files.

## 2. Import the database upgrade

For the existing website, import:

`database/careers_permissions_upgrade.sql`

The upgrade creates:

- `admin_permissions`
- `job_vacancies`
- `job_applications`

It does not remove existing administrators, events, counters, partners, directors, management members, or team images.

Existing normal administrators receive their previous content-management permissions. Administrator-management permissions are not automatically granted.

For a completely new database, import:

`database/install_complete_current.sql`

## 3. Replace the application files

Copy the project files into the existing website root. Important entry points are:

- `careers.php`
- `admin/index.php`
- `app/Views/public/careers.php`
- `app/Views/admin/layouts/app.php`

The update also replaces authentication, administrator, and existing content controllers so permission checks are enforced server-side.

## 4. Add the protected CV directory

Ensure this folder exists and is writable by Apache/PHP:

`uploads/cv`

On Windows/WAMP, creating the folder is normally enough. The included `.htaccess` blocks direct browser access to CV files. CVs are downloaded only through the authenticated admin controller.

Accepted CV types:

- PDF
- DOC
- DOCX

Maximum size: 5 MB.

DOCX validation requires the PHP Zip extension. In WAMP, enable `php_zip` if DOCX uploads are rejected.

## 5. Check the base URL

For this installation path:

`C:\wamp64\www\gmi-new`

set this in `config/app.php`:

```php
'base_url' => '/gmi-new',
```

Use an empty string only when the project is the domain document root.

## 6. Administrator permissions

Super Admin accounts automatically have every permission.

Normal Admin accounts receive only selected action permissions. Permissions are grouped by:

- Events
- Homepage counters
- Business partners
- Board of Directors
- Management Team
- Our Teams
- Career vacancies
- Career applications
- Administrators

An administrator with administrator-management permissions can manage only the child administrators they created. A normal administrator cannot create or edit a Super Admin and cannot assign permissions they do not personally have.

## 7. Admin URLs

- Vacancies: `/admin/index.php?action=careers-vacancies`
- Applications: `/admin/index.php?action=careers-applications`
- Directors: `/admin/index.php?action=about-directors`
- Management Team: `/admin/index.php?action=about-management`
- Our Teams: `/admin/index.php?action=about-teams`
- Administrators: `/admin/index.php?action=admins`

## 8. Public Careers page

Public URL:

`/careers.php`

The page displays GMG and GMS vacancies separately. Applicants select an active vacancy, enter name, email and phone, and upload a CV.

## 9. Diagnostic check

Temporarily open:

`/tools/database_check.php`

Delete or block this diagnostic page after confirming all tables exist.
