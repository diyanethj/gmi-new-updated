<?php
$isEdit = is_array($partner);
$value = static function (string $key, mixed $default = '') use ($partner, $isEdit): mixed {
    $base = $isEdit ? ($partner[$key] ?? $default) : $default;
    return old($key, $base);
};
?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2><?= $isEdit ? 'Edit Business Partner' : 'Add Business Partner' ?></h2>
            <div class="hint">The logo will appear automatically in the homepage partner slider when its status is Active.</div>
        </div>
        <a class="btn btn-secondary" href="<?= e(admin_url('partners')) ?>">Back to Partners</a>
    </div>
    <div class="panel-body">
        <form method="post" enctype="multipart/form-data" action="<?= e(admin_url($isEdit ? 'partners-update' : 'partners-store')) ?>">
            <?= csrf_field() ?>
            <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= e($partner['id']) ?>"><?php endif; ?>

            <div class="form-grid">
                <div class="field">
                    <label for="name">Partner name</label>
                    <input id="name" name="name" maxlength="160" required value="<?= e($value('name')) ?>">
                    <?php foreach (errors('name') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>

                <div class="field">
                    <label for="alt_text">Image alternative text</label>
                    <input id="alt_text" name="alt_text" maxlength="190" value="<?= e($value('alt_text')) ?>" placeholder="Example: Samudera Shipping logo">
                    <?php foreach (errors('alt_text') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>

                <div class="field field-full">
                    <label for="website_url">Website URL <span class="hint">(optional)</span></label>
                    <input id="website_url" name="website_url" type="url" maxlength="500" value="<?= e($value('website_url')) ?>" placeholder="https://example.com/">
                    <?php foreach (errors('website_url') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>

                <div class="field">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="active" <?= $value('status', 'active') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $value('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="field">
                    <label for="sort_order">Display order</label>
                    <input id="sort_order" name="sort_order" type="number" min="1" max="9999" required value="<?= e($value('sort_order', 9999)) ?>">
                    <?php foreach (errors('sort_order') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>

                <div class="field field-full">
                    <label for="partner_image">Partner logo <?= $isEdit ? '(leave blank to keep the current logo)' : '' ?></label>
                    <input id="partner_image" name="partner_image" type="file" accept="image/jpeg,image/png,image/webp" <?= $isEdit ? '' : 'required' ?>>
                    <div class="hint">JPG, PNG, or WEBP. Maximum 8 MB. Transparent PNG or WEBP is recommended.</div>
                    <?php if ($isEdit): ?>
                        <div class="current-partner-logo"><img src="<?= e(asset_url($partner['image_path'])) ?>" alt="Current partner logo"></div>
                    <?php endif; ?>
                    <?php foreach (errors('partner_image') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit"><i class="fas fa-floppy-disk"></i><?= $isEdit ? 'Update Partner' : 'Create Partner' ?></button>
                <a class="btn btn-secondary" href="<?= e(admin_url('partners')) ?>">Cancel</a>
            </div>
        </form>
    </div>
</div>
