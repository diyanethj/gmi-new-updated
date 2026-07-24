<?php
use Gmg\Events\Core\Auth;
$user = Auth::user();
$successMessage = flash('success');
$errorMessage = flash('error');
$currentAction = (string) ($_GET['action'] ?? 'dashboard');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>GMG Events Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root{--navy:#071525;--navy2:#10243d;--blue:#20366c;--light:#f4f7fb;--border:#dfe7ef;--muted:#637284;--danger:#b42318;--success:#067647}*{box-sizing:border-box}body{margin:0;background:var(--light);color:#102033;font-family:Inter,Arial,sans-serif}.admin-shell{display:grid;grid-template-columns:260px minmax(0,1fr);min-height:100vh}.sidebar{position:sticky;top:0;height:100vh;padding:24px 18px;background:linear-gradient(165deg,var(--navy),var(--navy2));color:#fff}.brand{display:flex;align-items:center;gap:12px;padding:4px 8px 25px;border-bottom:1px solid rgba(255,255,255,.11)}.brand img{width:155px;max-height:55px;object-fit:contain;filter:brightness(0) invert(1)}.brand span{font-size:11px;color:#9dc9ff}.nav{display:grid;gap:7px;margin-top:22px}.nav a{display:flex;align-items:center;gap:11px;padding:12px 14px;border-radius:11px;color:#cfe0ef;text-decoration:none;font-size:13px;font-weight:650}.nav a:hover,.nav a.active{background:rgba(138,196,255,.14);color:#fff}.nav i{width:18px;color:#8ac4ff}.sidebar-bottom{position:absolute;right:18px;bottom:22px;left:18px;padding-top:18px;border-top:1px solid rgba(255,255,255,.11)}.user{margin-bottom:12px;color:#cfe0ef;font-size:12px}.user strong{display:block;color:#fff;font-size:13px}.logout{width:100%;padding:10px 13px;border:1px solid rgba(255,255,255,.17);border-radius:10px;color:#fff;background:rgba(255,255,255,.07);cursor:pointer}.main{min-width:0;padding:30px}.topbar{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-bottom:25px}.topbar h1{margin:0;color:#0a1a2b;font-size:28px;letter-spacing:-.7px}.topbar p{margin:5px 0 0;color:var(--muted);font-size:13px}.public-link,.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:42px;padding:10px 17px;border:0;border-radius:10px;font-size:13px;font-weight:700;text-decoration:none;cursor:pointer}.public-link,.btn-primary{color:#fff;background:linear-gradient(145deg,#20366c,#2a4a8a);box-shadow:0 8px 20px rgba(32,54,108,.22)}.btn-secondary{color:#20366c;background:#edf2f8}.btn-danger{color:#fff;background:#b42318}.btn-small{min-height:34px;padding:7px 11px;font-size:11px}.alert{margin-bottom:18px;padding:13px 16px;border-radius:11px;font-size:13px}.alert-success{border:1px solid #a6f4c5;color:#067647;background:#ecfdf3}.alert-error{border:1px solid #fecdca;color:#b42318;background:#fef3f2}.panel{overflow:hidden;margin-bottom:22px;border:1px solid var(--border);border-radius:17px;background:#fff;box-shadow:0 10px 28px rgba(7,21,37,.06)}.panel-head{display:flex;align-items:center;justify-content:space-between;gap:15px;padding:19px 21px;border-bottom:1px solid var(--border)}.panel-head h2{margin:0;font-size:17px}.panel-body{padding:21px}.stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:17px;margin-bottom:23px}.stat{padding:20px;border:1px solid var(--border);border-radius:15px;background:#fff;box-shadow:0 8px 22px rgba(7,21,37,.05)}.stat i{display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;margin-bottom:15px;border-radius:12px;color:#fff;background:linear-gradient(145deg,#10243d,#20366c)}.stat strong{display:block;font-size:27px}.stat span{color:var(--muted);font-size:12px}.table-wrap{overflow-x:auto}table{width:100%;border-collapse:collapse}th,td{padding:13px 14px;border-bottom:1px solid #edf1f5;text-align:left;vertical-align:middle;font-size:12px}th{color:#536273;background:#f8fafc;font-size:10px;letter-spacing:.6px;text-transform:uppercase}tbody tr:hover{background:#fbfdff}.thumb{width:78px;height:56px;border-radius:9px;object-fit:cover;background:#eef2f6}.badge{display:inline-flex;padding:5px 9px;border-radius:999px;font-size:10px;font-weight:750}.badge-published{color:#067647;background:#ecfdf3}.badge-draft{color:#b54708;background:#fffaeb}.actions{display:flex;align-items:center;gap:7px;flex-wrap:wrap}.inline-form{display:inline}.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.field{display:grid;gap:7px}.field-full{grid-column:1/-1}label{font-size:12px;font-weight:700;color:#344054}input,textarea,select{width:100%;padding:11px 13px;border:1px solid #ccd6e0;border-radius:10px;background:#fff;color:#102033;font:inherit;font-size:13px;outline:none}input:focus,textarea:focus,select:focus{border-color:#2a4a8a;box-shadow:0 0 0 3px rgba(42,74,138,.10)}textarea{min-height:190px;resize:vertical}.hint{color:#718096;font-size:11px}.field-error{color:#b42318;font-size:11px}.form-actions{display:flex;gap:10px;margin-top:22px}.gallery-admin{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:13px}.gallery-item{overflow:hidden;border:1px solid var(--border);border-radius:12px;background:#f8fafc}.gallery-item img{width:100%;aspect-ratio:4/3;object-fit:cover}.gallery-controls{padding:10px}.check-row{display:flex;align-items:center;gap:7px;font-size:11px}.check-row input{width:auto}.order-input{width:76px!important;padding:7px!important}.empty{padding:35px;text-align:center;color:var(--muted)}@media(max-width:1050px){.admin-shell{grid-template-columns:210px minmax(0,1fr)}.stats{grid-template-columns:repeat(2,1fr)}.gallery-admin{grid-template-columns:repeat(3,1fr)}}@media(max-width:760px){.admin-shell{display:block}.sidebar{position:relative;height:auto}.sidebar-bottom{position:static;margin-top:20px}.main{padding:20px 14px}.topbar{align-items:flex-start;flex-direction:column}.form-grid{grid-template-columns:1fr}.gallery-admin{grid-template-columns:repeat(2,1fr)}.stats{grid-template-columns:1fr 1fr}}@media(max-width:450px){.stats,.gallery-admin{grid-template-columns:1fr}.actions{min-width:170px}}
    </style>
</head>
<body>
<div class="admin-shell">
    <aside class="sidebar">
        <div class="brand"><img src="<?= e(asset_url('images/logo/GMG 3L WHITE.png')) ?>" alt="GMG"><span>EVENTS ADMIN</span></div>
        <nav class="nav">
            <a class="<?= $currentAction === 'dashboard' ? 'active' : '' ?>" href="<?= e(admin_url('dashboard')) ?>"><i class="fas fa-chart-pie"></i>Dashboard</a>
            <a class="<?= str_starts_with($currentAction, 'events') ? 'active' : '' ?>" href="<?= e(admin_url('events')) ?>"><i class="fas fa-calendar-check"></i>Events</a>
            <a href="<?= e(admin_url('events-create')) ?>"><i class="fas fa-circle-plus"></i>Create Event</a>
            <?php if (Auth::isSuperAdmin()): ?><a class="<?= str_starts_with($currentAction, 'admins') ? 'active' : '' ?>" href="<?= e(admin_url('admins')) ?>"><i class="fas fa-user-shield"></i>Administrators</a><?php endif; ?>
        </nav>
        <div class="sidebar-bottom">
            <div class="user"><strong><?= e($user['username'] ?? '') ?></strong><?= e(str_replace('_', ' ', $user['role'] ?? '')) ?></div>
            <form method="post" action="<?= e(admin_url('logout')) ?>"><?= csrf_field() ?><button class="logout" type="submit"><i class="fas fa-right-from-bracket"></i> Sign out</button></form>
        </div>
    </aside>
    <main class="main">
        <div class="topbar"><div><h1>Events Administration</h1><p>Manage public events, event galleries, display order, and administrators.</p></div><a class="public-link" href="<?= e(base_url('events.php')) ?>" target="_blank" rel="noopener"><i class="fas fa-arrow-up-right-from-square"></i>View Website</a></div>
        <?php if ($successMessage): ?><div class="alert alert-success"><?= e($successMessage) ?></div><?php endif; ?>
        <?php if ($errorMessage): ?><div class="alert alert-error"><?= e($errorMessage) ?></div><?php endif; ?>
        <?= $content ?>
    </main>
</div>
</body>
</html>
