<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers;

use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\WebsiteCompany;

final class PublicCompanyController extends Controller
{
    public function index(): void
    {
        $companies = new WebsiteCompany(Database::connection());
        $this->render('public/companies', [
            'companies' => $companies->active(),
        ]);
    }
}
