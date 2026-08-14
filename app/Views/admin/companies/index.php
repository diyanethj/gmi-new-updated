<?php use Gmg\Events\Core\Auth; ?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Companies Page</h2>
            <div class="hint">Manage the image, company name, destination link, status, and display order shown on companies.php.</div>
        </div>
        <div class="actions">
            <a class="btn btn-secondary" href="<?= e(base_url('companies.php')) ?>" target="_blank" rel="noopener"><i class="fas fa-eye"></i>View Companies Page</a>
            <?php if (Auth::can('companies.create')): ?><a class="btn btn-primary" href="<?= e(admin_url('companies-create')) ?>"><i class="fas fa-plus"></i>Create Company</a><?php endif; ?>
        </div>
    </div>
    <form method="post" action="<?= e(admin_url('companies-order')) ?>">
        <?= csrf_field() ?>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Image</th><th>Company name</th><th>Link</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if ($companies === []): ?><tr><td colspan="6" class="empty">No companies have been created.</td></tr><?php endif; ?>
                <?php foreach ($companies as $company): ?><tr>
                    <td><img class="partner-thumb" src="<?= e(asset_url($company['image_path'])) ?>" alt="<?= e($company['company_name']) ?>"></td>
                    <td><strong><?= e($company['company_name']) ?></strong></td>
                    <td><small><?= e($company['website_url'] ?: 'No link') ?></small></td>
                    <td><span class="status status-<?= e($company['status']) ?>"><?= e(ucfirst($company['status'])) ?></span></td>
                    <td><?php if (Auth::can('companies.order')): ?><input class="order-input" type="number" min="1" max="9999" name="sort_order[<?= e($company['id']) ?>]" value="<?= e($company['sort_order']) ?>"><?php else: ?><?= e($company['sort_order']) ?><?php endif; ?></td>
                    <td><div class="actions">
                        <?php if (Auth::can('companies.edit')): ?><a class="btn btn-secondary btn-small" href="<?= e(admin_url('companies-edit', ['id' => $company['id']])) ?>"><i class="fas fa-pen"></i>Edit</a><?php endif; ?>
                        <?php if (Auth::can('companies.delete')): ?><button class="btn btn-danger btn-small" type="submit" form="delete-company-<?= e($company['id']) ?>" onclick="return confirm('Delete this company?')"><i class="fas fa-trash"></i>Delete</button><?php endif; ?>
                    </div></td>
                </tr><?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($companies !== [] && Auth::can('companies.order')): ?><div class="panel-body"><button class="btn btn-primary" type="submit"><i class="fas fa-sort"></i>Save Company Order</button></div><?php endif; ?>
    </form>
    <?php if (Auth::can('companies.delete')): ?>
        <?php foreach ($companies as $company): ?><form id="delete-company-<?= e($company['id']) ?>" method="post" action="<?= e(admin_url('companies-delete')) ?>" class="inline-form"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e($company['id']) ?>"></form><?php endforeach; ?>
    <?php endif; ?>
</div>
