<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers;

use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\BusinessPartner;
use Gmg\Events\Models\Event;
use Gmg\Events\Models\HomeCounter;

final class PublicHomeController extends Controller
{
    public function index(): void
    {
        $db = Database::connection();
        $this->render('public/home', [
            'counters' => (new HomeCounter($db))->all(),
            'partners' => (new BusinessPartner($db))->active(),
            'latestEvents' => (new Event($db))->latestPublished(3),
        ]);
    }
}
