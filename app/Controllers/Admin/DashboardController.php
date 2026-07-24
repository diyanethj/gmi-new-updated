<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\Admin;
use Gmg\Events\Models\Event;

final class DashboardController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();
        $db = Database::connection();
        $events = new Event($db);
        $admins = new Admin($db);
        $this->render('admin/dashboard', [
            'counts' => $events->counts(),
            'adminCount' => count($admins->all()),
            'recentEvents' => array_slice($events->adminAll(), 0, 6),
        ], 'admin/layouts/app');
    }
}
