<?php
use Gmg\Events\Core\Auth;

$companyFilter = isset($companyFilter) && in_array($companyFilter, ['GMG', 'GMS'], true)
    ? $companyFilter
    : '';

$vacancyFilter = isset($vacancyFilter) && is_int($vacancyFilter) && $vacancyFilter > 0
    ? $vacancyFilter
    : null;

$backParams = [];

if ($companyFilter !== '') {
    $backParams['company'] = $companyFilter;
}

if ($vacancyFilter !== null) {
    $backParams['vacancy'] = $vacancyFilter;
}
?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Application Details</h2>
            <div class="hint">Application #<?= e($application['id']) ?></div>
        </div>

        <a class="btn btn-secondary" href="<?= e(admin_url('careers-applications', $backParams)) ?>">
            Back to Applications
        </a>
    </div>

    <div class="panel-body">
        <div class="form-grid">
            <div class="field">
                <label>Applicant name</label>
                <div><?= e($application['applicant_name']) ?></div>
            </div>

            <div class="field">
                <label>Email</label>
                <div><a href="mailto:<?= e($application['email']) ?>"><?= e($application['email']) ?></a></div>
            </div>

            <div class="field">
                <label>Phone</label>
                <div><a href="tel:<?= e($application['phone']) ?>"><?= e($application['phone']) ?></a></div>
            </div>

            <div class="field">
                <label>Group</label>
                <div><?= e($application['company']) ?></div>
            </div>

            <div class="field">
                <label>Company name</label>
                <div><?= e($application['company_name']) ?></div>
            </div>

            <div class="field full">
                <label>Applied position</label>
                <div><?= e($application['vacancy_position']) ?></div>
            </div>

            <div class="field">
                <label>CV filename</label>
                <div><?= e($application['original_cv_name']) ?></div>
            </div>

            <div class="field">
                <label>CV size</label>
                <div><?= e(number_format(((int) $application['cv_size']) / 1024, 1)) ?> KB</div>
            </div>

            <div class="field">
                <label>Submitted</label>
                <div><?= e($application['created_at']) ?></div>
            </div>
        </div>

        <div class="form-actions">
            <?php if (Auth::can('careers.applications.download')): ?>
                <a
                    class="btn btn-primary"
                    href="<?= e(admin_url('careers-application-download', ['id' => $application['id']])) ?>"
                >
                    <i class="fas fa-download"></i>Download CV
                </a>
            <?php endif; ?>

            <?php if (Auth::can('careers.applications.delete')): ?>
                <form
                    method="post"
                    action="<?= e(admin_url('careers-application-delete')) ?>"
                    onsubmit="return confirm('Delete this application and CV permanently?')"
                >
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= e($application['id']) ?>">

                    <?php if ($companyFilter !== ''): ?>
                        <input type="hidden" name="company_filter" value="<?= e($companyFilter) ?>">
                    <?php endif; ?>

                    <?php if ($vacancyFilter !== null): ?>
                        <input type="hidden" name="vacancy_filter" value="<?= e($vacancyFilter) ?>">
                    <?php endif; ?>

                    <button class="btn btn-danger" type="submit">
                        <i class="fas fa-trash"></i>Delete Application
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
