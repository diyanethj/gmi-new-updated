<?php use Gmg\Events\Core\Auth; ?>
<div class="quick-actions about-quick-actions">
    <?php if(Auth::can('about.directors.view')): ?><a href="<?= e(admin_url('about-directors')) ?>"><i class="fas fa-user-tie"></i><strong>Board of Directors</strong><span>Manage director names, positions, images, status, and order</span></a><?php endif; ?>
    <?php if(Auth::can('about.management.view')): ?><a href="<?= e(admin_url('about-management')) ?>"><i class="fas fa-users-gear"></i><strong>Management Team</strong><span>Manage management names, positions, images, status, and order</span></a><?php endif; ?>
    <?php if(Auth::can('about.teams.view')): ?><a href="<?= e(admin_url('about-teams')) ?>"><i class="fas fa-people-group"></i><strong>Our Teams</strong><span>Manage company names, team images, status, and order</span></a><?php endif; ?>
</div>
<div class="panel"><div class="panel-head"><div><h2>About Page Administration</h2><div class="hint">Only sections assigned to your account are shown. Active records appear publicly and lower order numbers appear first.</div></div><a class="btn btn-secondary" href="<?= e(base_url('about-us.php')) ?>" target="_blank" rel="noopener"><i class="fas fa-arrow-up-right-from-square"></i>View About Page</a></div></div>
