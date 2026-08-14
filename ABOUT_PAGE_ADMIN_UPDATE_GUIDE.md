# GMG About Page Admin Update

This update adds database-driven administration for:

- Board of Directors: name, position, image, status, display order
- Management Team: name, position, image, status, display order
- Our Teams: company name, image, status, display order

The existing About Us page design, information cards, header, breadcrumb, footer, loading animation, reveal effects, and responsive card layouts are preserved.

## 1. Import the database migration

Open phpMyAdmin, select or open the `gmigroup` database, and import:

`database/about_page_admin_upgrade.sql`

The migration creates:

- `about_members`
- `about_teams`

It also imports the existing 12 directors, 15 management team members, and 6 company teams from the supplied About Us page. Existing admins, events, counters, and partners are not deleted.

## 2. Replace and add files

Copy the update files into the same relative locations in your project.

Important public files:

- `about-us.php`
- `app/Controllers/PublicAboutController.php`
- `app/Views/public/about.php`

Important admin files:

- `admin/index.php`
- `app/Controllers/Admin/AboutController.php`
- `app/Models/AboutMember.php`
- `app/Models/AboutTeam.php`
- `app/Views/admin/about/index.php`
- `app/Views/admin/about/members-index.php`
- `app/Views/admin/about/member-form.php`
- `app/Views/admin/about/teams-index.php`
- `app/Views/admin/about/team-form.php`
- `app/Views/admin/layouts/app.php`
- `app/Core/Validator.php`
- `config/app.php`

Protected upload folders:

- `uploads/about-members/.htaccess`
- `uploads/about-teams/.htaccess`

## 3. Admin URLs

About overview:

`/admin/index.php?action=about`

Board of Directors:

`/admin/index.php?action=about-directors`

Management Team:

`/admin/index.php?action=about-management`

Our Teams:

`/admin/index.php?action=about-teams`

## 4. Ordering

Use the Order field on each list and click **Save Display Order**.

- Lower numbers appear first.
- Order values must be from 1 to 9999.
- Inactive records remain in the admin panel but do not appear publicly.

## 5. Images

New images are stored in:

- `uploads/about-members/YYYY/MM/`
- `uploads/about-teams/YYYY/MM/`

Accepted formats:

- JPG
- PNG
- WEBP

Maximum size: 8 MB per image.

The uploader validates the actual MIME type, image signature, and dimensions and assigns a random filename. Script execution is blocked in the upload directories.

## 6. Base URL

When installed at `C:\\wamp64\\www\\gmi-new`, set this in `config/app.php`:

```php
'base_url' => '/gmi-new',
```

Use an empty value only when the project is the domain or virtual-host root.
