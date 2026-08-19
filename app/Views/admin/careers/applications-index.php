<?php
use Gmg\Events\Core\Auth;

$companyFilter = isset($companyFilter) && in_array($companyFilter, ['GMG', 'GMS'], true)
    ? $companyFilter
    : '';

$vacancyFilter = isset($vacancyFilter) && is_int($vacancyFilter) && $vacancyFilter > 0
    ? $vacancyFilter
    : null;

$vacancyOptions = isset($vacancyOptions) && is_array($vacancyOptions)
    ? $vacancyOptions
    : [];
?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Career Applications</h2>
            <div class="hint">Filter applications by group and by individual vacancy. Applicant details and CV files are private.</div>
        </div>
    </div>

    <div class="panel-body" style="padding-bottom:0;">
        <div class="actions" style="gap:10px;margin-bottom:16px;">
            <a
                class="btn <?= $companyFilter === '' ? 'btn-primary' : 'btn-secondary' ?>"
                href="<?= e(admin_url('careers-applications')) ?>"
            >
                <i class="fas fa-list"></i>All Applications
            </a>

            <a
                class="btn <?= $companyFilter === 'GMG' ? 'btn-primary' : 'btn-secondary' ?>"
                href="<?= e(admin_url('careers-applications', ['company' => 'GMG'])) ?>"
            >
                <i class="fas fa-building"></i>GMG
            </a>

            <a
                class="btn <?= $companyFilter === 'GMS' ? 'btn-primary' : 'btn-secondary' ?>"
                href="<?= e(admin_url('careers-applications', ['company' => 'GMS'])) ?>"
            >
                <i class="fas fa-ship"></i>GMS
            </a>
        </div>

        <form method="get" action="<?= e(admin_url('careers-applications')) ?>" class="form-grid" style="grid-template-columns:minmax(180px,.45fr) minmax(280px,1fr) auto;align-items:end;">
            <input type="hidden" name="action" value="careers-applications">

            <div class="field">
                <label for="application-company-filter">Group</label>
                <select id="application-company-filter" name="company">
                    <option value="">All Groups</option>
                    <option value="GMG" <?= $companyFilter === 'GMG' ? 'selected' : '' ?>>GMG</option>
                    <option value="GMS" <?= $companyFilter === 'GMS' ? 'selected' : '' ?>>GMS</option>
                </select>
            </div>

            <div class="field">
                <label for="application-vacancy-filter">Vacancy</label>
                <select id="application-vacancy-filter" name="vacancy">
                    <option value="">All Vacancies</option>

                    <?php foreach ($vacancyOptions as $option): ?>
                        <?php
                        $optionId = (int) ($option['vacancy_id'] ?? 0);
                        $optionCompany = (string) ($option['company'] ?? '');
                        $optionPosition = (string) ($option['vacancy_position'] ?? '');
                        $optionCompanyName = (string) ($option['company_name'] ?? '');
                        $optionCount = (int) ($option['application_count'] ?? 0);

                        $label = $optionCompany . ' — ' . $optionPosition;

                        if ($optionCompanyName !== '') {
                            $label .= ' (' . $optionCompanyName . ')';
                        }

                        $label .= ' — ' . $optionCount . ' application' . ($optionCount === 1 ? '' : 's');
                        ?>
                        <option value="<?= e($optionId) ?>" <?= $vacancyFilter === $optionId ? 'selected' : '' ?>>
                            <?= e($label) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="actions">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-filter"></i>Apply Filter
                </button>

                <?php if ($companyFilter !== '' || $vacancyFilter !== null): ?>
                    <a class="btn btn-secondary" href="<?= e(admin_url('careers-applications')) ?>">
                        <i class="fas fa-rotate-left"></i>Clear
                    </a>
                <?php endif; ?>
            </div>
        </form>

        <div class="hint" style="margin-top:12px;">
            Showing:
            <strong>
                <?php if ($companyFilter === '' && $vacancyFilter === null): ?>
                    All GMG and GMS applications
                <?php elseif ($companyFilter !== '' && $vacancyFilter === null): ?>
                    <?= e($companyFilter) ?> applications
                <?php elseif ($companyFilter === '' && $vacancyFilter !== null): ?>
                    Applications for the selected vacancy
                <?php else: ?>
                    <?= e($companyFilter) ?> applications for the selected vacancy
                <?php endif; ?>
            </strong>
        </div>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Applicant</th>
                    <th>Vacancy</th>
                    <th>Group / Company</th>
                    <th>Phone</th>
                    <th>Applied</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($applications === []): ?>
                    <tr>
                        <td colspan="6" class="empty">No applications match the selected filters.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($applications as $application): ?>
                    <tr>
                        <td>
                            <strong><?= e($application['applicant_name']) ?></strong><br>
                            <span class="hint"><?= e($application['email']) ?></span>
                        </td>

                        <td><?= e($application['vacancy_position']) ?></td>

                        <td>
                            <strong><?= e($application['company']) ?></strong><br>
                            <span class="hint"><?= e($application['company_name']) ?></span>
                        </td>

                        <td><?= e($application['phone']) ?></td>
                        <td><?= e($application['created_at']) ?></td>

                        <td>
                            <div class="actions">
                                <?php
                                $viewParams = ['id' => $application['id']];

                                if ($companyFilter !== '') {
                                    $viewParams['company'] = $companyFilter;
                                }

                                if ($vacancyFilter !== null) {
                                    $viewParams['vacancy'] = $vacancyFilter;
                                }
                                ?>
                                <a
                                    class="btn btn-secondary btn-small"
                                    href="<?= e(admin_url('careers-application-view', $viewParams)) ?>"
                                >
                                    <i class="fas fa-eye"></i>View
                                </a>

                                <?php if (Auth::can('careers.applications.download')): ?>
                                    <a
                                        class="btn btn-primary btn-small"
                                        href="<?= e(admin_url('careers-application-download', ['id' => $application['id']])) ?>"
                                    >
                                        <i class="fas fa-download"></i>CV
                                    </a>
                                <?php endif; ?>

                                <?php if (Auth::can('careers.applications.delete')): ?>
                                    <button
                                        class="btn btn-danger btn-small"
                                        type="submit"
                                        form="delete-application-<?= e($application['id']) ?>"
                                        onclick="return confirm('Delete this application and CV permanently?')"
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

    <?php if (Auth::can('careers.applications.delete')): ?>
        <?php foreach ($applications as $application): ?>
            <form
                id="delete-application-<?= e($application['id']) ?>"
                method="post"
                action="<?= e(admin_url('careers-application-delete')) ?>"
                class="inline-form"
            >
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= e($application['id']) ?>">

                <?php if ($companyFilter !== ''): ?>
                    <input type="hidden" name="company_filter" value="<?= e($companyFilter) ?>">
                <?php endif; ?>

                <?php if ($vacancyFilter !== null): ?>
                    <input type="hidden" name="vacancy_filter" value="<?= e($vacancyFilter) ?>">
                <?php endif; ?>
            </form>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
