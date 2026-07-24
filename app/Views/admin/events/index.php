<div class="panel">
    <div class="panel-head"><div><h2>All Events</h2><div class="hint">Blank order values use event date, newest first. Numbered events appear first in ascending order.</div></div><a class="btn btn-primary" href="<?= e(admin_url('events-create')) ?>"><i class="fas fa-plus"></i>Create Event</a></div>
    <form method="post" action="<?= e(admin_url('events-order')) ?>">
        <?= csrf_field() ?>
        <div class="table-wrap"><table><thead><tr><th>Image</th><th>Event</th><th>Date</th><th>Status</th><th>Images</th><th>Order</th><th>Actions</th></tr></thead><tbody>
        <?php if ($events === []): ?><tr><td colspan="7" class="empty">No events are available.</td></tr><?php endif; ?>
        <?php foreach ($events as $event): ?><tr>
            <td><img class="thumb" src="<?= e(asset_url($event['main_image'])) ?>" alt=""></td>
            <td><strong><?= e($event['name']) ?></strong><br><small><?= e($event['company']) ?></small></td>
            <td><?= e(format_event_date($event['event_date'])) ?></td>
            <td><span class="badge badge-<?= e($event['status']) ?>"><?= e(ucfirst($event['status'])) ?></span></td>
            <td><?= e($event['gallery_count']) ?></td>
            <td><input class="order-input" type="number" min="1" max="9999" name="sort_order[<?= e($event['id']) ?>]" value="<?= e($event['sort_order'] ?? '') ?>" aria-label="Order for <?= e($event['name']) ?>"></td>
            <td><div class="actions"><a class="btn btn-secondary btn-small" href="<?= e(admin_url('events-edit',['id'=>$event['id']])) ?>"><i class="fas fa-pen"></i>Edit</a><a class="btn btn-secondary btn-small" target="_blank" rel="noopener" href="<?= e(base_url('event-details.php?slug=' . rawurlencode($event['slug']))) ?>"><i class="fas fa-eye"></i>View</a><button type="submit" class="btn btn-danger btn-small" form="delete-event-<?= e($event['id']) ?>" onclick="return confirm('Delete this event and all its images?')"><i class="fas fa-trash"></i>Delete</button></div></td>
        </tr><?php endforeach; ?>
        </tbody></table></div>
        <?php if ($events !== []): ?><div class="panel-body"><button class="btn btn-primary" type="submit"><i class="fas fa-sort"></i>Save Display Order</button></div><?php endif; ?>
    </form>
    <?php foreach ($events as $event): ?><form id="delete-event-<?= e($event['id']) ?>" method="post" action="<?= e(admin_url('events-delete')) ?>" class="inline-form"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e($event['id']) ?>"></form><?php endforeach; ?>
</div>
