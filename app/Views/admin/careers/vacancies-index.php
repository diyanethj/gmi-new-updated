<?php
use Gmg\Events\Core\Auth;

$companyFilter = isset($companyFilter) && in_array($companyFilter, ['GMG', 'GMS'], true)
    ? $companyFilter
    : '';
?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Career Vacancies</h2>
            <div class="hint">Filter vacancies by GMG or GMS. Lower order numbers appear first within the selected group.</div>
        </div>

        <div class="actions">
            <a class="btn btn-secondary" href="<?= e(base_url('careers.php')) ?>" target="_blank" rel="noopener">
                <i class="fas fa-eye"></i>View Careers Page
            </a>

            <?php if (Auth::can('careers.vacancies.create')): ?>
                <a class="btn btn-primary" href="<?= e(admin_url('careers-vacancies-create')) ?>">
                    <i class="fas fa-plus"></i>Create Vacancy
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="panel-body" style="padding-bottom:0;">
        <div class="actions" style="gap:10px;">
            <a
                class="btn <?= $companyFilter === '' ? 'btn-primary' : 'btn-secondary' ?>"
                href="<?= e(admin_url('careers-vacancies')) ?>"
            >
                <i class="fas fa-list"></i>All Vacancies
            </a>

            <a
                class="btn <?= $companyFilter === 'GMG' ? 'btn-primary' : 'btn-secondary' ?>"
                href="<?= e(admin_url('careers-vacancies', ['company' => 'GMG'])) ?>"
            >
                <i class="fas fa-building"></i>GMG
            </a>

            <a
                class="btn <?= $companyFilter === 'GMS' ? 'btn-primary' : 'btn-secondary' ?>"
                href="<?= e(admin_url('careers-vacancies', ['company' => 'GMS'])) ?>"
            >
                <i class="fas fa-ship"></i>GMS
            </a>
        </div>

        <div class="hint" style="margin-top:10px;">
            Showing:
            <strong><?= e($companyFilter === '' ? 'All GMG and GMS vacancies' : $companyFilter . ' vacancies only') ?></strong>
        </div>
    </div>

    <form method="post" action="<?= e(admin_url('careers-vacancies-order')) ?>">
        <?= csrf_field() ?>

        <?php if ($companyFilter !== ''): ?>
            <input type="hidden" name="company_filter" value="<?= e($companyFilter) ?>">
        <?php endif; ?>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Group</th>
                        <th>Company name</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Applications</th>
                        <th>Order</th>
                        <th>Created by</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($vacancies === []): ?>
                        <tr>
                            <td colspan="8" class="empty">
                                <?= e($companyFilter === '' ? 'No vacancies have been created.' : 'No ' . $companyFilter . ' vacancies have been created.') ?>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($vacancies as $vacancy): ?>
                        <tr>
                            <td><strong><?= e($vacancy['company']) ?></strong></td>
                            <td><?= e($vacancy['company_name']) ?></td>
                            <td><?= e($vacancy['position']) ?></td>
                            <td>
                                <span class="status status-<?= e($vacancy['status']) ?>">
                                    <?= e(ucfirst($vacancy['status'])) ?>
                                </span>
                            </td>
                            <td><?= e($vacancy['application_count']) ?></td>
                            <td>
                                <?php if (Auth::can('careers.vacancies.order')): ?>
                                    <input
                                        class="order-input"
                                        type="number"
                                        min="1"
                                        max="9999"
                                        name="order[<?= e($vacancy['id']) ?>]"
                                        value="<?= e($vacancy['sort_order']) ?>"
                                    >
                                <?php else: ?>
                                    <?= e($vacancy['sort_order']) ?>
                                <?php endif; ?>
                            </td>
                            <td><?= e($vacancy['creator_username'] ?: 'System') ?></td>
                            <td>
                                <div class="actions">
                                    <?php if (Auth::can('careers.vacancies.edit')): ?>
                                        <a
                                            class="btn btn-secondary btn-small"
                                            href="<?= e(admin_url('careers-vacancies-edit', ['id' => $vacancy['id']])) ?>"
                                        >
                                            <i class="fas fa-pen"></i>Edit
                                        </a>
                                    <?php endif; ?>

                                    <?php if (Auth::can('careers.vacancies.delete')): ?>
                                        <button
                                            class="btn btn-danger btn-small"
                                            type="submit"
                                            form="delete-vacancy-<?= e($vacancy['id']) ?>"
                                            onclick="return confirm('Delete this vacancy? Existing applications will be retained.')"
                                        >
                                            <i class="fas fa-trash"></i>Delete
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if ($vacancies !== [] && Auth::can('careers.vacancies.order')): ?>
            <div class="panel-body">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-sort"></i>Save Vacancy Order
                </button>
            </div>
        <?php endif; ?>
    </form>

    <?php if (Auth::can('careers.vacancies.delete')): ?>
        <?php foreach ($vacancies as $vacancy): ?>
            <form
                id="delete-vacancy-<?= e($vacancy['id']) ?>"
                method="post"
                action="<?= e(admin_url('careers-vacancies-delete')) ?>"
                class="inline-form"
            >
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= e($vacancy['id']) ?>">
            </form>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
