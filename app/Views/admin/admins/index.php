<?php use Gmg\Events\Core\Auth; ?>
<div class="panel">
    <div class="panel-head">
        <div><h2>Administrators</h2><div class="hint">Permission-based access controls which sidebar pages and action buttons each administrator can use.</div></div>
        <?php if (Auth::can('admins.create')): ?><a class="btn btn-primary" href="<?= e(admin_url('admins-create')) ?>"><i class="fas fa-user-plus"></i>Create Administrator</a><?php endif; ?>
    </div>
    <div class="table-wrap"><table><thead><tr><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th>Permissions</th><th>Created by</th><th>Last login</th><th></th></tr></thead><tbody>
    <?php if ($admins === []): ?><tr><td colspan="8" class="empty">No manageable administrators found.</td></tr><?php endif; ?>
    <?php foreach ($admins as $admin): ?><tr>
        <td><strong><?= e($admin['username']) ?></strong></td><td><?= e($admin['email']) ?></td>
        <td><?= e(ucwords(str_replace('_',' ',$admin['role']))) ?></td>
        <td><span class="status status-<?= (int)$admin['is_active'] === 1 ? 'active' : 'inactive' ?>"><?= (int)$admin['is_active'] === 1 ? 'Active' : 'Inactive' ?></span></td>
        <td><?= $admin['role'] === 'super_admin' ? 'All permissions' : e(count($admin['permissions'])) . ' assigned' ?></td>
        <td><?= e($admin['creator_username'] ?: 'System') ?></td><td><?= e($admin['last_login_at'] ?: 'Never') ?></td>
        <td><div class="actions">
            <?php if (Auth::can('admins.edit')): ?><a class="btn btn-secondary btn-small" href="<?= e(admin_url('admins-edit',['id'=>$admin['id']])) ?>"><i class="fas fa-pen"></i>Edit</a><?php endif; ?>
            <?php if (Auth::can('admins.delete') && (int)$admin['id'] !== (int)Auth::id()): ?><form method="post" action="<?= e(admin_url('admins-delete')) ?>" onsubmit="return confirm('Delete this administrator?')"><?= csrf_field() ?><input type="hidden" name="id" value="<?= e($admin['id']) ?>"><button class="btn btn-danger btn-small" type="submit"><i class="fas fa-trash"></i>Delete</button></form><?php endif; ?>
        </div></td>
    </tr><?php endforeach; ?>
    </tbody></table></div>
</div>
