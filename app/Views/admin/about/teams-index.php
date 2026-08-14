<?php use Gmg\Events\Core\Auth; ?>
<div class="panel">
    <div class="panel-head">
        <div><h2>Our Teams</h2><div class="hint">Manage the company team images and names shown near the bottom of the About Us page.</div></div>
        <div class="actions"><a class="btn btn-secondary" href="<?= e(admin_url('about')) ?>"><i class="fas fa-arrow-left"></i>About Overview</a><?php if (Auth::can('about.teams.create')): ?><a class="btn btn-primary" href="<?= e(admin_url('about-teams-create')) ?>"><i class="fas fa-plus"></i>Add Company Team</a><?php endif; ?></div>
    </div>
    <form method="post" action="<?= e(admin_url('about-teams-order')) ?>">
        <?= csrf_field() ?>
        <div class="table-wrap"><table><thead><tr><th>Team image</th><th>Company name</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead><tbody>
        <?php if ($teams === []): ?><tr><td colspan="5" class="empty">No company team records are available.</td></tr><?php endif; ?>
        <?php foreach ($teams as $team): ?><tr>
            <td><img class="about-team-thumb" src="<?= e(asset_url($team['image_path'])) ?>" alt="<?= e($team['company_name']) ?>"></td>
            <td><strong><?= e($team['company_name']) ?></strong></td>
            <td><span class="badge badge-<?= e($team['status'] === 'active' ? 'published' : 'draft') ?>"><?= e(ucfirst($team['status'])) ?></span></td>
            <td><input class="order-input" type="number" min="1" max="9999" <?= Auth::can('about.teams.order') ? '' : 'disabled' ?> name="sort_order[<?= e($team['id']) ?>]" value="<?= e($team['sort_order']) ?>" aria-label="Order for <?= e($team['company_name']) ?>"></td>
            <td><div class="actions"><?php if (Auth::can('about.teams.edit')): ?><a class="btn btn-secondary btn-small" href="<?= e(admin_url('about-teams-edit', ['id' => $team['id']])) ?>"><i class="fas fa-pen"></i>Edit</a><?php endif; ?><?php if (Auth::can('about.teams.delete')): ?><button type="submit" class="btn btn-danger btn-small" form="delete-about-team-<?= e($team['id']) ?>" onclick="return confirm('Delete this company team?')"><i class="fas fa-trash"></i>Delete</button><?php endif; ?></div></td>
        </tr><?php endforeach; ?>
        </tbody></table></div>
        <?php if ($teams !== [] && Auth::can('about.teams.order')): ?><div class="panel-body"><button class="btn btn-primary" type="submit"><i class="fas fa-sort"></i>Save Display Order</button></div><?php endif; ?>
    </form>
    <?php foreach ($teams as $team): ?><form id="delete-about-team-<?= e($team['id']) ?>" method="post" action="<?= e(admin_url('about-teams-delete')) ?>" class="inline-form"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e($team['id']) ?>"></form><?php endforeach; ?>
</div>
