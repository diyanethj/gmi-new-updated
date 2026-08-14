<?php
$isEdit = is_array($company);
$value = static function (string $key, mixed $default = '') use ($company, $isEdit): mixed {
    $base = $isEdit ? ($company[$key] ?? $default) : $default;
    return old($key, $base);
};
?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2><?= $isEdit ? 'Edit Company' : 'Create Company' ?></h2>
            <div class="hint">The company name will be displayed below its image on the public Companies page.</div>
        </div>
        <a class="btn btn-secondary" href="<?= e(admin_url('companies')) ?>">Back to Companies</a>
    </div>
    <div class="panel-body">
        <form method="post" enctype="multipart/form-data" action="<?= e(admin_url($isEdit ? 'companies-update' : 'companies-store')) ?>">
            <?= csrf_field() ?>
            <?php if ($isEdit): ?><input type="hidden" name="id" value="<?= e($company['id']) ?>"><?php endif; ?>
            <div class="form-grid">
                <div class="field">
                    <label for="company_name">Company name</label>
                    <input id="company_name" name="company_name" maxlength="180" required value="<?= e($value('company_name')) ?>">
                    <?php foreach (errors('company_name') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>
                <div class="field">
                    <label for="website_url">Company link <span class="hint">(optional)</span></label>
                    <input id="website_url" name="website_url" maxlength="500" value="<?= e($value('website_url')) ?>" placeholder="https://example.com or contact-us.php">
                    <div class="hint">External URL or an internal page such as contact-us.php.</div>
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
                <div class="field full">
                    <label for="company_image">Company image <?= $isEdit ? '(leave blank to keep the current image)' : '' ?></label>
                    <input id="company_image" name="company_image" type="file" accept="image/jpeg,image/png,image/webp" <?= $isEdit ? '' : 'required' ?>>
                    <div class="hint">JPG, PNG, or WEBP. Maximum 8 MB.</div>
                    <?php if ($isEdit): ?><div class="current-partner-logo"><img src="<?= e(asset_url($company['image_path'])) ?>" alt="Current company image"></div><?php endif; ?>
                    <?php foreach (errors('company_image') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit"><i class="fas fa-floppy-disk"></i><?= $isEdit ? 'Update Company' : 'Create Company' ?></button>
                <a class="btn btn-secondary" href="<?= e(admin_url('companies')) ?>">Cancel</a>
            </div>
        </form>
    </div>
</div>
