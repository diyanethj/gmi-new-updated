# Global Marine Group Website MVC Admin

Secure PHP MVC administration for events and selected homepage content.

## Included

- Secure administrator authentication and administrator management
- Event create, edit, delete, status, order, main image, and gallery management
- Dynamic `events.php` and `event-details.php`
- Dynamic homepage `index.php`
- Latest three published events on the homepage
- Four editable homepage counter numbers
- Business partner logo create, edit, delete, status, and order management

## Requirements

- PHP 8.1 or newer
- MySQL 8.0+ or MariaDB 10.4+
- PDO MySQL and fileinfo PHP extensions
- Existing GMG `images/` directory

## Existing installation upgrade

1. Back up the website and `gmigroup` database.
2. Import `database/homepage_admin_upgrade.sql` into `gmigroup`.
3. Replace the project files with this package.
4. Keep the existing `images/` directory.
5. Make these directories writable by PHP:
   - `uploads/events/`
   - `uploads/partners/`
   - `storage/logs/`
6. In `config/app.php`, set `base_url` when the project is installed in a subfolder. For `C:\wamp64\www\gmi-new`, use:

```php
'base_url' => '/gmi-new',
```

7. Open `/admin/index.php?action=login`.

## New admin pages

```text
/admin/index.php?action=counters
/admin/index.php?action=partners
/admin/index.php?action=partners-create
```

## Homepage event selection

The homepage always selects the three newest published events using:

```sql
ORDER BY event_date DESC, id DESC
LIMIT 3
```

The custom event order used on `events.php` does not change this homepage latest-three selection.

## Security

- PDO prepared statements with native prepares
- CSRF protection on all POST actions
- Password hashing and secure sessions
- Admin authorization checks
- Strict image signature, MIME, dimensions, and size validation
- Random partner and event upload filenames
- Script execution blocked in upload folders
- Output escaping and URL validation
- Audit logging

See `HOMEPAGE_ADMIN_UPDATE_GUIDE.md` for the file-by-file replacement order.

## About Page Administration

Import `database/about_page_admin_upgrade.sql`, then use `admin/index.php?action=about` to manage directors, management team members, and company team images. See `ABOUT_PAGE_ADMIN_UPDATE_GUIDE.md` for file-by-file instructions.
