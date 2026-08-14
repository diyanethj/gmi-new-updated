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
use Gmg\Events\Models\AboutMember;
use Gmg\Events\Models\AboutTeam;
use PDO;
use Throwable;

final class AboutController extends Controller
{
    private PDO $db;
    private AboutMember $members;
    private AboutTeam $teams;
    private ImageUploader $memberUploader;
    private ImageUploader $teamUploader;

    public function __construct()
    {
        $this->db = Database::connection();
        $this->members = new AboutMember($this->db);
        $this->teams = new AboutTeam($this->db);
        $this->memberUploader = new ImageUploader(
            (string) config('about_member_upload_directory'),
            (string) config('about_member_upload_public_prefix')
        );
        $this->teamUploader = new ImageUploader(
            (string) config('about_team_upload_directory'),
            (string) config('about_team_upload_public_prefix')
        );
    }

    public function index(): void
    {
        Auth::requireLogin();
        $this->render('admin/about/index', [
            'directorCount' => $this->members->countActiveByType('director'),
            'managementCount' => $this->members->countActiveByType('management'),
            'teamCount' => $this->teams->countActive(),
        ], 'admin/layouts/app');
    }

    public function directors(): void { $this->memberIndex('director'); }
    public function directorsCreate(): void { $this->memberCreate('director'); }
    public function directorsStore(): void { $this->memberStore('director'); }
    public function directorsEdit(): void { $this->memberEdit('director'); }
    public function directorsUpdate(): void { $this->memberUpdate('director'); }
    public function directorsDelete(): void { $this->memberDelete('director'); }
    public function directorsOrder(): void { $this->memberOrder('director'); }

    public function management(): void { $this->memberIndex('management'); }
    public function managementCreate(): void { $this->memberCreate('management'); }
    public function managementStore(): void { $this->memberStore('management'); }
    public function managementEdit(): void { $this->memberEdit('management'); }
    public function managementUpdate(): void { $this->memberUpdate('management'); }
    public function managementDelete(): void { $this->memberDelete('management'); }
    public function managementOrder(): void { $this->memberOrder('management'); }

    public function teams(): void
    {
        Auth::requirePermission('about.teams.view');
        $this->render('admin/about/teams-index', [
            'teams' => $this->teams->adminAll(),
        ], 'admin/layouts/app');
    }

    public function teamsCreate(): void
    {
        Auth::requirePermission('about.teams.create');
        $this->render('admin/about/team-form', ['team' => null], 'admin/layouts/app');
        clear_form_state();
    }

