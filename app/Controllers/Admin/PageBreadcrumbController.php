<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\AuditLogger;
use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\PageBreadcrumb;
use Throwable;

final class PageBreadcrumbController extends Controller
{
    /** @var array<string,array{default:string,url:string}> */
    private const PAGES = [
        'about-us' => ['default' => 'About Us', 'url' => 'about-us.php'],
        'companies' => ['default' => 'Our Companies', 'url' => 'companies.php'],
        'events' => ['default' => 'Events', 'url' => 'events.php'],
        'careers' => ['default' => 'Careers @ Global Marine Group', 'url' => 'careers.php'],
        'join-employee' => ['default' => 'Join as Employee', 'url' => 'vacancies-gmg.php'],
        'join-crew' => ['default' => 'Join as Crew', 'url' => 'vacancies-gms.php'],
        'contact-us' => ['default' => 'Contact Us', 'url' => 'contact-us.php']
    ];

    private PageBreadcrumb $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = new PageBreadcrumb(Database::connection());
    }

    public function index(): void
    {
        Auth::requirePermission('about.page.view');

        $settings = [];

        foreach (self::PAGES as $pageKey => $page) {
            $settings[$pageKey] = $this->breadcrumbs->get(
                $pageKey,
                $page['default']
            );
        }

        $this->render(
            'admin/page-names/index',
            [
                'pages' => self::PAGES,
                'settings' => $settings,
            ],
            'admin/layouts/app'
        );
    }

    public function update(): void
    {
        Auth::requirePermission('about.page.edit');
        Csrf::requireValid();

        $submitted = $_POST['page_name'] ?? [];

        if (!is_array($submitted)) {
            flash('error', 'Invalid page names submission.');
            redirect(admin_url('page-names'));
        }

        $clean = [];

        foreach (self::PAGES as $pageKey => $page) {
            $pageName = trim((string) ($submitted[$pageKey] ?? ''));

            if ($pageName === '') {
                flash('error', 'Every page name is required.');
                redirect(admin_url('page-names'));
            }

            if (strlen($pageName) > 120) {
                flash('error', 'Each page name must be 120 characters or fewer.');
                redirect(admin_url('page-names'));
            }

            $clean[$pageKey] = $pageName;
        }

        try {
            $adminId = (int) Auth::id();

            foreach ($clean as $pageKey => $pageName) {
                $this->breadcrumbs->update($pageKey, $pageName, $adminId);
            }

            AuditLogger::log(
                'update',
                'page_breadcrumb_settings',
                0,
                ['updated_page_keys' => array_keys($clean)]
            );

            flash('success', 'Page names updated successfully.');
        } catch (Throwable $exception) {
            error_log('Page names update failed: ' . $exception->getMessage());
            flash('error', 'The page names could not be updated.');
        }

        redirect(admin_url('page-names'));
    }
}
