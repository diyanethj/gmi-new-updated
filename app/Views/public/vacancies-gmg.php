<?php
try {
    $footerContact = (
        new \Gmg\Events\Models\FooterContact(
            \Gmg\Events\Core\Database::connection()
        )
    )->get();
} catch (\Throwable $exception) {
    error_log('Footer contact load failed on join employee page: ' . $exception->getMessage());

    $footerContact = [
        'address' => '292 R. A. De Mel Mawatha, Colombo, Sri Lanka',
        'phone' => '+94 11 2 345 678',
        'email' => 'info@gmigroup.lk',
        'office_hours' => 'Mon - Fri: 8:30 AM - 5:30 PM',
        'linkedin_url' => null,
        'facebook_url' => null,
        'instagram_url' => null,
        'tiktok_url' => null,
        'youtube_url' => null,
    ];
}

$footerPhoneHref = preg_replace(
    '/[^0-9+]/',
    '',
    (string) ($footerContact['phone'] ?? '')
);
?>
<!doctype html>
<html class="no-js gmi-loading-root" lang="en" style="background:#071525;">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KQ95BNCRG5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-KQ95BNCRG5');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Global Marine Group">
    <meta name="description" content="Explore current join as employee opportunities at Global Marine Group.">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Global Marine Group">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Join as Employee - Global Marine Group</title>

    <link rel="shortcut icon" type="image/x-icon" href="images/logo/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://images.pexels.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
