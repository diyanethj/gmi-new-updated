<?php
$isEdit = is_array($team);
$value = static function (string $key, mixed $default = '') use ($team, $isEdit): mixed {
    $base = $isEdit ? ($team[$key] ?? $default) : $default;
    return old($key, $base);
};
?>
<div class="panel">
    <div class="panel-head"><div><h2><?= $isEdit ? 'Edit Company Team' : 'Add Company Team' ?></h2><div class="hint">The company name appears under the team image on the public About Us page.</div></div><a class="btn btn-secondary" href="<?= e(admin_url('about-teams')) ?>">Back to Our Teams</a></div>
    <div class="panel-body">
        <form method="post" enctype="multipart/form-data" action="<?= e(admin_url($isEdit ? 'about-teams-update' : 'about-teams-store')) ?>">
            <?= csrf_field() ?><?php if ($isEdit): ?><input type="hidden" name="id" value="<?= e($team['id']) ?>"><?php endif; ?>
            <div class="form-grid">
                <div class="field field-full"><label for="company_name">Company name</label><input id="company_name" name="company_name" maxlength="180" required value="<?= e($value('company_name')) ?>"><?php foreach (errors('company_name') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
                <div class="field"><label for="status">Status</label><select id="status" name="status"><option value="active" <?= $value('status', 'active') === 'active' ? 'selected' : '' ?>>Active</option><option value="inactive" <?= $value('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option></select></div>
                <div class="field"><label for="sort_order">Display order</label><input id="sort_order" name="sort_order" type="number" min="1" max="9999" required value="<?= e($value('sort_order', 9999)) ?>"><?php foreach (errors('sort_order') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
                <div class="field field-full"><label for="team_image">Team image <?= $isEdit ? '(leave blank to keep the current image)' : '' ?></label><input id="team_image" name="team_image" type="file" accept="image/jpeg,image/png,image/webp" <?= $isEdit ? '' : 'required' ?>><div class="hint">JPG, PNG, or WEBP. Maximum 8 MB. Landscape team photos work best.</div><?php if ($isEdit): ?><div class="current-about-team-image"><img src="<?= e(asset_url($team['image_path'])) ?>" alt="Current company team image"></div><?php endif; ?><?php foreach (errors('team_image') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
            </div>
            <div class="form-actions"><button class="btn btn-primary" type="submit"><i class="fas fa-floppy-disk"></i><?= $isEdit ? 'Update Company Team' : 'Create Company Team' ?></button><a class="btn btn-secondary" href="<?= e(admin_url('about-teams')) ?>">Cancel</a></div>
        </form>
    </div>
</div>
