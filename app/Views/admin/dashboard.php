<div class="stats">
    <div class="stat"><i class="fas fa-calendar-days"></i><strong><?= e($counts['total']) ?></strong><span>Total events</span></div>
    <div class="stat"><i class="fas fa-circle-check"></i><strong><?= e($counts['published']) ?></strong><span>Published events</span></div>
    <div class="stat"><i class="fas fa-file-pen"></i><strong><?= e($counts['drafts']) ?></strong><span>Draft events</span></div>
    <div class="stat"><i class="fas fa-user-shield"></i><strong><?= e($adminCount) ?></strong><span>Administrators</span></div>
</div>
<div class="panel">
    <div class="panel-head"><h2>Recent Events</h2><a class="btn btn-primary btn-small" href="<?= e(admin_url('events-create')) ?>"><i class="fas fa-plus"></i>Create Event</a></div>
    <div class="table-wrap"><table><thead><tr><th>Image</th><th>Event</th><th>Date</th><th>Status</th><th>Gallery</th><th></th></tr></thead><tbody>
    <?php if ($recentEvents === []): ?><tr><td colspan="6" class="empty">No events have been created.</td></tr><?php endif; ?>
    <?php foreach ($recentEvents as $event): ?><tr><td><img class="thumb" src="<?= e(asset_url($event['main_image'])) ?>" alt=""></td><td><strong><?= e($event['name']) ?></strong><br><small><?= e($event['company']) ?></small></td><td><?= e(format_event_date($event['event_date'])) ?></td><td><span class="badge badge-<?= e($event['status']) ?>"><?= e(ucfirst($event['status'])) ?></span></td><td><?= e($event['gallery_count']) ?></td><td><a class="btn btn-secondary btn-small" href="<?= e(admin_url('events-edit',['id'=>$event['id']])) ?>">Edit</a></td></tr><?php endforeach; ?>
    </tbody></table></div>
</div>