    public function teamsStore(): void
    {
        Auth::requirePermission('about.teams.create');
        Csrf::requireValid();

        $data = $this->teamInput();
        $errors = Validator::aboutTeam($data, true);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('about-teams-create'));
        }

        $uploadedPath = null;
        try {
            $uploadedPath = $this->teamUploader->uploadOne($_FILES['team_image'] ?? []);
            $id = $this->teams->create(array_merge($data, [
                'image_path' => $uploadedPath,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]));
            AuditLogger::log('create', 'about_team', $id, ['company_name' => $data['company_name']]);
            clear_form_state();
            flash('success', 'Company team created successfully.');
            redirect(admin_url('about-teams'));
        } catch (Throwable $exception) {
            if ($uploadedPath !== null) {
                $this->teamUploader->delete($uploadedPath);
            }
            error_log('About team create failed: ' . $exception->getMessage());
            remember_form($data, ['team_image' => [$exception->getMessage()]]);
            flash('error', 'The company team could not be created. ' . $exception->getMessage());
            redirect(admin_url('about-teams-create'));
        }
    }

    public function teamsEdit(): void
    {
        Auth::requirePermission('about.teams.edit');
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $team = $id ? $this->teams->find($id) : null;
        if (!$team) {
            $this->abort(404, 'Company team not found.');
        }
        $this->render('admin/about/team-form', ['team' => $team], 'admin/layouts/app');
        clear_form_state();
    }

    public function teamsUpdate(): void
    {
        Auth::requirePermission('about.teams.edit');
        Csrf::requireValid();

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $team = $id ? $this->teams->find($id) : null;
        if (!$team) {
            flash('error', 'Company team not found.');
            redirect(admin_url('about-teams'));
        }

        $data = $this->teamInput();
        $errors = Validator::aboutTeam($data, false);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('about-teams-edit', ['id' => $id]));
        }

        $newPath = null;
        try {
            $hasReplacement = isset($_FILES['team_image'])
                && (int) ($_FILES['team_image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;
            if ($hasReplacement) {
                $newPath = $this->teamUploader->uploadOne($_FILES['team_image']);
            }

            $this->teams->update((int) $id, array_merge($data, [
                'image_path' => $newPath ?? (string) $team['image_path'],
                'updated_by' => Auth::id(),
            ]));

            if ($newPath !== null) {
                $this->teamUploader->delete((string) $team['image_path']);
            }

            AuditLogger::log('update', 'about_team', (int) $id, ['company_name' => $data['company_name']]);
            clear_form_state();
            flash('success', 'Company team updated successfully.');
            redirect(admin_url('about-teams'));
        } catch (Throwable $exception) {
            if ($newPath !== null) {
                $this->teamUploader->delete($newPath);
            }
            error_log('About team update failed: ' . $exception->getMessage());
            remember_form($data, ['team_image' => [$exception->getMessage()]]);
            flash('error', 'The company team could not be updated. ' . $exception->getMessage());
            redirect(admin_url('about-teams-edit', ['id' => $id]));
        }
    }

    public function teamsDelete(): void
    {
        Auth::requirePermission('about.teams.delete');
        Csrf::requireValid();

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $team = $id ? $this->teams->find($id) : null;
        if (!$team) {
            flash('error', 'Company team not found.');
            redirect(admin_url('about-teams'));
        }

        try {
            $this->teams->delete((int) $id);
            $this->teamUploader->delete((string) $team['image_path']);
            AuditLogger::log('delete', 'about_team', (int) $id, ['company_name' => $team['company_name']]);
            flash('success', 'Company team deleted successfully.');
        } catch (Throwable $exception) {
            error_log('About team delete failed: ' . $exception->getMessage());
            flash('error', 'The company team could not be deleted.');
        }
        redirect(admin_url('about-teams'));
    }

    public function teamsOrder(): void
    {
        Auth::requirePermission('about.teams.order');
        Csrf::requireValid();

        $submitted = $_POST['sort_order'] ?? [];
        if (!is_array($submitted)) {
            flash('error', 'Invalid company team order.');
            redirect(admin_url('about-teams'));
        }

        $orders = $this->validatedOrders(
            $submitted,
            array_map(static fn(array $item): int => (int) $item['id'], $this->teams->adminAll()),
            'company team',
            'about-teams'
        );
        $this->teams->updateOrders($orders, (int) Auth::id());
        AuditLogger::log('reorder', 'about_team', null, ['count' => count($orders)]);
        flash('success', 'Company team order updated successfully.');
        redirect(admin_url('about-teams'));
    }

    private function memberIndex(string $type): void
    {
        Auth::requirePermission($type === 'director' ? 'about.directors.view' : 'about.management.view');
        $this->render('admin/about/members-index', [
            'memberType' => $type,
            'members' => $this->members->adminByType($type),
            'sectionTitle' => $this->memberTitle($type),
            'routePrefix' => $this->memberRoutePrefix($type),
        ], 'admin/layouts/app');
    }

    private function memberCreate(string $type): void
    {
        Auth::requirePermission($type === 'director' ? 'about.directors.create' : 'about.management.create');
        $this->render('admin/about/member-form', [
            'member' => null,
            'memberType' => $type,
            'sectionTitle' => $this->memberTitle($type),
            'routePrefix' => $this->memberRoutePrefix($type),
        ], 'admin/layouts/app');
        clear_form_state();
    }

    private function memberStore(string $type): void
    {
        Auth::requirePermission($type === 'director' ? 'about.directors.create' : 'about.management.create');
        Csrf::requireValid();

        $data = $this->memberInput($type);
        $errors = Validator::aboutMember($data, true);
        $routePrefix = $this->memberRoutePrefix($type);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url($routePrefix . '-create'));
        }

        $uploadedPath = null;
        try {
            $uploadedPath = $this->memberUploader->uploadOne($_FILES['member_image'] ?? []);
            $id = $this->members->create(array_merge($data, [
                'image_path' => $uploadedPath,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]));
            AuditLogger::log('create', 'about_member', $id, ['type' => $type, 'name' => $data['name']]);
            clear_form_state();
            flash('success', $this->memberSingular($type) . ' created successfully.');
            redirect(admin_url($routePrefix));
        } catch (Throwable $exception) {
            if ($uploadedPath !== null) {
                $this->memberUploader->delete($uploadedPath);
            }
            error_log('About member create failed: ' . $exception->getMessage());
            remember_form($data, ['member_image' => [$exception->getMessage()]]);
            flash('error', 'The record could not be created. ' . $exception->getMessage());
            redirect(admin_url($routePrefix . '-create'));
        }
    }

    private function memberEdit(string $type): void
    {
        Auth::requirePermission($type === 'director' ? 'about.directors.edit' : 'about.management.edit');
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $member = $id ? $this->members->find($id) : null;
        if (!$member || $member['member_type'] !== $type) {
            $this->abort(404, $this->memberSingular($type) . ' not found.');
        }
        $this->render('admin/about/member-form', [
            'member' => $member,
            'memberType' => $type,
            'sectionTitle' => $this->memberTitle($type),
            'routePrefix' => $this->memberRoutePrefix($type),
        ], 'admin/layouts/app');
        clear_form_state();
    }

    private function memberUpdate(string $type): void
    {
        Auth::requirePermission($type === 'director' ? 'about.directors.edit' : 'about.management.edit');
        Csrf::requireValid();

        $routePrefix = $this->memberRoutePrefix($type);
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $member = $id ? $this->members->find($id) : null;
        if (!$member || $member['member_type'] !== $type) {
            flash('error', $this->memberSingular($type) . ' not found.');
            redirect(admin_url($routePrefix));
        }

        $data = $this->memberInput($type);
        $errors = Validator::aboutMember($data, false);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url($routePrefix . '-edit', ['id' => $id]));
        }

        $newPath = null;
        try {
            $hasReplacement = isset($_FILES['member_image'])
                && (int) ($_FILES['member_image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;
            if ($hasReplacement) {
                $newPath = $this->memberUploader->uploadOne($_FILES['member_image']);
            }

            $this->members->update((int) $id, array_merge($data, [
                'image_path' => $newPath ?? (string) $member['image_path'],
                'updated_by' => Auth::id(),
            ]));

            if ($newPath !== null) {
                $this->memberUploader->delete((string) $member['image_path']);
            }

            AuditLogger::log('update', 'about_member', (int) $id, ['type' => $type, 'name' => $data['name']]);
            clear_form_state();
            flash('success', $this->memberSingular($type) . ' updated successfully.');
            redirect(admin_url($routePrefix));
        } catch (Throwable $exception) {
            if ($newPath !== null) {
                $this->memberUploader->delete($newPath);
            }
            error_log('About member update failed: ' . $exception->getMessage());
            remember_form($data, ['member_image' => [$exception->getMessage()]]);
            flash('error', 'The record could not be updated. ' . $exception->getMessage());
            redirect(admin_url($routePrefix . '-edit', ['id' => $id]));
        }
    }

    private function memberDelete(string $type): void
    {
        Auth::requirePermission($type === 'director' ? 'about.directors.delete' : 'about.management.delete');
        Csrf::requireValid();

        $routePrefix = $this->memberRoutePrefix($type);
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $member = $id ? $this->members->find($id) : null;
        if (!$member || $member['member_type'] !== $type) {
            flash('error', $this->memberSingular($type) . ' not found.');
            redirect(admin_url($routePrefix));
        }

        try {
            $this->members->delete((int) $id);
            $this->memberUploader->delete((string) $member['image_path']);
            AuditLogger::log('delete', 'about_member', (int) $id, ['type' => $type, 'name' => $member['name']]);
            flash('success', $this->memberSingular($type) . ' deleted successfully.');
        } catch (Throwable $exception) {
            error_log('About member delete failed: ' . $exception->getMessage());
            flash('error', 'The record could not be deleted.');
        }
        redirect(admin_url($routePrefix));
    }

    private function memberOrder(string $type): void
    {
        Auth::requirePermission($type === 'director' ? 'about.directors.order' : 'about.management.order');
        Csrf::requireValid();

        $routePrefix = $this->memberRoutePrefix($type);
        $submitted = $_POST['sort_order'] ?? [];
        if (!is_array($submitted)) {
            flash('error', 'Invalid display order.');
            redirect(admin_url($routePrefix));
        }

        $orders = $this->validatedOrders(
            $submitted,
            array_map(static fn(array $item): int => (int) $item['id'], $this->members->adminByType($type)),
            strtolower($this->memberSingular($type)),
            $routePrefix
        );
        $this->members->updateOrders($type, $orders, (int) Auth::id());
        AuditLogger::log('reorder', 'about_member', null, ['type' => $type, 'count' => count($orders)]);
        flash('success', $this->memberTitle($type) . ' order updated successfully.');
        redirect(admin_url($routePrefix));
    }

    private function memberInput(string $type): array
    {
        $sortOrder = trim((string) ($_POST['sort_order'] ?? ''));
        return [
            'member_type' => $type,
            'name' => trim((string) ($_POST['name'] ?? '')),
            'position' => trim((string) ($_POST['position'] ?? '')),
            'status' => (string) ($_POST['status'] ?? 'active'),
            'sort_order' => $sortOrder === '' ? 9999 : (int) $sortOrder,
        ];
    }

    private function teamInput(): array
    {
        $sortOrder = trim((string) ($_POST['sort_order'] ?? ''));
        return [
            'company_name' => trim((string) ($_POST['company_name'] ?? '')),
            'status' => (string) ($_POST['status'] ?? 'active'),
            'sort_order' => $sortOrder === '' ? 9999 : (int) $sortOrder,
        ];
    }

    private function validatedOrders(array $submitted, array $existingIds, string $label, string $redirectAction): array
    {
        $orders = [];
        foreach ($existingIds as $id) {
            $raw = trim((string) ($submitted[$id] ?? ''));
            if ($raw === '' || !ctype_digit($raw) || (int) $raw < 1 || (int) $raw > 9999) {
                flash('error', 'Each ' . $label . ' order must be a number from 1 to 9999.');
                redirect(admin_url($redirectAction));
            }
            $orders[$id] = (int) $raw;
        }
        return $orders;
    }

    private function memberRoutePrefix(string $type): string
    {
        return $type === 'director' ? 'about-directors' : 'about-management';
    }

    private function memberTitle(string $type): string
    {
        return $type === 'director' ? 'Board of Directors' : 'Management Team';
    }

    private function memberSingular(string $type): string
    {
        return $type === 'director' ? 'Director' : 'Management team member';
    }
}
