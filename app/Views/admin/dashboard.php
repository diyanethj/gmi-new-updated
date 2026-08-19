<?php use Gmg\Events\Core\Auth; ?>
<div class="stats">
    <?php if(Auth::can('events.view')): ?><div class="stat"><i class="fas fa-calendar-days"></i><strong><?= e($counts['total']) ?></strong><span>Total events</span></div><?php endif; ?>
    <?php if(Auth::can('partners.view')): ?><div class="stat"><i class="fas fa-handshake"></i><strong><?= e($partnerCount) ?></strong><span>Active partners</span></div><?php endif; ?>
    <?php if(Auth::can('companies.view')): ?><div class="stat"><i class="fas fa-building"></i><strong><?= e($companyCount) ?></strong><span>Active companies</span></div><?php endif; ?>
    <?php if(Auth::can('careers.vacancies.view')): ?><div class="stat"><i class="fas fa-briefcase"></i><strong><?= e($vacancyCount) ?></strong><span>Active vacancies</span></div><?php endif; ?>
    <?php if(Auth::can('careers.applications.view')): ?><div class="stat"><i class="fas fa-file-lines"></i><strong><?= e($applicationCount) ?></strong><span>Applications</span></div><?php endif; ?>
</div>

<div class="quick-actions">
    <?php if(Auth::can('events.create')): ?><a href="<?= e(admin_url('events-create')) ?>"><i class="fas fa-calendar-plus"></i><strong>Create Event</strong><span>Add event details and images</span></a><?php endif; ?>
    <?php if(Auth::can('counters.edit')): ?><a href="<?= e(admin_url('counters')) ?>"><i class="fas fa-chart-column"></i><strong>Edit Counters</strong><span>Update homepage numbers</span></a><?php endif; ?>
    <?php if(Auth::can('footer_contact.edit')): ?><a href="<?= e(admin_url('footer-contact')) ?>"><i class="fas fa-address-card"></i><strong>Edit Footer Contact</strong><span>Update contact details and social links</span></a><?php endif; ?>
    <?php if(Auth::can('partners.create')): ?><a href="<?= e(admin_url('partners-create')) ?>"><i class="fas fa-image"></i><strong>Add Partner</strong><span>Upload a partner logo</span></a><?php endif; ?>
    <?php if(Auth::can('companies.create')): ?><a href="<?= e(admin_url('companies-create')) ?>"><i class="fas fa-building-circle-arrow-right"></i><strong>Add Company</strong><span>Add an image and company name</span></a><?php endif; ?>
    <?php if(Auth::can('careers.vacancies.create')): ?><a href="<?= e(admin_url('careers-vacancies-create')) ?>"><i class="fas fa-briefcase"></i><strong>Create Vacancy</strong><span>Add a GMG or GMS company position</span></a><?php endif; ?>
    <?php if(Auth::can('careers.applications.view')): ?><a href="<?= e(admin_url('careers-applications')) ?>"><i class="fas fa-file-circle-check"></i><strong>View Applications</strong><span>Review applicant details and CVs</span></a><?php endif; ?>
</div>

<?php if(Auth::can('events.view')): ?><div class="panel">
    <div class="panel-head"><h2>Recent Events</h2><?php if(Auth::can('events.create')): ?><a class="btn btn-primary btn-small" href="<?= e(admin_url('events-create')) ?>"><i class="fas fa-plus"></i>Create Event</a><?php endif; ?></div>
    <div class="table-wrap"><table><thead><tr><th>Image</th><th>Event</th><th>Date</th><th>Status</th><th>Gallery</th><th></th></tr></thead><tbody>
    <?php if ($recentEvents === []): ?><tr><td colspan="6" class="empty">No events have been created.</td></tr><?php endif; ?>
    <?php foreach ($recentEvents as $event): ?><tr><td><img class="thumb" src="<?= e(asset_url($event['main_image'])) ?>" alt=""></td><td><strong><?= e($event['name']) ?></strong><br><small><?= e($event['company']) ?></small></td><td><?= e(format_event_date($event['event_date'])) ?></td><td><?= e(ucfirst($event['status'])) ?></td><td><?= e($event['gallery_count']) ?></td><td><?php if(Auth::can('events.edit')): ?><a class="btn btn-secondary btn-small" href="<?= e(admin_url('events-edit',['id'=>$event['id']])) ?>">Edit</a><?php endif; ?></td></tr><?php endforeach; ?>
    </tbody></table></div>
</div><?php endif; ?>