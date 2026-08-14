<?php use Gmg\Events\Core\Auth; ?>
<div class="panel">
    <div class="panel-head"><div><h2>Career Applications</h2><div class="hint">Applicant details and CV files are private and available only to authorized administrators.</div></div></div>
    <div class="table-wrap"><table><thead><tr><th>Applicant</th><th>Vacancy</th><th>Group / Company</th><th>Phone</th><th>Applied</th><th></th></tr></thead><tbody>
    <?php if ($applications === []): ?><tr><td colspan="6" class="empty">No applications have been received.</td></tr><?php endif; ?>
    <?php foreach ($applications as $application): ?><tr>
        <td><strong><?= e($application['applicant_name']) ?></strong><br><span class="hint"><?= e($application['email']) ?></span></td>
        <td><?= e($application['vacancy_position']) ?></td><td><strong><?= e($application['company']) ?></strong><br><span class="hint"><?= e($application['company_name']) ?></span></td><td><?= e($application['phone']) ?></td><td><?= e($application['created_at']) ?></td>
        <td><div class="actions"><a class="btn btn-secondary btn-small" href="<?= e(admin_url('careers-application-view', ['id' => $application['id']])) ?>"><i class="fas fa-eye"></i>View</a><?php if (Auth::can('careers.applications.download')): ?><a class="btn btn-primary btn-small" href="<?= e(admin_url('careers-application-download', ['id' => $application['id']])) ?>"><i class="fas fa-download"></i>CV</a><?php endif; ?><?php if (Auth::can('careers.applications.delete')): ?><button class="btn btn-danger btn-small" type="submit" form="delete-application-<?= e($application['id']) ?>" onclick="return confirm('Delete this application and CV permanently?')"><i class="fas fa-trash"></i>Delete</button><?php endif; ?></div></td>
    </tr><?php endforeach; ?>
    </tbody></table></div>
    <?php if (Auth::can('careers.applications.delete')): ?><?php foreach ($applications as $application): ?><form id="delete-application-<?= e($application['id']) ?>" method="post" action="<?= e(admin_url('careers-application-delete')) ?>" class="inline-form"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e($application['id']) ?>"></form><?php endforeach; ?><?php endif; ?>
</div>