:root {
    --gmi-blue: #20366C;
    --gmi-blue-light: #2a4a8a;
    --gmi-blue-gradient: linear-gradient(145deg, #20366C 0%, #2a4a8a 100%);
    --gmi-navy: #071525;
    --gmi-sky: #8ac4ff;
    --gmi-surface: #f5f8fc;
    --gmi-ease: cubic-bezier(0.16, 1, 0.3, 1);
}

* { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
    margin: 0;
    padding-top: 88px;
    overflow-x: hidden;
    background: var(--gmi-surface);
    color: #102033;
    font-family: 'EB Garamond', Georgia, 'Times New Roman', serif;
    -webkit-font-smoothing: antialiased;
}
img { max-width: 100%; }
a { color: inherit; }
::selection { color: #fff; background: var(--gmi-blue); }
.container { width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 30px; }
.fa, .fas, .far, .fab { line-height: 1; }

/* Loader */
#loader-wrapper {
    position: fixed; inset: 0; z-index: 99999;
    display: flex; align-items: center; justify-content: center;
    background: #fff;
    transition: opacity .4s ease, visibility .4s ease;
}
#loader-wrapper.gmi-loaded { opacity: 0; visibility: hidden; pointer-events: none; }
#loader img { width: 120px; height: auto; }

/* Progress bar */
.gmi-progress-bar {
    position: fixed; top: 0; left: 0; z-index: 100000;
    width: 100%; height: 4px;
    background: linear-gradient(90deg, #20366C 0%, #2a4a8a 50%, #1e90ff 100%);
    transform: scaleX(0); transform-origin: left center;
    will-change: transform;
}

/* Exact homepage header language */
.gmi-custom-header {
    position: fixed; top: 0; left: 0; z-index: 9999;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;
    width: 100%; min-height: 88px; padding: 14px 30px;
    background: #fff; box-shadow: 0 2px 16px rgba(0,0,0,.10);
}
.gmi-header-left { display: flex; align-items: center; gap: 20px; }
.gmi-logo-link { display: inline-flex; align-items: center; line-height: 0; text-decoration: none; }
.logo-img { width: auto; max-height: 60px; }
.gmi-nav-buttons { display: flex; align-items: center; justify-content: flex-end; flex-wrap: wrap; gap: 8px 18px; margin: 5px 0; }
.gmi-nav-buttons > a:not(.gmi-quote-btn) {
    position: relative; padding: 10px 16px; border-radius: 8px;
    color: #0a1a2b; font-size: 14px; font-weight: 600; letter-spacing: .3px;
    text-decoration: none; white-space: nowrap; transition: .25s ease;
}
.gmi-nav-buttons > a:not(.gmi-quote-btn)::after {
    content: ''; position: absolute; left: 16px; right: 16px; bottom: 6px;
    height: 2px; border-radius: 2px; background: var(--gmi-blue-gradient);
    transform: scaleX(0); transform-origin: left; transition: transform .3s ease;
}
.gmi-nav-buttons > a:not(.gmi-quote-btn):hover,
.gmi-nav-buttons > a.gmi-current { color: var(--gmi-blue); background: #f0f4f8; }
.gmi-nav-buttons > a:not(.gmi-quote-btn):hover::after,
.gmi-nav-buttons > a.gmi-current::after { transform: scaleX(1); }
.gmi-nav-buttons a.gmi-quote-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    min-height: 44px; margin-left: 10px; padding: 12px 24px; border-radius: 30px;
    color: #fff; background: var(--gmi-blue-gradient);
    box-shadow: 0 6px 18px rgba(32,54,108,.28);
    font-size: 12.5px; font-weight: 700; letter-spacing: .4px; text-decoration: none;
    white-space: nowrap; transition: .3s ease;
}
.gmi-nav-buttons a.gmi-quote-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(32,54,108,.38); color: #fff; }
.gmi-nav-buttons a.gmi-quote-btn i { font-size: 8.5px; }
.gmi-hamburger {
    display: none; flex-direction: column; align-items: center; justify-content: center; gap: 5px;
    width: 42px; height: 42px; padding: 6px; border: 0; border-radius: 8px;
    background: transparent; cursor: pointer;
}
.gmi-hamburger:hover { background: #f0f4f8; }
.gmi-hamburger span { display: block; width: 30px; height: 3.5px; border-radius: 4px; background: #0a1a2b; }
.gmi-nav-mobile {
    display: none; flex-direction: column; width: 100%; margin-top: 12px; padding: 12px 0;
    border-top: 1px solid #eaeaea; background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,.05);
}
.gmi-nav-mobile.open { display: flex; }
.gmi-nav-mobile a { display: block; width: 100%; padding: 14px 24px; border-bottom: 1px solid #f0f0f0; color: #0a1a2b; font-size: 16px; font-weight: 700; text-decoration: none; }
.gmi-nav-mobile a:hover, .gmi-nav-mobile a.gmi-current { color: var(--gmi-blue); background: #f5f8fc; }

/* Breadcrumb */
.breadcrumb-section {
    position: relative; overflow: hidden; isolation: isolate;
    min-height: 330px; padding: 155px 0 76px;
    background:
        radial-gradient(circle at 20% 70%, rgba(63,120,189,.28), transparent 38%),
        linear-gradient(90deg, rgba(4,14,26,.90), rgba(4,14,26,.58), rgba(4,14,26,.78)),
        url('https://images.pexels.com/photos/7640811/pexels-photo-7640811.jpeg?auto=compress&cs=tinysrgb&w=1920') center 43% / cover no-repeat;
}
.breadcrumb-area { text-align: center; }
.breadcrumb-title {
    display: inline-block; margin: 0;
    padding: 12px 22px 12px 26px;
    border: 1px solid rgba(255,255,255,.16); border-left: 6px solid #1e90ff;
    border-radius: 0 16px 16px 0;
    background: rgba(255,255,255,.07);
    box-shadow: inset 0 1px 0 rgba(255,255,255,.10), 0 16px 38px rgba(0,0,0,.20);
    color: #fff; font-size: clamp(32px, 4vw, 48px); font-weight: 800;
    line-height: 1.2; letter-spacing: -1.3px; text-shadow: 0 2px 20px rgba(0,0,0,.45);
}
.breadcrumb-ul { display: flex; justify-content: center; flex-wrap: wrap; gap: 12px; margin: 18px 0 0; padding: 0; list-style: none; }
.breadcrumb-ul li { color: #b8d4f0; font-size: 12.5px; }
.breadcrumb-ul li a { color: #8ac4ff; text-decoration: none; }
.breadcrumb-ul li a:hover { color: #fff; }
.active-breadcrumb { color: #fff; }

/* Careers */
.careers-main { position: relative; overflow: hidden; background: linear-gradient(180deg, #fff 0%, #f4f8fc 100%); }
.careers-main::before,
.careers-main::after {
    content: ''; position: absolute; z-index: 0; width: 440px; height: 440px;
    border-radius: 50%; pointer-events: none;
}
.careers-main::before { top: -250px; right: -190px; background: radial-gradient(circle, rgba(63,120,189,.12), transparent 68%); }
.careers-main::after { bottom: -270px; left: -210px; background: radial-gradient(circle, rgba(32,54,108,.09), transparent 68%); }
.careers-section { position: relative; z-index: 1; padding: 94px 0 108px; }
.careers-intro { max-width: 950px; margin: 0 auto 66px; text-align: center; }
.careers-kicker {
    display: inline-flex; align-items: center; gap: 9px; margin-bottom: 16px;
    color: var(--gmi-blue); font-size: 12px; font-weight: 800; letter-spacing: 2.5px; text-transform: uppercase;
}
.careers-kicker::before, .careers-kicker::after { content: ''; width: 28px; height: 2px; border-radius: 2px; background: var(--gmi-blue-gradient); }
.careers-intro h1 { margin: 0 0 20px; color: #0a1a2b; font-size: clamp(32px, 4.3vw, 52px); font-weight: 850; line-height: 1.14; letter-spacing: -1.6px; }
.careers-intro p { margin: 0 auto; color: #566575; font-size: 15px; line-height: 1.9; }
.careers-intro-line { width: 92px; height: 4px; margin: 27px auto 0; border-radius: 5px; background: linear-gradient(90deg, #1e90ff, #20366C); }
.careers-heading { margin-bottom: 30px; }
.careers-heading h2 { margin: 0 0 10px; padding-left: 22px; border-left: 6px solid var(--gmi-blue); color: #0a1a2b; font-size: clamp(26px, 3vw, 38px); font-weight: 800; line-height: 1.2; letter-spacing: -.7px; }
.careers-heading p { margin: 0; color: #667482; font-size: 14px; line-height: 1.75; }
.values-section { padding-bottom: 72px; }
.values-grid { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 22px; }
.value-card {
    overflow: hidden; border: 1px solid rgba(32,54,108,.10); border-radius: 24px;
    background: #fff; box-shadow: 0 16px 42px rgba(7,21,37,.09);
    transition: transform .45s var(--gmi-ease), box-shadow .4s ease, border-color .35s ease;
}
.value-card:hover { border-color: rgba(32,54,108,.28); box-shadow: 0 24px 54px rgba(7,21,37,.14); transform: translateY(-7px); }
.value-card-image { position: relative; width: 100%; aspect-ratio: 1 / 1; height: auto; overflow: hidden; background: #edf2f6; }
.value-card-image::after { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, transparent 60%, rgba(7,21,37,.22)); pointer-events: none; }
.value-card-image img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform .7s var(--gmi-ease); }
.value-card:hover .value-card-image img { transform: scale(1.045); }
.value-card-content { padding: 27px 28px 30px; }
.value-card-content h3 { margin: 0 0 10px; color: var(--gmi-blue); font-size: 21px; font-weight: 800; line-height: 1.3; }
.value-card-content p { margin: 0; color: #586675; font-size: 14px; line-height: 1.78; }
.vacancies-section { padding-top: 6px; }
.vacancy-group {
    margin-top: 30px; padding: 35px;
    border: 1px solid rgba(32,54,108,.10); border-radius: 24px;
    background: rgba(255,255,255,.92); box-shadow: 0 14px 38px rgba(7,21,37,.08);
}
.vacancy-group:first-child { margin-top: 0; }
.vacancy-group-heading { display: flex; align-items: center; gap: 16px; margin-bottom: 25px; }
.vacancy-group-icon {
    display: inline-flex; align-items: center; justify-content: center; flex: 0 0 54px;
    width: 54px; height: 54px; border-radius: 50%; color: #fff;
    background: linear-gradient(145deg, #10243d, #20366C, #2a4a8a);
    box-shadow: 0 10px 24px rgba(32,54,108,.24);
}
.vacancy-group-heading h2 { margin: 0; color: #0a1a2b; font-size: clamp(23px, 3vw, 32px); font-weight: 800; line-height: 1.25; }
.vacancy-group-heading p { margin: 4px 0 0; color: #6a7785; font-size: 13px; line-height: 1.6; }
.vacancy-grid { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 18px; }
.vacancy-card {
    display: flex; flex-direction: column; min-height: 180px; padding: 24px;
    border: 1px solid rgba(138,196,255,.16); border-radius: 18px;
    background: linear-gradient(155deg, #10243d 0%, #1A2A3A 67%, #20366C 100%);
    box-shadow: 0 12px 28px rgba(7,21,37,.14);
    transition: transform .4s var(--gmi-ease), box-shadow .4s ease, border-color .35s ease;
}
.vacancy-card:hover { border-color: rgba(138,196,255,.42); box-shadow: 0 20px 44px rgba(7,21,37,.22); transform: translateY(-6px); }
.vacancy-card h3 { margin: 0 0 12px; color: #fff; font-size: 17px; font-weight: 800; line-height: 1.45; }
.vacancy-card p { flex: 1; margin: 0 0 18px; color: #c8dce8; font-size: 13px; line-height: 1.7; }
.vacancy-link { display: inline-flex; align-items: center; align-self: flex-start; gap: 7px; padding-bottom: 4px; border-bottom: 2px solid transparent; color: var(--gmi-sky); font-size: 12px; font-weight: 700; text-decoration: none; transition: .25s ease; }
.vacancy-link:hover { color: #fff; border-bottom-color: var(--gmi-sky); }
.vacancy-link i { transition: transform .25s ease; }
.vacancy-link:hover i { transform: translateX(4px); }
.vacancy-empty-card {
    grid-column: 1 / -1; display: flex; align-items: center; justify-content: center;
    min-height: 190px; padding: 32px;
    border: 1px dashed rgba(32,54,108,.28); border-radius: 18px;
    background: linear-gradient(145deg, #fff, #f3f7fb); text-align: center;
}
.vacancy-empty-card i { display: block; margin-bottom: 14px; color: var(--gmi-blue); font-size: 30px; }
.vacancy-empty-card h3 { margin: 0 0 8px; color: var(--gmi-blue); font-size: 18px; font-weight: 800; }
.vacancy-empty-card p { margin: 0; color: #687684; font-size: 14px; line-height: 1.75; }

/* Lightweight reveal */
.reveal { opacity: 0; transform: translateY(24px); transition: opacity .7s ease, transform .8s var(--gmi-ease); }
.reveal.active { opacity: 1; transform: translateY(0); }
.values-grid .value-card:nth-child(2), .vacancy-group:nth-child(2) { transition-delay: .08s; }
.values-grid .value-card:nth-child(3) { transition-delay: .12s; }
.values-grid .value-card:nth-child(4) { transition-delay: .18s; }

/* Exact homepage footer */
.footer-inline { position: relative; overflow: hidden; background: linear-gradient(145deg, #122437 0%, #1A2A3A 52%, #102337 100%); color: #8aaccc; padding: 60px 30px 40px; }
.footer-inline::before { content: ''; position: absolute; top: -220px; left: 50%; width: 720px; height: 420px; border-radius: 50%; background: radial-gradient(circle, rgba(63,120,189,.13), transparent 68%); transform: translateX(-50%); pointer-events: none; }
.footer-inline > .container { position: relative; z-index: 1; max-width: none; width: 100%; margin: 0; padding: 0 30px; }
.footer-grid-responsive { display: grid; grid-template-columns: 1.3fr 1fr 1fr 1.35fr 1.2fr; gap: 30px; padding-bottom: 30px; }
.footer-offer-container { display: flex; flex-direction: column; align-items: center; justify-content: flex-start; }
.footer-offer-logo-img { width: 100%; max-width: 300px; height: auto; filter: brightness(0) invert(1); margin-bottom: 20px; }
.footer-social-responsive { display: flex; gap: 10px; }
.footer-social-responsive a { width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: rgba(32,54,108,.15); border: 1px solid rgba(32,54,108,.2); color: #b8d4f0; text-decoration: none; font-size: 1.2rem; transition: .3s; }
.footer-social-responsive a:hover { background: #1e90ff; color: #fff; border-color: #1e90ff; transform: translateY(-3px); box-shadow: 0 6px 20px rgba(30,144,255,.3); }
.footer-heading-responsive { color: #fff; font-weight: 700; margin: 0 0 18px; font-size: 1.05rem; letter-spacing: .4px; }
.footer-link-responsive { color: #b8d4f0; text-decoration: none; font-size: .92rem; display: inline-flex; align-items: center; gap: 10px; transition: .2s; }
.footer-link-responsive:hover { color: #fff; padding-left: 8px; }
.footer-link-responsive i { font-size: .7rem; color: #6ab0ff; }
.footer-link-item { margin: 10px 0; list-style: none; }
.footer-contact-responsive { color: #b8d4f0; font-size: .92rem; margin-bottom: 12px; list-style: none; display: flex; align-items: flex-start; gap: 12px; line-height: 1.5; }
.footer-contact-responsive i { color: #6ab0ff; width: 18px; font-size: .9rem; margin-top: 3px; flex-shrink: 0; }
.footer-great-text { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
.footer-great-logo-img { width: 100%; max-width: 100px; height: auto; }
.footer-great-text p { color: #b8d4f0; font-size: .82rem; margin-top: 12px; opacity: .8; }
.footer-bottom-responsive { border-top: 1px solid rgba(32,54,108,.15); padding-top: 22px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; font-size: .85rem; color: #6a8aaa; }
.footer-bottom-links-responsive { display: flex; gap: 15px; align-items: center; }
.footer-bottom-links-responsive a { color: #6a8aaa; text-decoration: none; font-size: .85rem; transition: .2s; }
.footer-bottom-links-responsive a:hover { color: #fff; }

@media (max-width: 1150px) {
    .gmi-nav-buttons { gap: 6px 8px; }
    .gmi-nav-buttons > a:not(.gmi-quote-btn) { padding: 10px 11px; font-size: 12.5px; }
    .gmi-nav-buttons a.gmi-quote-btn { margin-left: 4px; padding: 11px 18px; }
}
@media (max-width: 992px) {
    .gmi-custom-header { min-height: 72px; padding: 12px 20px; }
    .gmi-nav-buttons a.gmi-quote-btn { display: none; }
    .breadcrumb-section { min-height: 280px; padding: 132px 0 64px; }
    .values-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
    .value-card-image { height: auto; }
    .footer-grid-responsive { grid-template-columns: 1fr 1fr; gap: 30px; }
    .footer-great-logo-img { max-width: 180px; }
    .footer-offer-logo-img { max-width: 160px; }
}
@media (max-width: 860px) {
    .gmi-nav-buttons { display: none; }
    .gmi-hamburger { display: flex; }
    .logo-img { max-height: 38px; }
}
@media (max-width: 768px) {
    .container { padding: 0 18px; }
    .gmi-custom-header { min-height: 62px; padding: 10px 16px; }
    .breadcrumb-section { min-height: 240px; padding: 108px 0 48px; }
    .breadcrumb-title { padding: 10px 16px 10px 18px; border-radius: 0 13px 13px 0; font-size: clamp(25px, 8vw, 34px); }
    .careers-section { padding: 68px 0 78px; }
    .careers-intro { margin-bottom: 52px; }
    .values-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
    .vacancy-grid { grid-template-columns: 1fr; }
    .value-card-image { height: auto; }
    .vacancy-group { padding: 26px 21px; }
    .reveal { transform: translateY(16px); }
    .footer-grid-responsive { grid-template-columns: 1fr; gap: 24px; text-align: center; }
    .footer-social-responsive, .footer-contact-responsive { justify-content: center; }
    .footer-bottom-responsive, .footer-bottom-links-responsive { flex-direction: column; text-align: center; }
    .footer-bottom-links-responsive { flex-direction: row; flex-wrap: wrap; justify-content: center; }
    .footer-great-logo-img, .footer-offer-logo-img { max-width: 150px; margin: 0 auto; }
}
@media (max-width: 480px) {
    .gmi-custom-header { min-height: 52px; padding: 8px 12px; }
    .gmi-header-left { gap: 10px; }
    .logo-img { max-height: 30px; }
    .gmi-hamburger { width: 38px; height: 38px; }
    .gmi-hamburger span { width: 26px; height: 3px; }
    .breadcrumb-section { min-height: 210px; padding: 90px 0 38px; }
    .breadcrumb-title { font-size: 24px; }
    .breadcrumb-ul li { font-size: 10px; }
    .careers-section { padding: 52px 0 62px; }
    .careers-intro p, .careers-heading p, .value-card-content p, .vacancy-empty-card p { font-size: 13px; }
    .value-card { border-radius: 20px; }
    .values-grid { grid-template-columns: 1fr; }
    .value-card-image { height: auto; }
    .value-card-content { padding: 21px; }
    .vacancy-group { padding: 21px 16px; border-radius: 19px; }
    .vacancy-group-heading { align-items: flex-start; }
    .vacancy-group-icon { flex-basis: 46px; width: 46px; height: 46px; }
    .footer-inline { padding: 40px 16px 25px; }
    .footer-inline > .container { padding: 0; }
    .footer-heading-responsive { font-size: .95rem; margin-bottom: 12px; }
    .footer-link-responsive, .footer-contact-responsive { font-size: .82rem; }
    .footer-link-item { margin: 6px 0; }
    .footer-social-responsive a { width: 38px; height: 38px; font-size: 1rem; }
    .footer-bottom-text { font-size: .78rem; }
    .footer-great-logo-img { max-width: 120px; }
    .footer-offer-logo-img { max-width: 110px; }
}
@media (max-width: 992px), (hover: none), (pointer: coarse) {
    .value-card, .vacancy-group { box-shadow: 0 7px 22px rgba(7,21,37,.09); }
}
@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    .reveal, .value-card, .value-card-image img, .vacancy-card, #loader-wrapper { animation: none !important; transition: none !important; transform: none !important; opacity: 1 !important; }
}


/* =========================================================
   FINAL CORE VALUES LAYOUT FIX
   Always keep all four cards in one horizontal row
   ========================================================= */
.values-section .values-grid {
    display: grid !important;
    grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    grid-template-rows: 1fr !important;
    grid-auto-flow: column !important;
    gap: 18px !important;
    width: 100% !important;
    align-items: stretch !important;
}

.values-section .value-card {
    grid-row: 1 !important;
    min-width: 0 !important;
    width: 100% !important;
    height: 100% !important;
}

.values-section .value-card-image {
    position: relative !important;
    display: block !important;
    width: 100% !important;
    height: auto !important;
    padding: 0 !important;
    aspect-ratio: 1 / 1 !important;
    overflow: hidden !important;
}

.values-section .value-card-image img {
    position: absolute !important;
    inset: 0 !important;
    display: block !important;
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    object-position: center !important;
}

/* Keep one row on narrow screens using horizontal scrolling. */
@media (max-width: 700px) {
    .values-section .values-grid {
        display: flex !important;
        flex-wrap: nowrap !important;
        grid-template-columns: none !important;
        gap: 16px !important;
        overflow-x: auto !important;
        padding: 2px 2px 16px !important;
        scroll-snap-type: x mandatory !important;
        overscroll-behavior-inline: contain !important;
        -webkit-overflow-scrolling: touch !important;
    }

    .values-section .value-card {
        flex: 0 0 min(78vw, 290px) !important;
        width: min(78vw, 290px) !important;
        scroll-snap-align: start !important;
    }
}


/* =========================================================
   PROTECTED DARK NAVY LOADER
   Loaded after all page styles so earlier white rules cannot win.
   ========================================================= */
html.gmi-loading-root,
body.gmi-loading {
    background: #071525 !important;
}

body.gmi-loading {
    overflow: hidden !important;
}

#loader-wrapper {
    position: fixed !important;
    inset: 0 !important;
    z-index: 2147483647 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100vw !important;
    height: 100vh !important;
    min-width: 100% !important;
    min-height: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    background: #071525 !important;
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: all !important;
    transform: translateZ(0) !important;
    transition:
        opacity .78s cubic-bezier(.22, 1, .36, 1),
        visibility .78s ease !important;
}

#loader-wrapper.gmi-loaded {
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
}

#loader-wrapper:not(.gmi-loaded) {
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: all !important;
}

#loader {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 210px !important;
    height: 210px !important;
}

#loader::before,
#loader::after {
    content: '';
    position: absolute;
    inset: 12px;
    border: 1px solid rgba(138, 196, 255, .26);
    border-radius: 50%;
    animation: gmiCareersLoaderRing 2.35s cubic-bezier(.22, 1, .36, 1) infinite;
}

#loader::after {
    inset: 35px;
    border-color: rgba(138, 196, 255, .14);
    animation-delay: .38s;
}

#loader img {
    position: relative !important;
    z-index: 2 !important;
    display: block !important;
    width: 130px !important;
    height: auto !important;
    filter: drop-shadow(0 0 30px rgba(138, 196, 255, .34)) !important;
    animation: gmiCareersLoaderPulse 2.25s ease-in-out infinite !important;
    will-change: transform, opacity;
}

@keyframes gmiCareersLoaderPulse {
    0%, 100% {
        opacity: .68;
        transform: scale(.95);
    }
    50% {
        opacity: 1;
        transform: scale(1.055);
    }
}

@keyframes gmiCareersLoaderRing {
    0% {
        opacity: 0;
        transform: scale(.72);
    }
    42% {
        opacity: .72;
    }
    100% {
        opacity: 0;
        transform: scale(1.12);
    }
}

@media (max-width: 480px) {
    #loader {
        width: 170px !important;
        height: 170px !important;
    }

    #loader img {
        width: 108px !important;
    }
}

@media (prefers-reduced-motion: reduce) {
    #loader::before,
    #loader::after,
    #loader img {
        animation: none !important;
    }
}


/* Dynamic vacancy details and application form */
.vacancy-card h4{margin:17px 0 7px;color:#8ac4ff;font-size:11px;font-weight:800;letter-spacing:1px;text-transform:uppercase}
.vacancy-card ul{margin:0 0 7px;padding-left:18px;color:#d2e2ef;font-size:12.5px;line-height:1.75}
.vacancy-card li{margin-bottom:5px}.vacancy-card .vacancy-company{display:inline-flex;align-items:center;align-self:flex-start;margin-bottom:12px;padding:6px 11px;border:1px solid rgba(138,196,255,.2);border-radius:999px;color:#9dc9ff;background:rgba(255,255,255,.06);font-size:10px;font-weight:800;letter-spacing:1px}

.vacancy-actual-company{display:flex;align-items:center;gap:8px;margin:0 0 10px;color:#d9e9f7;font-size:12px;font-weight:700;line-height:1.5}
.vacancy-actual-company i{color:#8ac4ff;font-size:11px}
.application-section{margin-top:34px;padding:42px;border:1px solid rgba(32,54,108,.12);border-radius:25px;background:#fff;box-shadow:0 18px 48px rgba(7,21,37,.09)}
.application-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.application-field{display:flex;flex-direction:column;gap:7px}.application-field.full{grid-column:1/-1}.application-field label{color:#20366c;font-size:12px;font-weight:800}.application-field input,.application-field select{width:100%;padding:13px 14px;border:1px solid rgba(32,54,108,.18);border-radius:11px;color:#102033;background:#fff;font:inherit;font-size:13px;outline:none}.application-field input:focus,.application-field select:focus{border-color:#2a4a8a;box-shadow:0 0 0 3px rgba(42,74,138,.1)}.application-help{color:#718096;font-size:11px}.application-error{color:#b42318;font-size:11px}.application-alert{margin-bottom:18px;padding:13px 15px;border-radius:11px;font-size:13px}.application-alert.success{color:#067647;background:#ecfdf3;border:1px solid #abefc6}.application-alert.error{color:#b42318;background:#fef3f2;border:1px solid #fecdca}.application-submit{display:inline-flex;align-items:center;justify-content:center;gap:8px;margin-top:21px;padding:13px 23px;border:0;border-radius:999px;color:#fff;background:var(--gmi-blue-gradient);box-shadow:0 10px 25px rgba(32,54,108,.25);font-weight:800;cursor:pointer}.website-field{position:absolute!important;left:-9999px!important;width:1px!important;height:1px!important;overflow:hidden!important}
@media(max-width:768px){.application-section{padding:28px 21px}.application-grid{grid-template-columns:1fr}.application-field.full{grid-column:auto}}

</style>

<style id="gmi-careers-index-match">
/* =========================================================
   CAREERS FINAL UPDATE
   EB GARAMOND + INDEX.PHP TYPOGRAPHY + REFERENCE VACANCY LAYOUT
   ========================================================= */

/* ---------- Global typography ---------- */
body,
button,
input,
select,
textarea,
a,
p,
span,
div,
h1,
h2,
h3,
h4,
h5,
h6,
li,
label {
    font-family: 'EB Garamond', Georgia, 'Times New Roman', serif;
}

.fa,
.fas,
.far,
.fal,
.fab,
.fa-solid,
.fa-regular,
.fa-brands {
    font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
}

body {
    font-size: 18px !important;
    line-height: 1.7 !important;
}


/* ---------- Header ---------- */
.gmi-nav-buttons > a:not(.gmi-quote-btn) {
    font-size: 17px !important;
}

.gmi-nav-buttons a.gmi-quote-btn {
    font-size: 15px !important;
}

.gmi-nav-mobile a {
    font-size: 19px !important;
}


/* ---------- Breadcrumb ---------- */
.breadcrumb-title {
    font-size: clamp(2.7rem, 4.2vw, 4.35rem) !important;
    line-height: 1.08 !important;
}

.breadcrumb-ul li {
    font-size: 1rem !important;
}


/* ---------- Careers intro ---------- */
.careers-kicker {
    font-size: 1rem !important;
}

.careers-intro h1 {
    font-size: clamp(2.65rem, 4vw, 3.8rem) !important;
    line-height: 1.08 !important;
}

.careers-intro p {
    max-width: 950px;
    font-size: 1.12rem !important;
    line-height: 1.8 !important;
}


/* ---------- Generic careers headings ---------- */
.careers-heading h2 {
    font-size: clamp(2.25rem, 3.4vw, 3.2rem) !important;
    line-height: 1.12 !important;
}

.careers-heading p {
    font-size: 1.08rem !important;
    line-height: 1.75 !important;
}


/* ---------- Core values ---------- */
.value-card-content h3 {
    font-size: 1.38rem !important;
}

.value-card-content p {
    font-size: 1.05rem !important;
    line-height: 1.75 !important;
}


/* =========================================================
   REFERENCE-STYLE CAREER PATHWAYS
   ========================================================= */

.careers-opportunity-heading {
    margin-bottom: 38px;
}

.career-pathways {
    display: flex;
    flex-direction: column;
    gap: 34px;
    margin-bottom: 82px;
}

.career-pathway {
    display: grid;
    grid-template-columns: minmax(0, 1.05fr) minmax(0, 1fr);
    align-items: stretch;
    min-height: 390px;
    overflow: hidden;
    border: 1px solid rgba(32,54,108,.10);
    border-radius: 6px;
    background: #fff;
    box-shadow: 0 18px 44px rgba(7,21,37,.08);
}

.career-pathway-reverse .career-pathway-image {
    order: 2;
}

.career-pathway-reverse .career-pathway-content {
    order: 1;
}

.career-pathway-image {
    position: relative;
    min-height: 390px;
    overflow: hidden;
    background: #e8eef4;
}

.career-pathway-image::after {
    content: '';
    position: absolute;
    inset: 0;
    pointer-events: none;
    background: linear-gradient(
        180deg,
        rgba(7,21,37,.02),
        rgba(7,21,37,.10)
    );
}

.career-pathway-image img {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 390px;
    object-fit: cover;
    object-position: center;
    transition: transform .8s var(--gmi-ease);
}

.career-pathway:hover .career-pathway-image img {
    transform: scale(1.035);
}

.career-pathway-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 58px 56px;
    background: #fff;
}

.career-pathway-kicker {
    margin-bottom: 10px;
    color: #20366C;
    font-size: .92rem;
    font-weight: 700;
    letter-spacing: 1.8px;
    text-transform: uppercase;
}

.career-pathway-content h2 {
    margin: 0 0 22px;
    color: #0a1a2b;
    font-size: clamp(2.05rem, 2.8vw, 3rem);
    font-weight: 700;
    line-height: 1.12;
    letter-spacing: -.7px;
}

.career-pathway-content p {
    margin: 0;
    color: #59697a;
    font-size: 1.2rem;
    line-height: 1.72;
}

.career-join-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    align-self: flex-end;
    gap: 10px;
    min-width: 142px;
    min-height: 50px;
    margin-top: 34px;
    padding: 12px 24px;
    border: 0;
    border-radius: 9px;
    color: #fff;
    background: var(--gmi-blue-gradient);
    box-shadow: 0 12px 28px rgba(32,54,108,.24);
    font-size: 1.05rem;
    font-weight: 700;
    text-decoration: none;
    transition:
        transform .35s var(--gmi-ease),
        box-shadow .35s ease,
        background .3s ease;
}

.career-pathway-reverse .career-join-btn {
    align-self: flex-end;
}

.career-join-btn:hover {
    color: #fff;
    background: linear-gradient(145deg,#2a4a8a,#20366C);
    box-shadow: 0 18px 36px rgba(32,54,108,.30);
    transform: translateY(-3px);
}

.career-join-btn i {
    transition: transform .25s ease;
}

.career-join-btn:hover i {
    transform: translateX(4px);
}

.vacancy-listing-heading {
    margin-top: 0;
    margin-bottom: 32px;
}


/* =========================================================
   LIVE VACANCIES
   ========================================================= */

.vacancy-group {
    scroll-margin-top: 110px;
    padding: 38px !important;
}

.vacancy-group-heading h2 {
    font-size: clamp(2rem, 3vw, 2.8rem) !important;
}

.vacancy-group-heading p {
    font-size: 1.05rem !important;
}

.vacancy-card h3 {
    font-size: 1.4rem !important;
    line-height: 1.4 !important;
}

.vacancy-card p {
    font-size: 1.02rem !important;
}

.vacancy-card h4 {
    font-size: .95rem !important;
}

.vacancy-card ul {
    font-size: 1rem !important;
    line-height: 1.75 !important;
}

.vacancy-card .vacancy-company {
    font-size: .86rem !important;
}

.vacancy-actual-company {
    font-size: .98rem !important;
}

.vacancy-link {
    font-size: 1rem !important;
}

.vacancy-empty-card h3 {
    font-size: 1.28rem !important;
}

.vacancy-empty-card p {
    font-size: 1.02rem !important;
}


/* =========================================================
   APPLICATION FORM
   ========================================================= */

.application-section {
    scroll-margin-top: 105px;
}

.application-field label {
    font-size: 1rem !important;
}

.application-field input,
.application-field select {
    padding: 14px 15px !important;
    font-size: 1rem !important;
}

.application-help,
.application-error {
    font-size: .9rem !important;
}

.application-alert {
    font-size: 1rem !important;
}

.application-submit {
    min-height: 50px;
    padding: 13px 25px !important;
    font-size: 1rem !important;
}


/* ---------- Footer ---------- */
.footer-heading-responsive {
    font-size: 1.38rem !important;
}

.footer-link-responsive,
.footer-contact-responsive {
    font-size: 1.12rem !important;
}

.footer-great-text p {
    font-size: 1rem !important;
}

.footer-bottom-responsive,
.footer-bottom-links-responsive a,
.footer-bottom-text {
    font-size: 1rem !important;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 992px) {
    body {
        font-size: 17px !important;
    }

    .breadcrumb-title {
        font-size: clamp(2.4rem, 5vw, 3.55rem) !important;
    }

    .careers-intro h1 {
        font-size: clamp(2.3rem, 5vw, 3.25rem) !important;
    }

    .careers-intro p {
        font-size: 1.08rem !important;
    }

    .career-pathway {
        min-height: 340px;
    }

    .career-pathway-image,
    .career-pathway-image img {
        min-height: 340px;
    }

    .career-pathway-content {
        padding: 42px 38px;
    }

    .career-pathway-content p {
        font-size: 1.08rem;
    }

    .footer-heading-responsive {
        font-size: 1.28rem !important;
    }

    .footer-link-responsive,
    .footer-contact-responsive {
        font-size: 1.06rem !important;
    }
}


@media (max-width: 768px) {
    body {
        font-size: 16.5px !important;
    }

    .gmi-nav-mobile a {
        font-size: 18px !important;
    }

    .breadcrumb-title {
        font-size: clamp(2.15rem, 7.6vw, 3rem) !important;
    }

    .breadcrumb-ul li {
        font-size: .95rem !important;
    }

    .careers-kicker {
        font-size: .9rem !important;
    }

    .careers-intro h1 {
        font-size: clamp(2rem, 7.5vw, 2.8rem) !important;
    }

    .careers-intro p,
    .careers-heading p {
        font-size: 1.02rem !important;
    }

    .careers-heading h2 {
        font-size: clamp(2rem, 7vw, 2.65rem) !important;
    }

    .value-card-content h3 {
        font-size: 1.25rem !important;
    }

    .value-card-content p {
        font-size: 1rem !important;
    }

    .career-pathways {
        gap: 24px;
        margin-bottom: 62px;
    }

    .career-pathway,
    .career-pathway-reverse {
        grid-template-columns: 1fr;
    }

    .career-pathway-reverse .career-pathway-image,
    .career-pathway-reverse .career-pathway-content {
        order: initial;
    }

    .career-pathway-image,
    .career-pathway-image img {
        min-height: 290px;
        height: 290px;
    }

    .career-pathway-content {
        padding: 34px 28px 38px;
    }

    .career-pathway-content h2 {
        font-size: 2.15rem;
    }

    .career-pathway-content p {
        font-size: 1.05rem;
    }

    .career-join-btn,
    .career-pathway-reverse .career-join-btn {
        align-self: flex-start;
        margin-top: 26px;
    }

    .vacancy-group {
        padding: 28px 22px !important;
    }

    .vacancy-group-heading h2 {
        font-size: 2rem !important;
    }
}


@media (max-width: 480px) {
    body {
        font-size: 16px !important;
    }

    .breadcrumb-title {
        font-size: 2rem !important;
    }

    .breadcrumb-ul li {
        font-size: .9rem !important;
    }

    .careers-intro h1 {
        font-size: 2.15rem !important;
    }

    .careers-intro p,
    .careers-heading p {
        font-size: .98rem !important;
    }

    .careers-heading h2 {
        font-size: 2rem !important;
    }

    .career-pathway {
        border-radius: 0;
    }

    .career-pathway-image,
    .career-pathway-image img {
        min-height: 235px;
        height: 235px;
    }

    .career-pathway-content {
        padding: 28px 22px 32px;
    }

    .career-pathway-kicker {
        font-size: .82rem;
    }

    .career-pathway-content h2 {
        margin-bottom: 16px;
        font-size: 1.9rem;
    }

    .career-pathway-content p {
        font-size: 1rem;
    }

    .career-join-btn {
        min-width: 130px;
        min-height: 46px;
        padding: 11px 20px;
        font-size: 1rem;
    }

    .value-card-content h3 {
        font-size: 1.2rem !important;
    }

    .vacancy-card h3 {
        font-size: 1.25rem !important;
    }

    .vacancy-card p,
    .vacancy-card ul {
        font-size: .98rem !important;
    }

    .footer-heading-responsive {
        font-size: 1.2rem !important;
    }

    .footer-link-responsive,
    .footer-contact-responsive {
        font-size: 1rem !important;
    }

    .footer-bottom-responsive,
    .footer-bottom-links-responsive a,
    .footer-bottom-text {
        font-size: .92rem !important;
    }
}
</style>


<style id="gmi-dedicated-career-page">
.dedicated-career-back {
    display:inline-flex;
    align-items:center;
    gap:9px;
    margin:0 0 30px;
    color:#20366C;
    font-size:1.05rem;
    font-weight:700;
    text-decoration:none;
}
.dedicated-career-back:hover { color:#2a4a8a; }
.dedicated-career-back i { transition:transform .25s ease; }
.dedicated-career-back:hover i { transform:translateX(-4px); }
.vacancies-section { padding-top: 10px; }
.career-pathways { display:none !important; }
</style>

</head>
<body class="gmi-loading">
<div id="loader-wrapper" style="background:#071525;">
    <div id="loader"><img src="images/logo/loader/GMG_loading.png" alt="Loading..." decoding="async" loading="eager"></div>
</div>
<div id="gmiProgressBar" class="gmi-progress-bar"></div>

<header class="gmi-custom-header">
    <div class="gmi-header-left">
        <a href="/" class="gmi-logo-link" aria-label="Global Marine Group home">
            <img class="logo-img" src="images/logo/GMG 3L.png" alt="Global Marine Group" decoding="async" loading="eager" fetchpriority="high">
        </a>
    </div>
    <nav class="gmi-nav-buttons" aria-label="Primary navigation">
        <a href="/">Home</a>
        <a href="about-us.php">About Us</a>
        <a href="services.php">Services</a>
        <a href="companies.php">Companies</a>
        <a href="events.php">Events</a>
        <a href="careers.php" class="gmi-current">Careers</a>
        <a href="contact-us.php">Contact Us</a>
    </nav>
    <button type="button" class="gmi-hamburger" onclick="toggleMobileNav()" aria-label="Toggle navigation" aria-controls="gmiNavMobile" aria-expanded="false">
        <span></span><span></span><span></span>
    </button>
    <nav id="gmiNavMobile" class="gmi-nav-mobile" aria-label="Mobile navigation">
        <a href="/">Home</a>
        <a href="about-us.php">About Us</a>
        <a href="services.php">Services</a>
        <a href="companies.php">Companies</a>
        <a href="events.php">Events</a>
        <a href="careers.php" class="gmi-current">Careers</a>
        <a href="contact-us.php">Contact Us</a>
    </nav>
</header>

<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb-area">
            <h2 class="breadcrumb-title reveal">Join as Employee</h2>
            <ul class="breadcrumb-ul">
                <li><a href="/">Home</a></li>
                <li class="active-breadcrumb">Join as Employee</li>
            </ul>
        </div>
    </div>
</section>

<main class="careers-main">
    <section class="careers-section">
        <div class="container">
            
            <div class="careers-intro reveal">
                <div class="careers-kicker"><i class="fas fa-compass"></i> Shore-Based Careers</div>
                <h1>Join Global Marine Group as an Employee</h1>
                <p>Explore current shore-based opportunities across Global Marine Group. Review available positions, responsibilities and qualifications, then submit your application directly through the form below.</p>
                <div class="careers-intro-line"></div>
            </div>
<section class="vacancies-section">
                <a href="<?= e(base_url('careers.php')) ?>" class="dedicated-career-back"><i class="fas fa-arrow-left"></i> Back to Careers</a>
                <div class="careers-heading vacancy-listing-heading reveal">
                    <h2>Current GMG Vacancies</h2>
                    <p>Explore the active opportunities currently available at Global Marine Group.</p>
                </div>
<?php
                $renderList = static function (string $text): array {
                    $lines = preg_split('/\R+/u', trim($text)) ?: [];
                    return array_values(array_filter(array_map(static function (string $line): string {
                        return trim(preg_replace('/^[\s\-•*\d.)]+/u', '', $line) ?? '');
                    }, $lines), static fn(string $line): bool => $line !== ''));
                };
                ?>
                <?php foreach ([['GMG', $gmgVacancies, 'Global Marine Group']] as [$companyCode, $companyVacancies, $companyName]): ?>
                <div id="<?= strtolower($companyCode) ?>-vacancies" class="vacancy-group reveal">
                    <div class="vacancy-group-heading">
                        <span class="vacancy-group-icon"><i class="fas fa-briefcase"></i></span>
                        <div><h2>Vacancies at <?= e($companyCode) ?></h2><p>Explore current career opportunities available at <?= e($companyName) ?>.</p></div>
                    </div>
                    <div class="vacancy-grid">
                        <?php if ($companyVacancies === []): ?>
                            <div class="vacancy-empty-card"><div><i class="fas fa-briefcase"></i><h3>No Current Vacancies</h3><p>New <?= e($companyCode) ?> vacancies will be displayed here when positions become available.</p></div></div>
                        <?php else: ?>
                            <?php foreach ($companyVacancies as $vacancy): ?>
                                <article class="vacancy-card">
                                    <span class="vacancy-company"><?= e($vacancy['company']) ?></span>
                                    <div class="vacancy-actual-company"><i class="fas fa-building"></i><?= e($vacancy['company_name']) ?></div>
                                    <h3><?= e($vacancy['position']) ?></h3>
                                    <h4>Responsibilities</h4>
                                    <ul><?php foreach ($renderList($vacancy['responsibilities']) as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul>
                                    <h4>Qualifications</h4>
                                    <ul><?php foreach ($renderList($vacancy['qualifications']) as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul>
                                    <a class="vacancy-link" href="#application-form" data-vacancy-id="<?= e($vacancy['id']) ?>">Apply for this position <i class="fas fa-arrow-right"></i></a>
                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php
                    $pageActiveVacancies = array_values(array_filter(
                        $activeVacancies,
                        static fn(array $vacancy): bool =>
                            strtoupper(trim((string) ($vacancy['company'] ?? ''))) === 'GMG'
                    ));
                ?>
                <section id="application-form" class="application-section reveal">
                    <div class="careers-heading"><h2>Apply for a GMG Vacancy</h2><p>Complete the form and upload your CV. Accepted file types: PDF, DOC, and DOCX, maximum 5 MB.</p></div>
                    <?php if ($careerSuccess): ?><div class="application-alert success"><?= e($careerSuccess) ?></div><?php endif; ?>
                    <?php if ($careerError): ?><div class="application-alert error"><?= e($careerError) ?></div><?php endif; ?>
                    <?php if ($pageActiveVacancies === []): ?>
                        <div class="vacancy-empty-card"><div><i class="fas fa-file-circle-xmark"></i><h3>Applications are currently closed</h3><p>The application form will become available when an active vacancy is published.</p></div></div>
                    <?php else: ?>
                    <form method="post" enctype="multipart/form-data" action="<?= e(base_url('vacancies-gmg.php')) ?>">
                        <?= csrf_field() ?>
                        <div class="website-field" aria-hidden="true"><label>Website<input name="website" tabindex="-1" autocomplete="off"></label></div>
                        <div class="application-grid">
                            <div class="application-field full"><label for="vacancy_id">Vacancy</label><select id="vacancy_id" name="vacancy_id" required><option value="">Select a position</option><?php foreach ($pageActiveVacancies as $vacancy): ?><option value="<?= e($vacancy['id']) ?>" <?= (string) old('vacancy_id') === (string) $vacancy['id'] ? 'selected' : '' ?>><?= e($vacancy['company'] . ' — ' . $vacancy['company_name'] . ' — ' . $vacancy['position']) ?></option><?php endforeach; ?></select><?php foreach (errors('vacancy_id') as $message): ?><div class="application-error"><?= e($message) ?></div><?php endforeach; ?></div>
                            <div class="application-field"><label for="applicant_name">Full name</label><input id="applicant_name" name="applicant_name" maxlength="160" required value="<?= e(old('applicant_name')) ?>"><?php foreach (errors('applicant_name') as $message): ?><div class="application-error"><?= e($message) ?></div><?php endforeach; ?></div>
                            <div class="application-field"><label for="email">Email</label><input id="email" name="email" type="email" maxlength="190" required value="<?= e(old('email')) ?>"><?php foreach (errors('email') as $message): ?><div class="application-error"><?= e($message) ?></div><?php endforeach; ?></div>
                            <div class="application-field"><label for="phone">Phone number</label><input id="phone" name="phone" maxlength="40" required value="<?= e(old('phone')) ?>"><?php foreach (errors('phone') as $message): ?><div class="application-error"><?= e($message) ?></div><?php endforeach; ?></div>
                            <div class="application-field"><label for="cv_file">CV file</label><input id="cv_file" name="cv_file" type="file" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required><div class="application-help">PDF, DOC, or DOCX. Maximum 5 MB.</div><?php foreach (errors('cv_file') as $message): ?><div class="application-error"><?= e($message) ?></div><?php endforeach; ?></div>
                        </div>
                        <button class="application-submit" type="submit"><i class="fas fa-paper-plane"></i>Submit Application</button>
                    </form>
                    <?php endif; ?>
                </section>
            </section>
        </div>
    </section>
</main>

<footer class="footer-inline">
    <div class="container">
        <div class="footer-grid-responsive">
            <div class="footer-offer-container">
                <img src="images/logo/GMG 3L WHITE.png" alt="Global Marine Group" class="footer-offer-logo-img" decoding="async" loading="lazy">
                <div class="footer-social-responsive">
                    <?php if (!empty($footerContact['linkedin_url'])): ?>
                        <a href="<?= e((string) $footerContact['linkedin_url']) ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <?php endif; ?>

                    <?php if (!empty($footerContact['facebook_url'])): ?>
                        <a href="<?= e((string) $footerContact['facebook_url']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>

                    <?php if (!empty($footerContact['instagram_url'])): ?>
                        <a href="<?= e((string) $footerContact['instagram_url']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>

                    <?php if (!empty($footerContact['tiktok_url'])): ?>
                        <a href="<?= e((string) $footerContact['tiktok_url']) ?>" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    <?php endif; ?>

                    <?php if (!empty($footerContact['youtube_url'])): ?>
                        <a href="<?= e((string) $footerContact['youtube_url']) ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <h5 class="footer-heading-responsive">Quick Links</h5>
                <ul style="list-style:none;padding:0;margin:0;">
                    <li class="footer-link-item"><a href="about-us.php" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>About Us</a></li>
                    <li class="footer-link-item"><a href="services.php" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>Services</a></li>
                    <li class="footer-link-item"><a href="companies.php" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>Companies</a></li>
                    <li class="footer-link-item"><a href="careers.php" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>Careers</a></li>
                    <li class="footer-link-item"><a href="contact-us.php" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h5 class="footer-heading-responsive">Our Services</h5>
                <ul style="list-style:none;padding:0;margin:0;">
                    <li class="footer-link-item"><a href="services.php#liner-shipping" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>Liner Shipping</a></li>
                    <li class="footer-link-item"><a href="services.php#nvocc" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>NVOCC</a></li>
                    <li class="footer-link-item"><a href="services.php#freight" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>Freight &amp; Logistics</a></li>
                    <li class="footer-link-item"><a href="services.php#port-agency" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>Port Agency</a></li>
                    <li class="footer-link-item"><a href="services.php#marine-technical" class="footer-link-responsive"><i class="fas fa-chevron-right"></i>Marine Technical</a></li>
                </ul>
            </div>
            <div>
                <h5 class="footer-heading-responsive">Contact Us</h5>
                <ul style="list-style:none;padding:0;margin:0;">
                    <li class="footer-contact-responsive">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?= e((string) ($footerContact['address'] ?? '')) ?></span>
                    </li>

                    <li class="footer-contact-responsive">
                        <i class="fas fa-phone"></i>
                        <a href="tel:<?= e((string) $footerPhoneHref) ?>" style="color:inherit;text-decoration:none;">
                            <?= e((string) ($footerContact['phone'] ?? '')) ?>
                        </a>
                    </li>

                    <li class="footer-contact-responsive">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:<?= e((string) ($footerContact['email'] ?? '')) ?>" style="color:inherit;text-decoration:none;">
                            <?= e((string) ($footerContact['email'] ?? '')) ?>
                        </a>
                    </li>

                    <li class="footer-contact-responsive">
                        <i class="fas fa-clock"></i>
                        <span><?= e((string) ($footerContact['office_hours'] ?? '')) ?></span>
                    </li>
                </ul>
            </div>
            <div class="footer-great-text">
                <h5 class="footer-heading-responsive">Certified</h5>
                <img src="images/logo/great-place-work-resized.png" alt="Great Place to Work" class="footer-great-logo-img" decoding="async" loading="lazy">
                <p>Proudly certified as a Great Place to Work</p>
            </div>
        </div>
        <div class="footer-bottom-responsive">
            <span class="footer-bottom-text">&copy; 2026 <a href="https://gmigroup.lk/" style="color:#b8d4f0;text-decoration:none;">Global Marine Group</a>. All rights reserved.</span>
            <div class="footer-bottom-links-responsive">
                <a href="#">Privacy Policy</a><span style="color:#4a6a7a;">|</span>
                <a href="#">Terms of Service</a><span style="color:#4a6a7a;">|</span>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>

<script>
(function () {
    'use strict';
    var doc = document;
    var root = doc.documentElement;
    var body = doc.body;
    var header = doc.querySelector('.gmi-custom-header');
    var progressBar = doc.getElementById('gmiProgressBar');
    var mobileNav = doc.getElementById('gmiNavMobile');
    var hamburger = doc.querySelector('.gmi-hamburger');
    var loader = doc.getElementById('loader-wrapper');
    var loaderStartedAt = (window.performance && performance.now) ? performance.now() : Date.now();
    var minimumLoaderTime = 1100;
    var loaderFinished = false;
    var frame = 0;

    function syncHeaderOffset() {
        if (header) body.style.paddingTop = header.getBoundingClientRect().height + 'px';
    }
    function updatePage() {
        frame = 0;
        var maxScroll = Math.max(0, root.scrollHeight - root.clientHeight);
        var progress = maxScroll ? window.scrollY / maxScroll : 0;
        if (progressBar) progressBar.style.transform = 'scaleX(' + Math.min(1, Math.max(0, progress)) + ')';
    }
    function requestUpdate() {
        if (!frame) frame = window.requestAnimationFrame(updatePage);
    }

    window.toggleMobileNav = function () {
        if (!mobileNav) return;
        var open = mobileNav.classList.toggle('open');
        if (hamburger) hamburger.setAttribute('aria-expanded', open ? 'true' : 'false');
        window.requestAnimationFrame(syncHeaderOffset);
    };

    if (mobileNav) {
        mobileNav.addEventListener('click', function (event) {
            if (!event.target.closest('a')) return;
            mobileNav.classList.remove('open');
            if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
            window.requestAnimationFrame(syncHeaderOffset);
        });
    }

    var revealItems = doc.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        var observer = new IntersectionObserver(function (entries, currentObserver) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('active');
                currentObserver.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -5% 0px' });
        revealItems.forEach(function (item) { observer.observe(item); });
    } else {
        revealItems.forEach(function (item) { item.classList.add('active'); });
    }

    window.addEventListener('scroll', requestUpdate, { passive: true });
    window.addEventListener('resize', function () { syncHeaderOffset(); requestUpdate(); }, { passive: true });
    window.addEventListener('orientationchange', syncHeaderOffset, { passive: true });
    if ('ResizeObserver' in window && header) new ResizeObserver(syncHeaderOffset).observe(header);

    function currentTime() {
        return (window.performance && performance.now) ? performance.now() : Date.now();
    }

    function finishLoader() {
        if (loaderFinished) return;
        loaderFinished = true;

        syncHeaderOffset();
        updatePage();

        var remainingTime = Math.max(0, minimumLoaderTime - (currentTime() - loaderStartedAt));

        window.setTimeout(function () {
            if (loader) {
                loader.classList.add('gmi-loaded');
                window.setTimeout(function () {
                    if (loader && loader.parentNode) loader.parentNode.removeChild(loader);
                }, 900);
            }

            body.classList.remove('gmi-loading');
            root.classList.remove('gmi-loading-root');
            root.style.background = '';
        }, remainingTime);
    }

    doc.addEventListener('DOMContentLoaded', function () {
        syncHeaderOffset();
        updatePage();
    }, { once: true });

    if (doc.readyState === 'complete') {
        finishLoader();
    } else {
        window.addEventListener('load', finishLoader, { once: true });
    }

    doc.querySelectorAll('[data-vacancy-id]').forEach(function (link) {
        link.addEventListener('click', function () {
            var select = doc.getElementById('vacancy_id');
            if (select) select.value = link.getAttribute('data-vacancy-id') || '';
        });
    });

    /* Safety fallback for failed images or third-party scripts. */
    window.setTimeout(finishLoader, 7000);
})();
</script>
</body>
</html>