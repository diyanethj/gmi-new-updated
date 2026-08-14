<?php use Gmg\Events\Core\Auth; ?>
<div class="panel">
    <div class="panel-head"><div><h2>All Events</h2><div class="hint">Blank order values use event date, newest first. Numbered events appear first in ascending order.</div></div><?php if(Auth::can('events.create')): ?><a class="btn btn-primary" href="<?= e(admin_url('events-create')) ?>"><i class="fas fa-plus"></i>Create Event</a><?php endif; ?></div>
    <form method="post" action="<?= e(admin_url('events-order')) ?>"><?= csrf_field() ?>
    <div class="table-wrap"><table><thead><tr><th>Image</th><th>Event</th><th>Date</th><th>Status</th><th>Order</th><th></th></tr></thead><tbody>
    <?php if ($events === []): ?><tr><td colspan="6" class="empty">No events found.</td></tr><?php endif; ?>
    <?php foreach($events as $event): ?><tr>
        <td><img class="thumb" src="<?= e(asset_url($event['main_image'])) ?>" alt=""></td><td><strong><?= e($event['name']) ?></strong><br><span class="hint"><?= e($event['company']) ?></span></td><td><?= e(format_event_date($event['event_date'])) ?></td><td><?= e(ucfirst($event['status'])) ?></td>
        <td><?php if(Auth::can('events.order')): ?><input class="order-input" type="number" min="1" max="9999" name="order[<?= e($event['id']) ?>]" value="<?= e($event['sort_order'] ?? '') ?>"><?php else: ?><?= e($event['sort_order'] ?? 'Date') ?><?php endif; ?></td>
        <td><div class="actions"><?php if(Auth::can('events.edit')): ?><a class="btn btn-secondary btn-small" href="<?= e(admin_url('events-edit',['id'=>$event['id']])) ?>"><i class="fas fa-pen"></i>Edit</a><?php endif; ?><a class="btn btn-secondary btn-small" target="_blank" rel="noopener" href="<?= e(base_url('event-details.php?slug=' . rawurlencode($event['slug']))) ?>"><i class="fas fa-eye"></i>View</a><?php if(Auth::can('events.delete')): ?><button type="submit" class="btn btn-danger btn-small" form="delete-event-<?= e($event['id']) ?>" onclick="return confirm('Delete this event and all its images?')"><i class="fas fa-trash"></i>Delete</button><?php endif; ?></div></td>
    </tr><?php endforeach; ?>
    </tbody></table></div>
    <?php if($events!==[] && Auth::can('events.order')): ?><div class="panel-body"><button class="btn btn-primary" type="submit"><i class="fas fa-sort"></i>Save Display Order</button></div><?php endif; ?></form>
    <?php if(Auth::can('events.delete')): ?><?php foreach($events as $event): ?><form id="delete-event-<?= e($event['id']) ?>" method="post" action="<?= e(admin_url('events-delete')) ?>" class="inline-form"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e($event['id']) ?>"></form><?php endforeach; ?><?php endif; ?>
</div>
