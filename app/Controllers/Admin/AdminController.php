<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\AuditLogger;
use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\Database;
use Gmg\Events\Core\Validator;
use Gmg\Events\Models\Admin;

final class AdminController extends Controller
{
    private Admin $admins;

    public function __construct()
    {
        $this->admins = new Admin(Database::connection());
    }

    public function index(): void
    {
        Auth::requireSuperAdmin();
        $this->render('admin/admins/index', ['admins' => $this->admins->all()], 'admin/layouts/app');
        clear_form_state();
    }

    public function store(): void
    {
        Auth::requireSuperAdmin();
        Csrf::requireValid();

        $data = [
            'username' => trim((string) ($_POST['username'] ?? '')),
            'email' => text_lower(trim((string) ($_POST['email'] ?? ''))),
            'password' => (string) ($_POST['password'] ?? ''),
            'password_confirmation' => (string) ($_POST['password_confirmation'] ?? ''),
            'role' => (string) ($_POST['role'] ?? 'admin'),
        ];
        $errors = Validator::admin($data);
        if ($this->admins->existsByUsernameOrEmail($data['username'], $data['email'])) {
            $errors['username'][] = 'That username or email is already in use.';
        }
        if ($errors !== []) {
            remember_form(['username' => $data['username'], 'email' => $data['email'], 'role' => $data['role']], $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('admins'));
        }

        $id = $this->admins->create($data, Auth::id());
        AuditLogger::log('create', 'admin', $id, ['username' => $data['username'], 'role' => $data['role']]);
        clear_form_state();
        flash('success', 'Administrator created successfully.');
        redirect(admin_url('admins'));
    }

    public function delete(): void
    {
        Auth::requireSuperAdmin();
        Csrf::requireValid();
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            flash('error', 'Invalid administrator.');
            redirect(admin_url('admins'));
        }
        if ($id === Auth::id()) {
            flash('error', 'You cannot delete your own account.');
            redirect(admin_url('admins'));
        }

        $admin = $this->admins->find($id);
        if (!$admin) {
            flash('error', 'Administrator not found.');
            redirect(admin_url('admins'));
        }
        if ($admin['role'] === 'super_admin' && $this->admins->countSuperAdmins() <= 1) {
            flash('error', 'The final super administrator cannot be deleted.');
            redirect(admin_url('admins'));
        }

        $this->admins->delete($id);
        AuditLogger::log('delete', 'admin', $id, ['username' => $admin['username']]);
        flash('success', 'Administrator deleted.');
        redirect(admin_url('admins'));
    }
}
