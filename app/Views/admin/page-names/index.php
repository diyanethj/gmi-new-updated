<?php
use Gmg\Events\Core\Auth;
?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Page Names</h2>
            <div class="hint">
                Edit the names shown in the breadcrumb heading and active breadcrumb label on each public page.
            </div>
        </div>
    </div>

    <div class="panel-body">
        <form method="post" action="<?= e(admin_url('page-names-update')) ?>">
            <?= csrf_field() ?>

            <div class="page-names-grid">
                <?php foreach ($pages as $pageKey => $page): ?>
                    <?php
                    $setting = $settings[$pageKey] ?? [];
                    $currentName = (string) ($setting['page_name'] ?? $page['default']);
                    ?>
                    <div class="page-name-row">
                        <div class="field">
                            <label>Page</label>
                            <div class="page-name-label"><?= e($page['default']) ?></div>
                        </div>

                        <div class="field">
                            <label for="page-name-<?= e($pageKey) ?>">Breadcrumb Page Name</label>
                            <input
                                id="page-name-<?= e($pageKey) ?>"
                                name="page_name[<?= e($pageKey) ?>]"
                                type="text"
                                maxlength="120"
                                required
                                value="<?= e($currentName) ?>"
                            >
                        </div>

                        <div class="field">
                            <label>&nbsp;</label>
                            <a
                                class="btn btn-secondary"
                                href="<?= e(base_url($page['url'])) ?>"
                                target="_blank"
                                rel="noopener"
                            >
                                <i class="fas fa-eye"></i>
                                View Page
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (Auth::can('about.page.edit')): ?>
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-floppy-disk"></i>
                        Save Page Names
                    </button>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<style>
.page-names-grid{display:grid;gap:14px}
.page-name-row{display:grid;grid-template-columns:minmax(170px,.55fr) minmax(280px,1.45fr) auto;gap:14px;align-items:end;padding:16px;border:1px solid var(--border);border-radius:13px;background:#f8fafc}
.page-name-label{min-height:42px;display:flex;align-items:center;font-weight:750;color:#20366c}
@media(max-width:760px){.page-name-row{grid-template-columns:1fr}}
</style>
