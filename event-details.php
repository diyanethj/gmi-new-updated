<?php
declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

use Gmg\Events\Controllers\PublicEventController;

(new PublicEventController())->show((string) ($_GET['slug'] ?? ''));
