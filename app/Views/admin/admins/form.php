<?php
use Gmg\Events\Core\Auth;
$isEdit = is_array($admin);
$selected = old('permissions', $selectedPermissions);
if (!is_array($selected)) $selected = [];
?>
<div class="panel">
    <div class="panel-head"><div><h2><?= $isEdit ? 'Edit Administrator' : 'Create Administrator' ?></h2><div class="hint">Assign only the actions this administrator needs.</div></div><a class="btn btn-secondary" href="<?= e(admin_url('admins')) ?>">Back to Administrators</a></div>
    <div class="panel-body"><form method="post" action="<?= e(admin_url($isEdit ? 'admins-update' : 'admins-store')) ?>"><?= csrf_field() ?><?php if($isEdit): ?><input type="hidden" name="id" value="<?= e($admin['id']) ?>"><?php endif; ?>
    <div class="form-grid">
        <div class="field"><label for="username">Username</label><input id="username" name="username" maxlength="50" required value="<?= e(old('username',$admin['username']??'')) ?>"><?php foreach(errors('username') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
        <div class="field"><label for="email">Email</label><input id="email" name="email" type="email" maxlength="190" required value="<?= e(old('email',$admin['email']??'')) ?>"><?php foreach(errors('email') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
        <div class="field"><label for="password">Password <?= $isEdit ? '(leave blank to keep current password)' : '' ?></label><input id="password" name="password" type="password" <?= $isEdit ? '' : 'required' ?> autocomplete="new-password"><?php foreach(errors('password') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?><div class="hint">At least 12 characters with uppercase, lowercase, number, and symbol.</div></div>
        <div class="field"><label for="password_confirmation">Confirm password</label><input id="password_confirmation" name="password_confirmation" type="password" <?= $isEdit ? '' : 'required' ?> autocomplete="new-password"><?php foreach(errors('password_confirmation') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
        <div class="field"><label for="role">Role</label><select id="role" name="role" <?= !Auth::isSuperAdmin() ? 'disabled' : '' ?>><option value="admin" <?= old('role',$admin['role']??'admin')==='admin'?'selected':'' ?>>Admin — selected permissions</option><?php if(Auth::isSuperAdmin()): ?><option value="super_admin" <?= old('role',$admin['role']??'')==='super_admin'?'selected':'' ?>>Super Admin — all permissions</option><?php endif; ?></select><?php if(!Auth::isSuperAdmin()): ?><input type="hidden" name="role" value="admin"><?php endif; ?><?php foreach(errors('role') as $message): ?><div class="field-error"><?= e($message) ?></div><?php endforeach; ?></div>
        <div class="field"><label for="is_active">Account status</label><select id="is_active" name="is_active"><option value="1" <?= old('is_active',(string)($admin['is_active']??1))==='1'?'selected':'' ?>>Active</option><option value="0" <?= old('is_active',(string)($admin['is_active']??1))==='0'?'selected':'' ?>>Inactive</option></select></div>
    </div>
    <?php if(Auth::can('admins.permissions')): ?><div class="permission-groups"><h3>Action Permissions</h3><div class="hint">Super Admin accounts automatically receive every permission.</div><?php foreach($permissionGroups as $group=>$permissions): ?><fieldset class="permission-group"><legend><?= e($group) ?></legend><div class="permission-grid"><?php foreach($permissions as $key=>$label): ?><label class="permission-check"><input type="checkbox" name="permissions[]" value="<?= e($key) ?>" <?= in_array($key,$selected,true)?'checked':'' ?>><span><?= e($label) ?></span></label><?php endforeach; ?></div></fieldset><?php endforeach; ?></div><?php endif; ?>
    <div class="form-actions"><button class="btn btn-primary" type="submit"><i class="fas fa-floppy-disk"></i><?= $isEdit?'Update Administrator':'Create Administrator' ?></button><a class="btn btn-secondary" href="<?= e(admin_url('admins')) ?>">Cancel</a></div>
    </form></div>
</div>
