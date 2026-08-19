<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\AuditLogger;
use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\Database;
use Gmg\Events\Core\Validator;
use Gmg\Events\Models\JobVacancy;

final class CareerController extends Controller
{
    private JobVacancy $vacancies;

    public function __construct()
    {
        $this->vacancies = new JobVacancy(Database::connection());
    }

    public function index(): void
    {
        Auth::requirePermission('careers.vacancies.view');

        $companyFilter = strtoupper(trim((string) ($_GET['company'] ?? '')));
        if (!in_array($companyFilter, ['GMG', 'GMS'], true)) {
            $companyFilter = '';
        }

        $this->render(
            'admin/careers/vacancies-index',
            [
                'vacancies' => $this->vacancies->adminAll($companyFilter),
                'companyFilter' => $companyFilter,
            ],
            'admin/layouts/app'
        );

        clear_form_state();
    }

    public function create(): void
    {
        Auth::requirePermission('careers.vacancies.create');
        $this->render('admin/careers/vacancy-form', ['vacancy' => null], 'admin/layouts/app');
    }

    public function store(): void
    {
        Auth::requirePermission('careers.vacancies.create');
        Csrf::requireValid();
        $data = $this->input();
        $errors = Validator::vacancy($data);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('careers-vacancies-create'));
        }
        $data['sort_order'] = (int) $data['sort_order'];
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();
        $id = $this->vacancies->create($data);
        AuditLogger::log('create', 'job_vacancy', $id, ['position' => $data['position'], 'company' => $data['company'], 'company_name' => $data['company_name']]);
        clear_form_state();
        flash('success', 'Vacancy created successfully.');
        redirect(admin_url('careers-vacancies'));
    }

    public function edit(): void
    {
        Auth::requirePermission('careers.vacancies.edit');
        $vacancy = $this->requiredVacancy();
        $this->render('admin/careers/vacancy-form', ['vacancy' => $vacancy], 'admin/layouts/app');
    }

    public function update(): void
    {
        Auth::requirePermission('careers.vacancies.edit');
        Csrf::requireValid();
        $vacancy = $this->requiredVacancy(true);
        $data = $this->input();
        $errors = Validator::vacancy($data);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('careers-vacancies-edit', ['id' => $vacancy['id']]));
        }
        $data['sort_order'] = (int) $data['sort_order'];
        $data['updated_by'] = Auth::id();
        $this->vacancies->update((int) $vacancy['id'], $data);
        AuditLogger::log('update', 'job_vacancy', (int) $vacancy['id'], ['position' => $data['position'], 'company' => $data['company'], 'company_name' => $data['company_name']]);
        clear_form_state();
        flash('success', 'Vacancy updated successfully.');
        redirect(admin_url('careers-vacancies'));
    }

    public function delete(): void
    {
        Auth::requirePermission('careers.vacancies.delete');
        Csrf::requireValid();
        $vacancy = $this->requiredVacancy(true);
        $this->vacancies->delete((int) $vacancy['id']);
        AuditLogger::log('delete', 'job_vacancy', (int) $vacancy['id'], ['position' => $vacancy['position']]);
        flash('success', 'Vacancy deleted. Existing applications remain available with the saved vacancy details.');
        redirect(admin_url('careers-vacancies'));
    }

    public function order(): void
    {
        Auth::requirePermission('careers.vacancies.order');
        Csrf::requireValid();
        $raw = $_POST['order'] ?? [];
        $orders = [];
        if (is_array($raw)) {
            foreach ($raw as $id => $order) {
                if (ctype_digit((string) $id) && ctype_digit((string) $order) && (int) $order >= 1 && (int) $order <= 9999) {
                    $orders[(int) $id] = (int) $order;
                }
            }
        }
        $this->vacancies->updateOrders($orders, (int) Auth::id());
        AuditLogger::log('order', 'job_vacancy', null, ['count' => count($orders)]);
        flash('success', 'Vacancy order updated.');

        $companyFilter = strtoupper(trim((string) ($_POST['company_filter'] ?? '')));
        if (in_array($companyFilter, ['GMG', 'GMS'], true)) {
            redirect(admin_url('careers-vacancies', ['company' => $companyFilter]));
        }

        redirect(admin_url('careers-vacancies'));
    }

    private function input(): array
    {
        return [
            'company' => (string) ($_POST['company'] ?? ''),
            'company_name' => trim((string) ($_POST['company_name'] ?? '')),
            'position' => trim((string) ($_POST['position'] ?? '')),
            'responsibilities' => trim((string) ($_POST['responsibilities'] ?? '')),
            'qualifications' => trim((string) ($_POST['qualifications'] ?? '')),
            'status' => (string) ($_POST['status'] ?? 'active'),
            'sort_order' => trim((string) ($_POST['sort_order'] ?? '1')),
        ];
    }

    private function requiredVacancy(bool $post = false): array
    {
        $id = $post ? filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) : filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $vacancy = $id ? $this->vacancies->find((int) $id) : null;
        if (!$vacancy) {
            $this->abort(404, 'Vacancy not found.');
        }
        return $vacancy;
    }
}
