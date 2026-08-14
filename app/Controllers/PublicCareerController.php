<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers;

use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\CvUploader;
use Gmg\Events\Core\Database;
use Gmg\Events\Core\Validator;
use Gmg\Events\Models\JobApplication;
use Gmg\Events\Models\JobVacancy;

final class PublicCareerController extends Controller
{
    private JobVacancy $vacancies;
    private JobApplication $applications;

    public function __construct()
    {
        $db = Database::connection();

        $this->vacancies = new JobVacancy($db);
        $this->applications = new JobApplication($db);
    }

    /**
     * Main Careers landing page.
     *
     * This page shows:
     * - Careers introduction
     * - Core values
     * - Join as Employee
     * - Join as Crew
     *
     * Vacancies/applications are handled by the two dedicated pages.
     */
    public function index(): void
    {
        $this->render('public/careers', [
            'gmgVacancies' => $this->vacancies->activeByCompany('GMG'),
            'gmsVacancies' => $this->vacancies->activeByCompany('GMS'),
            'activeVacancies' => $this->vacancies->allActive(),
            'careerSuccess' => flash('career_success'),
            'careerError' => flash('career_error'),
        ]);

        clear_form_state();
    }

    /**
     * Dedicated Employee page.
     * Shows GMG vacancies only.
     */
    public function employee(): void
    {
        $this->renderCompanyPage(
            'GMG',
            'public/vacancies-gmg'
        );

        clear_form_state();
    }

    /**
     * Dedicated Crew page.
     * Shows GMS vacancies only.
     */
    public function crew(): void
    {
        $this->renderCompanyPage(
            'GMS',
            'public/vacancies-gms'
        );

        clear_form_state();
    }

    /**
     * Handle a career application.
     *
     * $expectedCompany:
     * - GMG for careers-employee.php
     * - GMS for careers-crew.php
     * - null only for legacy/general submission support
     */
    public function apply(?string $expectedCompany = null): void
    {
        Csrf::requireValid();

        $expectedCompany = $expectedCompany !== null
            ? strtoupper(trim($expectedCompany))
            : null;

        $redirectPage = $this->redirectPageForCompany($expectedCompany);

        // Honeypot: genuine visitors never fill this hidden field.
        if (trim((string) ($_POST['website'] ?? '')) !== '') {
            http_response_code(400);
            exit('Invalid submission.');
        }

        $data = [
            'vacancy_id' => trim((string) ($_POST['vacancy_id'] ?? '')),
            'applicant_name' => trim((string) ($_POST['applicant_name'] ?? '')),
            'email' => text_lower(trim((string) ($_POST['email'] ?? ''))),
            'phone' => trim((string) ($_POST['phone'] ?? '')),
        ];

        $errors = Validator::application($data);

        $vacancy = ctype_digit($data['vacancy_id'])
            ? $this->vacancies->findActive((int) $data['vacancy_id'])
            : null;

        if (!$vacancy) {
            $errors['vacancy_id'][] =
                'The selected vacancy is no longer available.';
        }

        /*
         * Security / workflow validation:
         * Employee page may submit GMG vacancies only.
         * Crew page may submit GMS vacancies only.
         */
        if (
            $vacancy !== null
            && $expectedCompany !== null
            && strtoupper(trim((string) ($vacancy['company'] ?? '')))
                !== $expectedCompany
        ) {
            $errors['vacancy_id'][] =
                'The selected vacancy is not available on this career page.';
        }

        if ($errors !== []) {
            remember_form($data, $errors);

            flash(
                'career_error',
                'Please correct the highlighted fields.'
            );

            redirect(
                base_url($redirectPage . '#application-form')
            );
        }

        $ipHash = hash_hmac(
            'sha256',
            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            (string) config('app_key')
        );

        if (
            $this->applications->hasRecentSubmission(
                $ipHash,
                (int) $vacancy['id']
            )
        ) {
            remember_form($data, []);

            flash(
                'career_error',
                'An application for this vacancy was submitted recently. Please wait before trying again.'
            );

            redirect(
                base_url($redirectPage . '#application-form')
            );
        }

        $uploader = new CvUploader();
        $uploadedCvPath = null;

        try {
            $cv = $uploader->upload(
                $_FILES['cv_file'] ?? []
            );

            $uploadedCvPath = (string) $cv['path'];

            $id = $this->applications->create([
                'vacancy_id' => (int) $vacancy['id'],
                'vacancy_position' => $vacancy['position'],
                'company' => $vacancy['company'],
                'company_name' => $vacancy['company_name'],
                'applicant_name' => $data['applicant_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'cv_path' => $cv['path'],
                'original_cv_name' => $cv['original_name'],
                'cv_mime' => $cv['mime'],
                'cv_size' => $cv['size'],
                'ip_hash' => $ipHash,
            ]);

            if ($id < 1) {
                throw new \RuntimeException(
                    'Unable to save the application.'
                );
            }

        } catch (\Throwable $exception) {
            if ($uploadedCvPath !== null) {
                $uploader->delete($uploadedCvPath);
            }

            error_log(
                'Career application failed: '
                . $exception->getMessage()
            );

            remember_form(
                $data,
                [
                    'cv_file' => [
                        $exception->getMessage()
                    ]
                ]
            );

            flash(
                'career_error',
                'Your application could not be submitted. Please check the CV and try again.'
            );

            redirect(
                base_url($redirectPage . '#application-form')
            );
        }

        clear_form_state();

        flash(
            'career_success',
            'Your application was submitted successfully.'
        );

        redirect(
            base_url($redirectPage . '#application-form')
        );
    }

    /**
     * Render a dedicated career page with only one
     * company's active vacancies.
     */
    private function renderCompanyPage(
        string $companyCode,
        string $view
    ): void {
        $companyCode = strtoupper(trim($companyCode));

        $companyVacancies =
            $this->vacancies->activeByCompany($companyCode);

        $this->render($view, [
            /*
             * Both variables are supplied for compatibility
             * with the existing view markup.
             */
            'gmgVacancies' =>
                $companyCode === 'GMG'
                    ? $companyVacancies
                    : [],

            'gmsVacancies' =>
                $companyCode === 'GMS'
                    ? $companyVacancies
                    : [],

            /*
             * Dedicated application dropdown receives only
             * vacancies belonging to this page/company.
             */
            'activeVacancies' => $companyVacancies,

            'careerSuccess' =>
                flash('career_success'),

            'careerError' =>
                flash('career_error'),
        ]);
    }

    /**
     * Decide where application validation/success
     * should redirect.
     */
    private function redirectPageForCompany(
        ?string $companyCode
    ): string {
        return match ($companyCode) {
            'GMG' => 'vacancies-gmg.php',
            'GMS' => 'vacancies-gms.php',
            default => 'careers.php',
        };
    }
}