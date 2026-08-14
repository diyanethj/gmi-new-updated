<?php use Gmg\Events\Core\Auth; ?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Business Partners</h2>
            <div class="hint">Create, replace, order, activate, edit, or delete logos shown in the homepage partner slider.</div>
        </div>
        <?php if (Auth::can('partners.create')): ?><a class="btn btn-primary" href="<?= e(admin_url('partners-create')) ?>"><i class="fas fa-plus"></i>Add Partner</a><?php endif; ?>
    </div>

    <form method="post" action="<?= e(admin_url('partners-order')) ?>">
        <?= csrf_field() ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Logo</th><th>Partner</th><th>Status</th><th>Order</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php if ($partners === []): ?>
                        <tr><td colspan="5" class="empty">No business partners are available.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($partners as $partner): ?>
                        <tr>
                            <td><img class="partner-thumb" src="<?= e(asset_url($partner['image_path'])) ?>" alt="<?= e($partner['alt_text']) ?>"></td>
                            <td>
                                <strong><?= e($partner['name']) ?></strong>
                                <?php if (!empty($partner['website_url'])): ?><br><small><?= e($partner['website_url']) ?></small><?php endif; ?>
                            </td>
                            <td><span class="badge badge-<?= e($partner['status'] === 'active' ? 'published' : 'draft') ?>"><?= e(ucfirst($partner['status'])) ?></span></td>
                            <td><input class="order-input" type="number" min="1" max="9999" <?= Auth::can('partners.order') ? '' : 'disabled' ?> name="sort_order[<?= e($partner['id']) ?>]" value="<?= e($partner['sort_order']) ?>" aria-label="Order for <?= e($partner['name']) ?>"></td>
                            <td>
                                <div class="actions">
                                    <?php if (Auth::can('partners.edit')): ?><a class="btn btn-secondary btn-small" href="<?= e(admin_url('partners-edit', ['id' => $partner['id']])) ?>"><i class="fas fa-pen"></i>Edit</a><?php endif; ?>
                                    <?php if (Auth::can('partners.delete')): ?><button type="submit" class="btn btn-danger btn-small" form="delete-partner-<?= e($partner['id']) ?>" onclick="return confirm('Delete this business partner?')"><i class="fas fa-trash"></i>Delete</button><?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($partners !== []): ?>
            <?php if (Auth::can('partners.order')): ?><div class="panel-body"><button class="btn btn-primary" type="submit"><i class="fas fa-sort"></i>Save Partner Order</button></div><?php endif; ?>
        <?php endif; ?>
    </form>

    <?php foreach ($partners as $partner): ?>
        <form id="delete-partner-<?= e($partner['id']) ?>" method="post" action="<?= e(admin_url('partners-delete')) ?>" class="inline-form">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= e($partner['id']) ?>">
        </form>
    <?php endforeach; ?>
</div>
