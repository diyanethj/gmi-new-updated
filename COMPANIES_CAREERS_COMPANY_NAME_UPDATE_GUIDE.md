# GMG Companies Page and Careers Company Name Update

This update adds a database-managed Companies page and adds a required company name to every GMG/GMS career vacancy and application.

## 1. Back up first

Back up the `gmigroup` database and the current website folder before replacing files.

## 2. Import the database migration

Import:

`database/companies_careers_company_name_upgrade.sql`

The migration:

- Creates `website_companies`.
- Seeds the nine companies currently displayed on `companies.php`.
- Adds `company_name` to `job_vacancies`.
- Adds `company_name` to `job_applications`.
- Converts existing `GMI` career group values to `GMS`.
- Fills older vacancies/applications with a default company name so no record is lost.
- Adds Companies-page permissions for existing normal administrators.

For a new installation, import:

`database/install_complete_latest.sql`

## 3. Public Companies page

Replace/add:

- `companies.php`
- `app/Controllers/PublicCompanyController.php`
- `app/Models/WebsiteCompany.php`
- `app/Views/public/companies.php`

The public page now shows both the company image and company name. Only active records are shown, ordered by `sort_order`.

## 4. Companies admin pages

Add:

- `app/Controllers/Admin/CompanyController.php`
- `app/Views/admin/companies/index.php`
- `app/Views/admin/companies/form.php`
- `uploads/companies/.htaccess`

Admin URL:

`/gmi-new/admin/index.php?action=companies`

Available actions:

- View companies
- Create company
- Edit company
- Delete company
- Activate/deactivate company
- Upload/replace image
- Enter company name
- Enter optional internal/external link
- Change display order

## 5. Careers update

Replace:

- `careers.php`
- `app/Controllers/PublicCareerController.php`
- `app/Controllers/Admin/CareerController.php`
- `app/Models/JobVacancy.php`
- `app/Models/JobApplication.php`
- `app/Views/public/careers.php`
- `app/Views/admin/careers/vacancy-form.php`
- `app/Views/admin/careers/vacancies-index.php`
- `app/Views/admin/careers/applications-index.php`
- `app/Views/admin/careers/application-view.php`

When creating or editing a vacancy, the administrator must now select:

1. Group: `GMG` or `GMS`
2. Company name: the exact recruiting company
3. Position, responsibilities, qualifications, status, and order

Example:

- Group: `GMS`
- Company name: `Global Marine Services`
- Position: `Operations Executive`

The company name is shown:

- On the public vacancy card
- In the application vacancy dropdown
- In the admin vacancy list
- In the application list
- In application details
- In the permanent application snapshot

## 6. Core and admin routing files

Replace:

- `admin/index.php`
- `app/Core/Permission.php`
- `app/Core/Validator.php`
- `app/Core/SchemaGuard.php`
- `app/Controllers/Admin/DashboardController.php`
- `app/Views/admin/dashboard.php`
- `app/Views/admin/layouts/app.php`
- `config/app.php`
- `tools/database_check.php`

New permission keys:

- `companies.view`
- `companies.create`
- `companies.edit`
- `companies.delete`
- `companies.order`

The permission check is enforced in the sidebar, action buttons, and controllers.

## 7. Upload directory

Create this folder if it does not already exist:

`uploads/companies`

It must be writable by PHP. Uploaded images are stored inside year/month folders and accept only validated JPG, PNG, and WEBP images up to 8 MB.

## 8. Base URL

For the WAMP path `C:\\wamp64\\www\\gmi-new`, set this in `config/app.php`:

```php
'base_url' => '/gmi-new',
```

## 9. Verification

Check:

- `/gmi-new/companies.php`
- `/gmi-new/careers.php`
- `/gmi-new/admin/index.php?action=companies`
- `/gmi-new/admin/index.php?action=careers-vacancies`
- `/gmi-new/tools/database_check.php`

Delete or block `tools/database_check.php` after testing.
