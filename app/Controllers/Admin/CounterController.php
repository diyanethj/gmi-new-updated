<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\AuditLogger;
use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\HomeCounter;
use Throwable;

final class CounterController extends Controller
{
    private HomeCounter $counters;

    public function __construct()
    {
        $this->counters = new HomeCounter(Database::connection());
    }

    public function index(): void
    {
        Auth::requirePermission('counters.view');
        $this->render(
            'admin/counters/index',
            ['counters' => $this->counters->all()],
            'admin/layouts/app'
        );
    }

    public function update(): void
    {
        Auth::requirePermission('counters.edit');
        Csrf::requireValid();

        $existing = $this->counters->all();
        $allowedIds = array_map(static fn(array $counter): int => (int) $counter['id'], $existing);
        $submitted = $_POST['counter_value'] ?? [];
        $values = [];

        if (!is_array($submitted)) {
            flash('error', 'Invalid counter values.');
            redirect(admin_url('counters'));
        }

        foreach ($allowedIds as $id) {
            $raw = trim((string) ($submitted[$id] ?? ''));
            if ($raw === '' || !ctype_digit($raw)) {
                flash('error', 'Every counter must contain a whole number of zero or greater.');
                redirect(admin_url('counters'));
            }

            $value = filter_var($raw, FILTER_VALIDATE_INT, [
                'options' => ['min_range' => 0, 'max_range' => 2147483647],
            ]);
            if ($value === false) {
                flash('error', 'Counter values must be between 0 and 2,147,483,647.');
                redirect(admin_url('counters'));
            }
            $values[$id] = (int) $value;
        }

        try {
            $this->counters->updateValues($values, (int) Auth::id());
            AuditLogger::log('update', 'homepage_counters', null, ['count' => count($values)]);
            flash('success', 'Homepage counters updated successfully.');
        } catch (Throwable $exception) {
            error_log('Counter update failed: ' . $exception->getMessage());
            flash('error', 'The counters could not be updated.');
        }

        redirect(admin_url('counters'));
    }
}
