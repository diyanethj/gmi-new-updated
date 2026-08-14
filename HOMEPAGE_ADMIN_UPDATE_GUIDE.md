# Homepage Admin Update — File-by-File Installation

This update keeps the existing Events MVC project and adds:

- The latest three published events on `index.php`
- Four editable homepage counter numbers
- Business partner logo create, edit, delete, activate/inactivate, and order controls

## 1. Import the database upgrade

Import this file into the existing `gmigroup` database:

```text
database/homepage_admin_upgrade.sql
```

It creates and seeds:

- `homepage_counters`
- `business_partners`

It does not delete existing administrators, events, or event images.

## 2. Replace the public homepage files

Replace or add:

```text
index.php
app/Controllers/PublicHomeController.php
app/Views/public/home.php
```

The homepage queries the database and displays:

- Four records from `homepage_counters`
- All active partners ordered by `sort_order`
- Three newest published events ordered by `event_date DESC, id DESC`

## 3. Add the homepage models

Add:

```text
app/Models/HomeCounter.php
app/Models/BusinessPartner.php
```

Also replace:

```text
app/Models/Event.php
```

The Event model now includes `latestPublished(3)`.

## 4. Add the admin controllers

Add:

```text
app/Controllers/Admin/CounterController.php
app/Controllers/Admin/PartnerController.php
```

Replace:

```text
app/Controllers/Admin/DashboardController.php
admin/index.php
```

## 5. Add the admin views

Add:

```text
app/Views/admin/counters/index.php
app/Views/admin/partners/index.php
app/Views/admin/partners/form.php
```

Replace:

```text
app/Views/admin/dashboard.php
app/Views/admin/layouts/app.php
```

## 6. Replace security/configuration files

Replace:

```text
app/Core/ImageUploader.php
app/Core/Validator.php
config/app.php
tools/database_check.php
```

The image uploader now supports separate secure upload roots for events and partner logos.

## 7. Add the secure partner upload directory

Add this folder and file:

```text
uploads/partners/.htaccess
```

Make `uploads/partners/` writable by PHP.

## 8. Test

Open:

```text
/admin/index.php?action=counters
/admin/index.php?action=partners
/index.php
```

Create a partner, update the four counter numbers, and publish an event. The homepage should update automatically.
