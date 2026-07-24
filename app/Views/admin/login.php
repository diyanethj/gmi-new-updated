<div class="login-card">
    <img class="logo" src="<?= e(asset_url('images/logo/GMG 3L.png')) ?>" alt="Global Marine Group">
    <h1>Admin Sign In</h1><p>Secure access to the Events management panel.</p>
    <?php if ($errorMessage): ?><div class="alert"><?= e($errorMessage) ?></div><?php endif; ?>
    <form method="post" action="<?= e(admin_url('login')) ?>" autocomplete="on">
        <?= csrf_field() ?>
        <div class="field"><label for="login">Username or email</label><input id="login" name="login" type="text" maxlength="190" required autocomplete="username"></div>
        <div class="field"><label for="password">Password</label><input id="password" name="password" type="password" required autocomplete="current-password"></div>
        <button type="submit">Sign In</button>
    </form>
    <a class="back" href="<?= e(base_url('events.php')) ?>">Return to Events</a>
</div>
