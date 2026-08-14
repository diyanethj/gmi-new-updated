<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\AuditLogger;
use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\CvUploader;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\JobApplication;

final class ApplicationController extends Controller
{
    private JobApplication $applications;
    private CvUploader $uploader;

    public function __construct()
    {
        $this->applications = new JobApplication(Database::connection());
        $this->uploader = new CvUploader();
    }

    public function index(): void
    {
        Auth::requirePermission('careers.applications.view');
        $this->render('admin/careers/applications-index', ['applications' => $this->applications->all()], 'admin/layouts/app');
    }

    public function view(): void
    {
        Auth::requirePermission('careers.applications.view');
        $application = $this->requiredApplication(false);
        $this->render('admin/careers/application-view', ['application' => $application], 'admin/layouts/app');
    }

    public function download(): void
    {
        Auth::requirePermission('careers.applications.download');
        $application = $this->requiredApplication(false);
        $path = $this->uploader->absolutePath((string) $application['cv_path']);
        if ($path === null) {
            $this->abort(404, 'CV file not found.');
        }
        AuditLogger::log('download', 'job_application', (int) $application['id']);
        $filename = preg_replace('/[^A-Za-z0-9._-]/', '_', (string) $application['original_cv_name']) ?: 'cv';
        header('Content-Type: ' . (string) $application['cv_mime']);
        header('Content-Length: ' . filesize($path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('X-Content-Type-Options: nosniff');
        readfile($path);
        exit;
    }

    public function delete(): void
    {
        Auth::requirePermission('careers.applications.delete');
        Csrf::requireValid();
        $application = $this->requiredApplication(true);
        $this->applications->delete((int) $application['id']);
        $this->uploader->delete((string) $application['cv_path']);
        AuditLogger::log('delete', 'job_application', (int) $application['id'], ['email' => $application['email']]);
        flash('success', 'Application and CV deleted.');
        redirect(admin_url('careers-applications'));
    }

    private function requiredApplication(bool $post): array
    {
        $id = $post ? filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) : filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $application = $id ? $this->applications->find((int) $id) : null;
        if (!$application) {
            $this->abort(404, 'Application not found.');
        }
        return $application;
    }
}
