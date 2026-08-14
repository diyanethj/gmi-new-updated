<?php
$isEdit = is_array($member);
$value = static function (string $key, mixed $default = '') use ($member, $isEdit): mixed {
    $base = $isEdit ? ($member[$key] ?? $default) : $default;
    return old($key, $base);
};
$singular = $memberType === 'director' ? 'Director' : 'Management Team Member';
?>
<div class="panel">
    <div class="panel-head">
        <div><h2><?= e($isEdit ? 'Edit ' . $singular : 'Add ' . $singular) ?></h2><div class="hint">This record appears in the <?= e($sectionTitle) ?> section when Active.</div></div>
        <a class="btn btn-secondary" href="<?= e(admin_url($routePrefix)) ?>">Back to <?= e($sectionTitle) ?></a>
    </div>
    <div class="panel-body">
        <form method="post" enctype="multipart/form-data" action="<?= e(admin_url($routePrefix . ($isEdit ? '-update' : '-store'))) ?>">
            <?= csrf_field() ?>
            <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= e($member['id']) ?>"><?php endif; ?>
            <div class="form-grid">
                <div class="field">
                    <label for="name">Name</label>
                    <input id="name" name="name" maxlength="160" required value="<?= e($value('name')) ?>">
                    <?php foreach (errors('name') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>
                <div class="field">
                    <label for="position">Position</label>
                    <input id="position" name="position" maxlength="255" required value="<?= e($value('position')) ?>">
                    <?php foreach (errors('position') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>
                <div class="field">
                    <label for="status">Status</label>
                    <select id="status" name="status"><option value="active" <?= $value('status', 'active') === 'active' ? 'selected' : '' ?>>Active</option><option value="inactive" <?= $value('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option></select>
                </div>
                <div class="field">
                    <label for="sort_order">Display order</label>
                    <input id="sort_order" name="sort_order" type="number" min="1" max="9999" required value="<?= e($value('sort_order', 9999)) ?>">
                    <?php foreach (errors('sort_order') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>
                <div class="field field-full">
                    <label for="member_image">Photo <?= $isEdit ? '(leave blank to keep the current photo)' : '' ?></label>
                    <input id="member_image" name="member_image" type="file" accept="image/jpeg,image/png,image/webp" <?= $isEdit ? '' : 'required' ?>>
                    <div class="hint">JPG, PNG, or WEBP. Maximum 8 MB. Square or portrait images work best.</div>
                    <?php if ($isEdit): ?><div class="current-about-image"><img src="<?= e(asset_url($member['image_path'])) ?>" alt="Current photo"></div><?php endif; ?>
                    <?php foreach (errors('member_image') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>
            </div>
            <div class="form-actions"><button class="btn btn-primary" type="submit"><i class="fas fa-floppy-disk"></i><?= e($isEdit ? 'Update ' . $singular : 'Create ' . $singular) ?></button><a class="btn btn-secondary" href="<?= e(admin_url($routePrefix)) ?>">Cancel</a></div>
        </form>
    </div>
</div>
