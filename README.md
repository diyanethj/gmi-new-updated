# Global Marine Group Events MVC

Secure PHP MVC event management system built around the supplied `events.php` and `event-details.php` designs.

## Requirements

- PHP 8.1 or newer
- MySQL 8.0+ or MariaDB 10.4+
- PHP extensions: PDO MySQL and fileinfo
- Apache with `.htaccess` support recommended
- Existing GMG site image assets under `images/`

## Installation

1. Copy all project files into the GMG website root. Keep the existing `images/` directory.
2. Import `database/schema.sql` using phpMyAdmin or MySQL.
   - Optional: import `database/seed_existing_events.sql` to migrate the event cards from the supplied static Events page.
3. Edit `config/database.php` with the database credentials.
4. Edit `config/app.php`:
   - Set `base_url` when the site is installed in a subfolder, for example `/gmg`.
   - Replace `app_key` with a new 64-character random value for production.
5. Ensure these directories are writable by PHP:
   - `uploads/events/`
   - `storage/logs/`
6. Create the first super administrator from Command Prompt / Terminal:

```bash
php tools/create_admin.php admin admin@example.com "A-Strong-Password!2026" super_admin
```

On WAMP, open Command Prompt in the project folder and use the PHP executable, for example:

```bat
C:\wamp64\bin\php\php8.3.0\php.exe tools\create_admin.php admin admin@example.com "A-Strong-Password!2026" super_admin
```

7. Open:
   - Public events: `/events.php`
   - Public detail URL: `/event-details.php?slug=event-slug`
   - Admin login: `/admin/index.php?action=login`

## Display order

- New events use automatic ordering by `event_date DESC`, so the latest event appears first.
- In the admin Events screen, enter custom order values such as `1`, `2`, `3` to override automatic ordering.
- Custom-numbered events appear first, in ascending order. Blank events remain latest-first.

## Security included

- PDO prepared statements and disabled emulated prepares
- `password_hash()` / `password_verify()`
- CSRF protection for every POST request
- Secure session cookie settings, session ID regeneration, idle timeout, and absolute timeout
- Login throttling by hashed login identifier and IP address
- Super-admin authorization for administrator management
- Output escaping and strict input validation
- Image MIME, signature, dimension, size, and upload error validation
- Randomized image filenames
- PHP/script execution blocked inside uploads
- Safe image deletion restricted to the configured upload directory
- Audit records for logins and administrative changes
- Draft/published event states
- Last-super-admin and self-deletion protection

## Important production settings

- Use HTTPS.
- Set PHP `upload_max_filesize` and `post_max_size` above 8 MB when uploading several images.
- Disable directory browsing in Apache.
- Keep `config/`, `app/`, `database/`, `storage/`, and `tools/` inaccessible from the web. Included `.htaccess` files do this on Apache.
- After creating the first administrator, keep `tools/` blocked or remove it from the production server.
