<?php
$isEdit = is_array($event);
$value = static function (string $key, mixed $default = '') use ($event, $isEdit): mixed {
    $base = $isEdit ? ($event[$key] ?? $default) : $default;
    return old($key, $base);
};
?>
<div class="panel">
    <div class="panel-head"><div><h2><?= $isEdit ? 'Edit Event' : 'Create Event' ?></h2><div class="hint">The public event page and detail gallery are generated automatically.</div></div><a class="btn btn-secondary" href="<?= e(admin_url('events')) ?>">Back to Events</a></div>
    <div class="panel-body">
        <form method="post" enctype="multipart/form-data" action="<?= e(admin_url($isEdit ? 'events-update' : 'events-store')) ?>">
            <?= csrf_field() ?><?php if ($isEdit): ?><input type="hidden" name="id" value="<?= e($event['id']) ?>"><?php endif; ?>
            <div class="form-grid">
                <div class="field field-full"><label for="name">Event name</label><input id="name" name="name" maxlength="200" required value="<?= e($value('name')) ?>"><?php foreach (errors('name') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
                <div class="field"><label for="event_date">Event date</label><input id="event_date" name="event_date" type="date" required value="<?= e($value('event_date')) ?>"><?php foreach (errors('event_date') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
                <div class="field"><label for="event_time">Event time <span class="hint">(optional)</span></label><input id="event_time" name="event_time" maxlength="100" placeholder="Example: 9:00 AM – 4:00 PM" value="<?= e($value('event_time')) ?>"><?php foreach (errors('event_time') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
                <div class="field"><label for="company">Company / organizer</label><input id="company" name="company" maxlength="160" required value="<?= e($value('company','Global Marine Group')) ?>"><?php foreach (errors('company') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
                <div class="field"><label for="status">Status</label><select id="status" name="status"><option value="published" <?= $value('status','published') === 'published' ? 'selected' : '' ?>>Published</option><option value="draft" <?= $value('status') === 'draft' ? 'selected' : '' ?>>Draft</option></select></div>
                <div class="field"><label for="sort_order">Custom display order <span class="hint">(optional)</span></label><input id="sort_order" name="sort_order" type="number" min="1" max="9999" value="<?= e($value('sort_order')) ?>"><div class="hint">Leave blank to use latest event date first.</div><?php foreach (errors('sort_order') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
                <div class="field field-full"><label for="description">Description</label><textarea id="description" name="description" maxlength="50000" required placeholder="Use a blank line between paragraphs."><?= e($value('description')) ?></textarea><div class="hint">Blank lines create separate paragraphs on the event detail page.</div><?php foreach (errors('description') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
                <div class="field"><label for="main_image">Main image <?= $isEdit ? '(leave blank to keep current image)' : '' ?></label><input id="main_image" name="main_image" type="file" accept="image/jpeg,image/png,image/webp" <?= $isEdit ? '' : 'required' ?>><?php if ($isEdit): ?><img class="thumb" style="width:150px;height:95px" src="<?= e(asset_url($event['main_image'])) ?>" alt="Current main image"><?php endif; ?><?php foreach (errors('main_image') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
                <div class="field"><label for="gallery_images">Add other images</label><input id="gallery_images" name="gallery_images[]" type="file" multiple accept="image/jpeg,image/png,image/webp"><div class="hint">JPG, PNG or WEBP. Maximum 8 MB each and 40 images per upload.</div></div>
            </div>
            <?php if ($isEdit && $galleryImages !== []): ?><div style="margin-top:24px"><h3>Existing gallery images</h3><p class="hint">Change order values or select images to delete when saving.</p><div class="gallery-admin"><?php foreach ($galleryImages as $image): ?><div class="gallery-item"><img src="<?= e(asset_url($image['image_path'])) ?>" alt=""><div class="gallery-controls"><label>Order <input class="order-input" type="number" min="1" max="9999" name="gallery_order[<?= e($image['id']) ?>]" value="<?= e($image['sort_order']) ?>"></label><label class="check-row"><input type="checkbox" name="remove_gallery[]" value="<?= e($image['id']) ?>">Delete image</label></div></div><?php endforeach; ?></div></div><?php endif; ?>
            <div class="form-actions"><button class="btn btn-primary" type="submit"><i class="fas fa-floppy-disk"></i><?= $isEdit ? 'Update Event' : 'Create Event' ?></button><a class="btn btn-secondary" href="<?= e(admin_url('events')) ?>">Cancel</a></div>
        </form>
    </div>
</div>
