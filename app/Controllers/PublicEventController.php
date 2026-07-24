<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers;

use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\Event;
use Gmg\Events\Models\EventImage;

final class PublicEventController extends Controller
{
    private Event $events;
    private EventImage $images;

    public function __construct()
    {
        $db = Database::connection();
        $this->events = new Event($db);
        $this->images = new EventImage($db);
    }

    public function index(): void
    {
        $this->render('public/events', ['events' => $this->events->published()]);
    }

    public function show(string $slug): void
    {
        $slug = trim($slug);
        if ($slug === '' || !preg_match('/^[a-z0-9-]{1,220}$/', $slug)) {
            $this->abort(404, 'Event not found.');
        }

        $event = $this->events->findPublishedBySlug($slug);
        if (!$event) {
            $this->abort(404, 'Event not found.');
        }
        $event['images'] = $this->images->forEvent((int) $event['id']);
        $this->render('public/event-details', ['event' => $event]);
    }
}
