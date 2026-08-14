<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers;

use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\AboutMember;
use Gmg\Events\Models\AboutTeam;

final class PublicAboutController extends Controller
{
    public function index(): void
    {
        $db = Database::connection();
        $members = new AboutMember($db);
        $teams = new AboutTeam($db);

        $this->render('public/about', [
            'directors' => $members->activeByType('director'),
            'managementMembers' => $members->activeByType('management'),
            'companyTeams' => $teams->active(),
        ]);
    }
}
