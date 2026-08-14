<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\Admin;
use Gmg\Events\Models\BusinessPartner;
use Gmg\Events\Models\Event;
use Gmg\Events\Models\JobApplication;
use Gmg\Events\Models\JobVacancy;
use Gmg\Events\Models\WebsiteCompany;

final class DashboardController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();
        $db = Database::connection();
        $events = new Event($db);
        $admins = new Admin($db);
        $partners = new BusinessPartner($db);
        $vacancies = new JobVacancy($db);
        $applications = new JobApplication($db);
        $companies = new WebsiteCompany($db);

        $this->render('admin/dashboard', [
            'counts' => $events->counts(),
            'adminCount' => Auth::isSuperAdmin() ? count($admins->all()) : count($admins->createdBy((int) Auth::id())),
            'partnerCount' => $partners->countActive(),
            'companyCount' => $companies->countActive(),
            'vacancyCount' => $vacancies->countActive(),
            'applicationCount' => $applications->count(),
            'recentEvents' => Auth::can('events.view') ? array_slice($events->adminAll(), 0, 6) : [],
        ], 'admin/layouts/app');
    }
}
