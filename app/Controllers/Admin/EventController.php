<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\AuditLogger;
use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\Database;
use Gmg\Events\Core\ImageUploader;
use Gmg\Events\Core\Validator;
use Gmg\Events\Models\Event;
use Gmg\Events\Models\EventImage;
use PDO;
use Throwable;

final class EventController extends Controller
{
    private PDO $db;
    private Event $events;
    private EventImage $images;
    private ImageUploader $uploader;

    public function __construct()
    {
        $this->db = Database::connection();
        $this->events = new Event($this->db);
        $this->images = new EventImage($this->db);
        $this->uploader = new ImageUploader();
    }

    public function index(): void
    {
        Auth::requireLogin();
        $this->render('admin/events/index', ['events' => $this->events->adminAll()], 'admin/layouts/app');
    }

    public function create(): void
    {
        Auth::requireLogin();
        $this->render('admin/events/form', ['event' => null, 'galleryImages' => []], 'admin/layouts/app');
        clear_form_state();
    }

    public function store(): void
    {
        Auth::requireLogin();
        Csrf::requireValid();
        $data = $this->eventInput();
        $errors = Validator::event($data, true);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('events-create'));
        }

        $newPaths = [];
        try {
            $mainImage = $this->uploader->uploadOne($_FILES['main_image'] ?? []);
            $newPaths[] = $mainImage;
            $gallery = $this->uploader->uploadMany($_FILES['gallery_images'] ?? []);
            $newPaths = array_merge($newPaths, $gallery);

            $this->db->beginTransaction();
            $eventId = $this->events->create(array_merge($data, [
                'slug' => $this->uniqueSlug($data['name']),
                'main_image' => $mainImage,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
            ]));
            $this->images->insertMany($eventId, $gallery);
            $this->db->commit();

            AuditLogger::log('create', 'event', $eventId, ['name' => $data['name']]);
            clear_form_state();
            flash('success', 'Event created successfully.');
            redirect(admin_url('events'));
        } catch (Throwable $exception) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            foreach ($newPaths as $path) {
                $this->uploader->delete($path);
            }
            error_log($exception->getMessage());
            remember_form($data, ['main_image' => [$exception->getMessage()]]);
            flash('error', 'The event could not be created. ' . $exception->getMessage());
            redirect(admin_url('events-create'));
        }
    }

    public function edit(): void
    {
        Auth::requireLogin();
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $event = $id ? $this->events->find($id) : null;
        if (!$event) {
            $this->abort(404, 'Event not found.');
        }
        $this->render('admin/events/form', [
            'event' => $event,
            'galleryImages' => $this->images->forEvent((int) $event['id']),
        ], 'admin/layouts/app');
        clear_form_state();
    }

    public function update(): void
    {
        Auth::requireLogin();
        Csrf::requireValid();
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $event = $id ? $this->events->find($id) : null;
        if (!$event) {
            flash('error', 'Event not found.');
            redirect(admin_url('events'));
        }

        $data = $this->eventInput();
        $errors = Validator::event($data, false);
        if ($errors !== []) {
            remember_form($data, $errors);
            flash('error', 'Please correct the highlighted fields.');
            redirect(admin_url('events-edit', ['id' => $id]));
        }

        $newPaths = [];
        $oldPathsToDelete = [];
        try {
            $mainImage = (string) $event['main_image'];
            if (!empty($_FILES['main_image']['name'])) {
                $mainImage = $this->uploader->uploadOne($_FILES['main_image']);
                $newPaths[] = $mainImage;
                $oldPathsToDelete[] = (string) $event['main_image'];
            }
            $newGallery = $this->uploader->uploadMany($_FILES['gallery_images'] ?? []);
            $newPaths = array_merge($newPaths, $newGallery);

            $removeIds = is_array($_POST['remove_gallery'] ?? null) ? $_POST['remove_gallery'] : [];
            $removeRows = $this->images->findByIds($id, $removeIds);
            foreach ($removeRows as $row) {
                $oldPathsToDelete[] = (string) $row['image_path'];
            }

            $galleryOrders = is_array($_POST['gallery_order'] ?? null) ? $_POST['gallery_order'] : [];

            $this->db->beginTransaction();
            $this->events->update($id, array_merge($data, [
                'main_image' => $mainImage,
                'updated_by' => Auth::id(),
            ]));
            $this->images->deleteIds($id, $removeIds);
            $this->images->updateOrders($id, $galleryOrders);
            $this->images->insertMany($id, $newGallery, $this->images->maxOrder($id) + 1);
            $this->db->commit();

            foreach ($oldPathsToDelete as $path) {
                $this->uploader->delete($path);
            }
            AuditLogger::log('update', 'event', $id, ['name' => $data['name']]);
            clear_form_state();
            flash('success', 'Event updated successfully.');
            redirect(admin_url('events'));
        } catch (Throwable $exception) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            foreach ($newPaths as $path) {
                $this->uploader->delete($path);
            }
            error_log($exception->getMessage());
            remember_form($data, ['main_image' => [$exception->getMessage()]]);
            flash('error', 'The event could not be updated. ' . $exception->getMessage());
            redirect(admin_url('events-edit', ['id' => $id]));
        }
    }

    public function delete(): void
    {
        Auth::requireLogin();
        Csrf::requireValid();
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $event = $id ? $this->events->find($id) : null;
        if (!$event) {
            flash('error', 'Event not found.');
            redirect(admin_url('events'));
        }

        $paths = [(string) $event['main_image']];
        foreach ($this->images->forEvent($id) as $image) {
            $paths[] = (string) $image['image_path'];
        }

        $this->db->beginTransaction();
        try {
            $this->events->delete($id);
            $this->db->commit();
        } catch (Throwable $exception) {
            $this->db->rollBack();
            throw $exception;
        }

        foreach ($paths as $path) {
            $this->uploader->delete($path);
        }
        AuditLogger::log('delete', 'event', $id, ['name' => $event['name']]);
        flash('success', 'Event deleted successfully.');
        redirect(admin_url('events'));
    }

    public function order(): void
    {
        Auth::requireLogin();
        Csrf::requireValid();
        $input = is_array($_POST['sort_order'] ?? null) ? $_POST['sort_order'] : [];
        $orders = [];
        foreach ($input as $id => $value) {
            $eventId = filter_var($id, FILTER_VALIDATE_INT);
            $value = trim((string) $value);
            if (!$eventId) {
                continue;
            }
            if ($value === '') {
                $orders[$eventId] = null;
                continue;
            }
            if (!ctype_digit($value) || (int) $value < 1 || (int) $value > 9999) {
                flash('error', 'Order values must be between 1 and 9999, or blank for automatic latest-first ordering.');
                redirect(admin_url('events'));
            }
            $orders[$eventId] = (int) $value;
        }

        $this->db->beginTransaction();
        try {
            $this->events->updateOrders($orders);
            $this->db->commit();
        } catch (Throwable $exception) {
            $this->db->rollBack();
            throw $exception;
        }
        AuditLogger::log('reorder', 'event', null, ['count' => count($orders)]);
        flash('success', 'Event order updated. Blank values continue to use latest-event-first ordering.');
        redirect(admin_url('events'));
    }

    private function eventInput(): array
    {
        $sortOrder = trim((string) ($_POST['sort_order'] ?? ''));
        return [
            'name' => trim((string) ($_POST['name'] ?? '')),
            'event_date' => trim((string) ($_POST['event_date'] ?? '')),
            'event_time' => trim((string) ($_POST['event_time'] ?? '')),
            'company' => trim((string) ($_POST['company'] ?? '')),
            'description' => trim((string) ($_POST['description'] ?? '')),
            'status' => (string) ($_POST['status'] ?? 'published'),
            'sort_order' => $sortOrder === '' ? null : (int) $sortOrder,
        ];
    }

    private function uniqueSlug(string $name): string
    {
        $slug = text_lower(trim($name));
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug) ?? '';
        $slug = trim($slug, '-');
        if ($slug === '') {
            $slug = 'event';
        }
        $slug = text_substr($slug, 0, 190);
        $candidate = $slug;
        $counter = 2;
        while ($this->events->slugExists($candidate)) {
            $candidate = text_substr($slug, 0, 180) . '-' . $counter;
            $counter++;
        }
        return $candidate;
    }
}
