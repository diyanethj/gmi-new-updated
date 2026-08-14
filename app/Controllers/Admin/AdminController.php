<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\AuditLogger;
use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\Database;
use Gmg\Events\Core\Permission;
use Gmg\Events\Core\Validator;
use Gmg\Events\Models\Admin;
use Gmg\Events\Models\AdminPermission;

final class AdminController extends Controller
{
    private Admin $admins;
    private AdminPermission $permissions;

    public function __construct()
    {
        $db = Database::connection();
        $this->admins = new Admin($db);
        $this->permissions = new AdminPermission($db);
    }

    public function index(): void
    {
        Auth::requirePermission('admins.view');
        $records = Auth::isSuperAdmin() ? $this->admins->all() : $this->admins->createdBy((int) Auth::id());
        foreach ($records as &$record) {
            $record['permissions'] = $record['role'] === 'super_admin' ? Permission::keys() : $this->permissions->forAdmin((int) $record['id']);
        }
        unset($record);
        $this->render('admin/admins/index', [
            'admins' => $records,
            'permissionGroups' => Permission::groups(),
        ], 'admin/layouts/app');
        clear_form_state();
    }

    public function create(): void
    {
        Auth::requirePermission('admins.create');
        $this->render('admin/admins/form', [
            'admin' => null,
            'permissionGroups' => $this->assignablePermissionGroups(),
            'selectedPermissions' => [],
        ], 'admin/layouts/app');
    }

    public function store(): void
    {
        Auth::requirePermission('admins.create');
        Csrf::requireValid();

        $data = $this->input(true);
        if (!Auth::isSuperAdmin()) {
            $data['role'] = 'admin';
        }
        $errors = Validator::adminUpdate($data, true);
        if ($this->admins->existsByUsernameOrEmail($data['username'], $data['email'])) {
            $errors['username'][] = 'That username or email is already in use.';
        }

        $selected = $this->allowedSubmittedPermissions();
        if ($errors !== []) {
            remember_form(array_merge($data, ['permissions' => $selected]), $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('admins-create'));
        }

        $id = $this->admins->create($data, Auth::id());
        if ($data['role'] !== 'super_admin') {
            $this->permissions->replace($id, $selected, Auth::id());
        }
        AuditLogger::log('create', 'admin', $id, ['username' => $data['username'], 'role' => $data['role'], 'permissions' => $selected]);
        clear_form_state();
        flash('success', 'Administrator created successfully.');
        redirect(admin_url('admins'));
    }

    public function edit(): void
    {
        Auth::requirePermission('admins.edit');
        $admin = $this->requiredManageableAdmin(false);
        $this->render('admin/admins/form', [
            'admin' => $admin,
            'permissionGroups' => $this->assignablePermissionGroups(),
            'selectedPermissions' => $admin['role'] === 'super_admin' ? Permission::keys() : $this->permissions->forAdmin((int) $admin['id']),
        ], 'admin/layouts/app');
    }

    public function update(): void
    {
        Auth::requirePermission('admins.edit');
        Csrf::requireValid();
        $admin = $this->requiredManageableAdmin(true);
        $data = $this->input(false);

        if (!Auth::isSuperAdmin()) {
            $data['role'] = 'admin';
        }
        if ((int) $admin['id'] === (int) Auth::id()) {
            $data['is_active'] = '1';
            $data['role'] = $admin['role'];
        }

        $errors = Validator::adminUpdate($data, false);
        if ($this->admins->existsByUsernameOrEmail($data['username'], $data['email'], (int) $admin['id'])) {
            $errors['username'][] = 'That username or email is already in use.';
        }
        if ($admin['role'] === 'super_admin' && ($data['role'] !== 'super_admin' || $data['is_active'] !== '1') && $this->admins->countSuperAdmins() <= 1) {
            $errors['role'][] = 'The final active super administrator cannot be demoted or disabled.';
        }

        $selected = $this->allowedSubmittedPermissions();
        if ($errors !== []) {
            remember_form(array_merge($data, ['permissions' => $selected]), $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('admins-edit', ['id' => $admin['id']]));
        }

        $this->admins->update((int) $admin['id'], $data);
        if ($data['role'] === 'super_admin') {
            $this->permissions->replace((int) $admin['id'], [], Auth::id());
        } elseif (Auth::can('admins.permissions')) {
            $this->permissions->replace((int) $admin['id'], $selected, Auth::id());
        }
        AuditLogger::log('update', 'admin', (int) $admin['id'], ['username' => $data['username'], 'role' => $data['role'], 'permissions' => $selected]);
        clear_form_state();
        flash('success', 'Administrator updated successfully.');
        redirect(admin_url('admins'));
    }

    public function delete(): void
    {
        Auth::requirePermission('admins.delete');
        Csrf::requireValid();
        $admin = $this->requiredManageableAdmin(true);
        if ((int) $admin['id'] === (int) Auth::id()) {
            flash('error', 'You cannot delete your own account.');
            redirect(admin_url('admins'));
        }
        if ($admin['role'] === 'super_admin' && $this->admins->countSuperAdmins() <= 1) {
            flash('error', 'The final super administrator cannot be deleted.');
            redirect(admin_url('admins'));
        }
        $this->admins->delete((int) $admin['id']);
        AuditLogger::log('delete', 'admin', (int) $admin['id'], ['username' => $admin['username']]);
        flash('success', 'Administrator deleted.');
        redirect(admin_url('admins'));
    }

    private function input(bool $creating): array
    {
        return [
            'username' => trim((string) ($_POST['username'] ?? '')),
            'email' => text_lower(trim((string) ($_POST['email'] ?? ''))),
            'password' => (string) ($_POST['password'] ?? ''),
            'password_confirmation' => (string) ($_POST['password_confirmation'] ?? ''),
            'role' => (string) ($_POST['role'] ?? 'admin'),
            'is_active' => (string) ($_POST['is_active'] ?? '1'),
        ];
    }

    private function requiredManageableAdmin(bool $post): array
    {
        $id = $post ? filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) : filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $admin = $id ? $this->admins->find((int) $id) : null;
        if (!$admin) {
            $this->abort(404, 'Administrator not found.');
        }
        if (!$this->admins->canBeManagedBy($admin, (int) Auth::id(), Auth::isSuperAdmin())) {
            $this->abort(403, 'You can only manage administrators you created.');
        }
        return $admin;
    }

    /** @return list<string> */
    private function allowedSubmittedPermissions(): array
    {
        if (!Auth::can('admins.permissions')) {
            return [];
        }
        $submitted = is_array($_POST['permissions'] ?? null) ? $_POST['permissions'] : [];
        $clean = Permission::sanitize($submitted);
        if (Auth::isSuperAdmin()) {
            return $clean;
        }
        $own = array_flip(Auth::permissions());
        return array_values(array_filter($clean, static fn(string $permission): bool => isset($own[$permission])));
    }

    private function assignablePermissionGroups(): array
    {
        $groups = Permission::groups();
        if (Auth::isSuperAdmin()) {
            return $groups;
        }
        $own = array_flip(Auth::permissions());
        foreach ($groups as $group => $permissions) {
            $groups[$group] = array_filter($permissions, static fn(string $label, string $key): bool => isset($own[$key]), ARRAY_FILTER_USE_BOTH);
            if ($groups[$group] === []) {
                unset($groups[$group]);
            }
        }
        return $groups;
    }
}
