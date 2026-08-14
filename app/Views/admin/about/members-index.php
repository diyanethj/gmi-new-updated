<?php use Gmg\Events\Core\Auth; $permissionPrefix = $memberType === 'director' ? 'about.directors' : 'about.management'; ?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2><?= e($sectionTitle) ?></h2>
            <div class="hint">Manage names, positions, photos, visibility, and public display order.</div>
        </div>
        <div class="actions">
            <a class="btn btn-secondary" href="<?= e(admin_url('about')) ?>"><i class="fas fa-arrow-left"></i>About Overview</a>
            <?php if (Auth::can($permissionPrefix . '.create')): ?><a class="btn btn-primary" href="<?= e(admin_url($routePrefix . '-create')) ?>"><i class="fas fa-plus"></i>Add <?= e($memberType === 'director' ? 'Director' : 'Member') ?></a><?php endif; ?>
        </div>
    </div>

    <form method="post" action="<?= e(admin_url($routePrefix . '-order')) ?>">
        <?= csrf_field() ?>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Photo</th><th>Name and position</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if ($members === []): ?><tr><td colspan="5" class="empty">No records are available in this section.</td></tr><?php endif; ?>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><img class="about-member-thumb" src="<?= e(asset_url($member['image_path'])) ?>" alt="<?= e($member['name']) ?>"></td>
                        <td><strong><?= e($member['name']) ?></strong><br><small><?= e($member['position']) ?></small></td>
                        <td><span class="badge badge-<?= e($member['status'] === 'active' ? 'published' : 'draft') ?>"><?= e(ucfirst($member['status'])) ?></span></td>
                        <td><input class="order-input" type="number" min="1" max="9999" <?= Auth::can($permissionPrefix . '.order') ? '' : 'disabled' ?> name="sort_order[<?= e($member['id']) ?>]" value="<?= e($member['sort_order']) ?>" aria-label="Order for <?= e($member['name']) ?>"></td>
                        <td><div class="actions">
                            <?php if (Auth::can($permissionPrefix . '.edit')): ?><a class="btn btn-secondary btn-small" href="<?= e(admin_url($routePrefix . '-edit', ['id' => $member['id']])) ?>"><i class="fas fa-pen"></i>Edit</a><?php endif; ?>
                            <?php if (Auth::can($permissionPrefix . '.delete')): ?><button type="submit" class="btn btn-danger btn-small" form="delete-about-member-<?= e($member['id']) ?>" onclick="return confirm('Delete this record?')"><i class="fas fa-trash"></i>Delete</button><?php endif; ?>
                        </div></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($members !== [] && Auth::can($permissionPrefix . '.order')): ?><div class="panel-body"><button class="btn btn-primary" type="submit"><i class="fas fa-sort"></i>Save Display Order</button></div><?php endif; ?>
    </form>

    <?php foreach ($members as $member): ?>
        <form id="delete-about-member-<?= e($member['id']) ?>" method="post" action="<?= e(admin_url($routePrefix . '-delete')) ?>" class="inline-form">
            <?= csrf_field() ?><input type="hidden" name="id" value="<?= e($member['id']) ?>">
        </form>
    <?php endforeach; ?>
</div>
