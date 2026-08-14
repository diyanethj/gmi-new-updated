<?php use Gmg\Events\Core\Auth; ?>
<div class="panel">
    <div class="panel-head">
        <div><h2>Career Vacancies</h2><div class="hint">GMG and GMS vacancies are displayed separately on the public Careers page. Lower order numbers appear first.</div></div>
        <div class="actions">
            <a class="btn btn-secondary" href="<?= e(base_url('careers.php')) ?>" target="_blank" rel="noopener"><i class="fas fa-eye"></i>View Careers Page</a>
            <?php if (Auth::can('careers.vacancies.create')): ?><a class="btn btn-primary" href="<?= e(admin_url('careers-vacancies-create')) ?>"><i class="fas fa-plus"></i>Create Vacancy</a><?php endif; ?>
        </div>
    </div>
    <form method="post" action="<?= e(admin_url('careers-vacancies-order')) ?>">
        <?= csrf_field() ?>
        <div class="table-wrap"><table><thead><tr><th>Group</th><th>Company name</th><th>Position</th><th>Status</th><th>Applications</th><th>Order</th><th>Created by</th><th></th></tr></thead><tbody>
        <?php if ($vacancies === []): ?><tr><td colspan="8" class="empty">No vacancies have been created.</td></tr><?php endif; ?>
        <?php foreach ($vacancies as $vacancy): ?><tr>
            <td><strong><?= e($vacancy['company']) ?></strong></td>
            <td><?= e($vacancy['company_name']) ?></td>
            <td><?= e($vacancy['position']) ?></td>
            <td><span class="status status-<?= e($vacancy['status']) ?>"><?= e(ucfirst($vacancy['status'])) ?></span></td>
            <td><?= e($vacancy['application_count']) ?></td>
            <td><?php if (Auth::can('careers.vacancies.order')): ?><input class="order-input" type="number" min="1" max="9999" name="order[<?= e($vacancy['id']) ?>]" value="<?= e($vacancy['sort_order']) ?>"><?php else: ?><?= e($vacancy['sort_order']) ?><?php endif; ?></td>
            <td><?= e($vacancy['creator_username'] ?: 'System') ?></td>
            <td><div class="actions">
                <?php if (Auth::can('careers.vacancies.edit')): ?><a class="btn btn-secondary btn-small" href="<?= e(admin_url('careers-vacancies-edit', ['id' => $vacancy['id']])) ?>"><i class="fas fa-pen"></i>Edit</a><?php endif; ?>
                <?php if (Auth::can('careers.vacancies.delete')): ?><button class="btn btn-danger btn-small" type="submit" form="delete-vacancy-<?= e($vacancy['id']) ?>" onclick="return confirm('Delete this vacancy? Existing applications will be retained.')"><i class="fas fa-trash"></i>Delete</button><?php endif; ?>
            </div></td>
        </tr><?php endforeach; ?>
        </tbody></table></div>
        <?php if ($vacancies !== [] && Auth::can('careers.vacancies.order')): ?><div class="panel-body"><button class="btn btn-primary" type="submit"><i class="fas fa-sort"></i>Save Vacancy Order</button></div><?php endif; ?>
    </form>
    <?php if (Auth::can('careers.vacancies.delete')): ?><?php foreach ($vacancies as $vacancy): ?><form id="delete-vacancy-<?= e($vacancy['id']) ?>" method="post" action="<?= e(admin_url('careers-vacancies-delete')) ?>" class="inline-form"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e($vacancy['id']) ?>"></form><?php endforeach; ?><?php endif; ?>
</div>
