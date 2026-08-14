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
use Gmg\Events\Models\BusinessPartner;
use PDO;
use Throwable;

final class PartnerController extends Controller
{
    private PDO $db;
    private BusinessPartner $partners;
    private ImageUploader $uploader;

    public function __construct()
    {
        $this->db = Database::connection();
        $this->partners = new BusinessPartner($this->db);
        $this->uploader = new ImageUploader(
            (string) config('partner_upload_directory'),
            (string) config('partner_upload_public_prefix')
        );
    }

    public function index(): void
    {
        Auth::requirePermission('partners.view');
        $this->render(
            'admin/partners/index',
            ['partners' => $this->partners->adminAll()],
            'admin/layouts/app'
        );
    }

    public function create(): void
    {
        Auth::requirePermission('partners.create');
        $this->render(
            'admin/partners/form',
            ['partner' => null],
            'admin/layouts/app'
        );
        clear_form_state();
    }

    public function store(): void
    {
        Auth::requirePermission('partners.create');
        Csrf::requireValid();

        $data = $this->partnerInput();
        $errors = Validator::partner($data, true);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('partners-create'));
        }

        $uploadedPath = null;
        try {
            $uploadedPath = $this->uploader->uploadOne($_FILES['partner_image'] ?? []);
            $partnerId = $this->partners->create(array_merge($data, [
                'image_path' => $uploadedPath,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]));
            AuditLogger::log('create', 'business_partner', $partnerId, ['name' => $data['name']]);
            clear_form_state();
            flash('success', 'Business partner created successfully.');
            redirect(admin_url('partners'));
        } catch (Throwable $exception) {
            if ($uploadedPath !== null) {
                $this->uploader->delete($uploadedPath);
            }
            error_log('Partner create failed: ' . $exception->getMessage());
            remember_form($data, ['partner_image' => [$exception->getMessage()]]);
            flash('error', 'The partner could not be created. ' . $exception->getMessage());
            redirect(admin_url('partners-create'));
        }
    }

    public function edit(): void
    {
        Auth::requirePermission('partners.edit');
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $partner = $id ? $this->partners->find($id) : null;
        if (!$partner) {
            $this->abort(404, 'Business partner not found.');
        }
        $this->render(
            'admin/partners/form',
            ['partner' => $partner],
            'admin/layouts/app'
        );
        clear_form_state();
    }

    public function update(): void
    {
        Auth::requirePermission('partners.edit');
        Csrf::requireValid();

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $partner = $id ? $this->partners->find($id) : null;
        if (!$partner) {
            flash('error', 'Business partner not found.');
            redirect(admin_url('partners'));
        }

        $data = $this->partnerInput();
        $errors = Validator::partner($data, false);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('partners-edit', ['id' => $id]));
        }

        $newPath = null;
        try {
            $hasReplacement = isset($_FILES['partner_image'])
                && (int) ($_FILES['partner_image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;

            if ($hasReplacement) {
                $newPath = $this->uploader->uploadOne($_FILES['partner_image']);
            }

            $imagePath = $newPath ?? (string) $partner['image_path'];
            $this->partners->update((int) $id, array_merge($data, [
                'image_path' => $imagePath,
                'updated_by' => Auth::id(),
            ]));

            if ($newPath !== null) {
                $this->uploader->delete((string) $partner['image_path']);
            }

            AuditLogger::log('update', 'business_partner', (int) $id, ['name' => $data['name']]);
            clear_form_state();
            flash('success', 'Business partner updated successfully.');
            redirect(admin_url('partners'));
        } catch (Throwable $exception) {
            if ($newPath !== null) {
                $this->uploader->delete($newPath);
            }
            error_log('Partner update failed: ' . $exception->getMessage());
            remember_form($data, ['partner_image' => [$exception->getMessage()]]);
            flash('error', 'The partner could not be updated. ' . $exception->getMessage());
            redirect(admin_url('partners-edit', ['id' => $id]));
        }
    }

    public function delete(): void
    {
        Auth::requirePermission('partners.delete');
        Csrf::requireValid();

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $partner = $id ? $this->partners->find($id) : null;
        if (!$partner) {
            flash('error', 'Business partner not found.');
            redirect(admin_url('partners'));
        }

        try {
            $this->partners->delete((int) $id);
            $this->uploader->delete((string) $partner['image_path']);
            AuditLogger::log('delete', 'business_partner', (int) $id, ['name' => $partner['name']]);
            flash('success', 'Business partner deleted successfully.');
        } catch (Throwable $exception) {
            error_log('Partner delete failed: ' . $exception->getMessage());
            flash('error', 'The partner could not be deleted.');
        }

        redirect(admin_url('partners'));
    }

    public function order(): void
    {
        Auth::requirePermission('partners.order');
        Csrf::requireValid();

        $submitted = $_POST['sort_order'] ?? [];
        if (!is_array($submitted)) {
            flash('error', 'Invalid partner order.');
            redirect(admin_url('partners'));
        }

        $existingIds = array_map(
            static fn(array $partner): int => (int) $partner['id'],
            $this->partners->adminAll()
        );
        $orders = [];
        foreach ($existingIds as $id) {
            $raw = trim((string) ($submitted[$id] ?? ''));
            if ($raw === '' || !ctype_digit($raw) || (int) $raw < 1 || (int) $raw > 9999) {
                flash('error', 'Each partner order must be a number from 1 to 9999.');
                redirect(admin_url('partners'));
            }
            $orders[$id] = (int) $raw;
        }

        $this->partners->updateOrders($orders, (int) Auth::id());
        AuditLogger::log('reorder', 'business_partner', null, ['count' => count($orders)]);
        flash('success', 'Business partner order updated successfully.');
        redirect(admin_url('partners'));
    }

    private function partnerInput(): array
    {
        $sortOrder = trim((string) ($_POST['sort_order'] ?? ''));
        return [
            'name' => trim((string) ($_POST['name'] ?? '')),
            'alt_text' => trim((string) ($_POST['alt_text'] ?? '')),
            'website_url' => trim((string) ($_POST['website_url'] ?? '')),
            'status' => (string) ($_POST['status'] ?? 'active'),
            'sort_order' => $sortOrder === '' ? 9999 : (int) $sortOrder,
        ];
    }
}
