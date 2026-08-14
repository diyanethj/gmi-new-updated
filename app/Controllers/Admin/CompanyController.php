<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\AuditLogger;
use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\Database;
use Gmg\Events\Core\ImageUploader;
use Gmg\Events\Core\Validator;
use Gmg\Events\Models\WebsiteCompany;
use PDO;
use Throwable;

final class CompanyController extends Controller
{
    private PDO $db;
    private WebsiteCompany $companies;
    private ImageUploader $uploader;

    public function __construct()
    {
        $this->db = Database::connection();
        $this->companies = new WebsiteCompany($this->db);
        $this->uploader = new ImageUploader(
            (string) config('company_upload_directory'),
            (string) config('company_upload_public_prefix')
        );
    }

    public function index(): void
    {
        Auth::requirePermission('companies.view');
        $this->render('admin/companies/index', [
            'companies' => $this->companies->adminAll(),
        ], 'admin/layouts/app');
    }

    public function create(): void
    {
        Auth::requirePermission('companies.create');
        $this->render('admin/companies/form', ['company' => null], 'admin/layouts/app');
    }

    public function store(): void
    {
        Auth::requirePermission('companies.create');
        Csrf::requireValid();

        $data = $this->input();
        $errors = Validator::websiteCompany($data, true);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('companies-create'));
        }

        $uploadedPath = null;
        try {
            $uploadedPath = $this->uploader->uploadOne($_FILES['company_image'] ?? []);
            $id = $this->companies->create(array_merge($data, [
                'image_path' => $uploadedPath,
                'sort_order' => (int) $data['sort_order'],
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]));
            AuditLogger::log('create', 'website_company', $id, ['company_name' => $data['company_name']]);
            clear_form_state();
            flash('success', 'Company created successfully.');
            redirect(admin_url('companies'));
        } catch (Throwable $exception) {
            if ($uploadedPath !== null) {
                $this->uploader->delete($uploadedPath);
            }
            error_log('Company create failed: ' . $exception->getMessage());
            remember_form($data, ['company_image' => [$exception->getMessage()]]);
            flash('error', 'The company could not be created. The name may already exist.');
            redirect(admin_url('companies-create'));
        }
    }

    public function edit(): void
    {
        Auth::requirePermission('companies.edit');
        $company = $this->requiredCompany();
        $this->render('admin/companies/form', ['company' => $company], 'admin/layouts/app');
    }

    public function update(): void
    {
        Auth::requirePermission('companies.edit');
        Csrf::requireValid();

        $company = $this->requiredCompany(true);
        $data = $this->input();
        $errors = Validator::websiteCompany($data, false);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('companies-edit', ['id' => $company['id']]));
        }

        $oldPath = (string) $company['image_path'];
        $newPath = $oldPath;
        $uploadedPath = null;

        try {
            if (!empty($_FILES['company_image']['name'])) {
                $uploadedPath = $this->uploader->uploadOne($_FILES['company_image']);
                $newPath = $uploadedPath;
            }

            $this->companies->update((int) $company['id'], array_merge($data, [
                'image_path' => $newPath,
                'sort_order' => (int) $data['sort_order'],
                'updated_by' => Auth::id(),
            ]));

            if ($uploadedPath !== null) {
                $this->uploader->delete($oldPath);
            }

            AuditLogger::log('update', 'website_company', (int) $company['id'], ['company_name' => $data['company_name']]);
            clear_form_state();
            flash('success', 'Company updated successfully.');
            redirect(admin_url('companies'));
        } catch (Throwable $exception) {
            if ($uploadedPath !== null) {
                $this->uploader->delete($uploadedPath);
            }
            error_log('Company update failed: ' . $exception->getMessage());
            remember_form($data, ['company_image' => [$exception->getMessage()]]);
            flash('error', 'The company could not be updated. The name may already exist.');
            redirect(admin_url('companies-edit', ['id' => $company['id']]));
        }
    }

    public function delete(): void
    {
        Auth::requirePermission('companies.delete');
        Csrf::requireValid();
        $company = $this->requiredCompany(true);
        $this->companies->delete((int) $company['id']);
        $this->uploader->delete((string) $company['image_path']);
        AuditLogger::log('delete', 'website_company', (int) $company['id'], ['company_name' => $company['company_name']]);
        flash('success', 'Company deleted successfully.');
        redirect(admin_url('companies'));
    }

    public function order(): void
    {
        Auth::requirePermission('companies.order');
        Csrf::requireValid();
        $raw = $_POST['sort_order'] ?? [];
        $orders = [];
        if (is_array($raw)) {
            foreach ($raw as $id => $order) {
                if (ctype_digit((string) $id) && ctype_digit((string) $order)) {
                    $value = (int) $order;
                    if ($value >= 1 && $value <= 9999) {
                        $orders[(int) $id] = $value;
                    }
                }
            }
        }
        $this->companies->updateOrders($orders, (int) Auth::id());
        AuditLogger::log('order', 'website_company', null, ['count' => count($orders)]);
        flash('success', 'Company order updated.');
        redirect(admin_url('companies'));
    }

    private function input(): array
    {
        return [
            'company_name' => trim((string) ($_POST['company_name'] ?? '')),
            'website_url' => trim((string) ($_POST['website_url'] ?? '')),
            'status' => (string) ($_POST['status'] ?? 'active'),
            'sort_order' => trim((string) ($_POST['sort_order'] ?? '1')),
        ];
    }

    private function requiredCompany(bool $post = false): array
    {
        $id = $post
            ? filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)
            : filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $company = $id ? $this->companies->find((int) $id) : null;
        if (!$company) {
            $this->abort(404, 'Company not found.');
        }
        return $company;
    }
}
