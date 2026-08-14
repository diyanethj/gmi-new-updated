<?php use Gmg\Events\Core\Auth; ?>
<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Homepage Counters</h2>
            <div class="hint">Update the four numbers displayed in the “By The Numbers” section on index.php.</div>
        </div>
        <a class="btn btn-secondary" href="<?= e(base_url('index.php')) ?>" target="_blank" rel="noopener"><i class="fas fa-eye"></i>View Homepage</a>
    </div>
    <div class="panel-body">
        <form method="post" action="<?= e(admin_url('counters-update')) ?>">
            <?= csrf_field() ?>
            <div class="counter-admin-grid">
                <?php foreach ($counters as $counter): ?>
                    <div class="counter-admin-card">
                        <div class="counter-admin-icon">
                            <img src="<?= e(asset_url($counter['icon_path'])) ?>" alt="">
                        </div>
                        <label for="counter-<?= e($counter['id']) ?>"><?= e($counter['label']) ?></label>
                        <input
                            id="counter-<?= e($counter['id']) ?>"
                            type="number"
                            name="counter_value[<?= e($counter['id']) ?>]"
                            min="0"
                            max="2147483647"
                            step="1"
                            required
                            value="<?= e($counter['counter_value']) ?>"
                        >
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-actions">
                <?php if (Auth::can('counters.edit')): ?><button class="btn btn-primary" type="submit"><i class="fas fa-floppy-disk"></i>Save Counter Numbers</button><?php endif; ?>
            </div>
        </form>
    </div>
</div>
