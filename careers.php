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
    <meta name="description" content="Explore career opportunities, workplace values and vacancies at Global Marine Group and Global Marine Services.">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Global Marine Group">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Careers - Global Marine Group</title>

    <link rel="shortcut icon" type="image/x-icon" href="images/logo/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://images.pexels.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap">
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
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
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
        <a href="contact-us.php" class="gmi-quote-btn">Get a Quote <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
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
            <h2 class="breadcrumb-title reveal">Careers @ Global Marine Group</h2>
            <ul class="breadcrumb-ul">
                <li><a href="/">Home</a></li>
                <li class="active-breadcrumb">Careers @ Global Marine Group</li>
            </ul>
        </div>
    </div>
</section>

<main class="careers-main">
    <section class="careers-section">
        <div class="container">
            <div class="careers-intro reveal">
                <div class="careers-kicker"><i class="fas fa-compass"></i> Build Your Future</div>
                <h1>Become a Superhero, Join Our Dynamic Team</h1>
                <p>
                    At Global Marine Group, our people define who we are. Their expertise, passion, and drive power everything we do. When you join us, you are not just stepping into a job—you are becoming part of a dynamic team that takes you beyond borders, opening doors to global opportunities and limitless growth. This is not just a career; it is a journey where you can thrive, innovate, and make a real impact.
                </p>
                <div class="careers-intro-line"></div>
            </div>

            <section class="values-section">
                <div class="careers-heading reveal">
                    <h2>Our Core Values</h2>
                    <p>To become a Superhero at Global Marine Group, our values are the foundation of everything we do. They shape our culture, guide our decisions, and drive us forward as a team.</p>
                </div>

                <div class="values-grid">
                    <article class="value-card reveal">
                        <div class="value-card-image"><img src="images/careers/trust.jpg" alt="Trust" loading="lazy" decoding="async"></div>
                        <div class="value-card-content"><h3>Trust</h3><p>We believe in integrity, transparency, and reliability. Trust is the anchor of our relationships with colleagues, partners, and clients.</p></div>
                    </article>
                    <article class="value-card reveal">
                        <div class="value-card-image"><img src="images/careers/professionalism.jpg" alt="Professionalism" loading="lazy" decoding="async"></div>
                        <div class="value-card-content"><h3>Professionalism</h3><p>We hold ourselves to the highest standards, delivering excellence through expertise, accountability, and respect.</p></div>
                    </article>
                    <article class="value-card reveal">
                        <div class="value-card-image"><img src="images/careers/excellence.jpg" alt="Drive for Excellence" loading="lazy" decoding="async"></div>
                        <div class="value-card-content"><h3>Drive for Excellence</h3><p>We never settle for less. Innovation, quality, and continuous improvement push us to go further and achieve more.</p></div>
                    </article>
                    <article class="value-card reveal">
                        <div class="value-card-image"><img src="images/careers/growth.jpg" alt="Nurturing Growth" loading="lazy" decoding="async"></div>
                        <div class="value-card-content"><h3>Nurturing Growth</h3><p>We invest in our people, fostering development, learning, and opportunities that help individuals and teams thrive.</p></div>
                    </article>
                </div>
            </section>

            <section class="vacancies-section">
                <div class="vacancy-group reveal">
                    <div class="vacancy-group-heading">
                        <span class="vacancy-group-icon"><i class="fas fa-briefcase"></i></span>
                        <div><h2>Vacancies at GMG</h2><p>Explore current career opportunities available at Global Marine Group.</p></div>
                    </div>
                    <div class="vacancy-grid">
                        <div class="vacancy-empty-card">
                            <div><i class="fas fa-briefcase"></i><h3>No Current Vacancies</h3><p>New GMG vacancies will be displayed here when positions become available.</p></div>
                        </div>
                    </div>
                </div>

                <div class="vacancy-group reveal">
                    <div class="vacancy-group-heading">
                        <span class="vacancy-group-icon"><i class="fas fa-briefcase"></i></span>
                        <div><h2>Vacancies at GMS</h2><p>Explore current career opportunities available at Global Marine Services.</p></div>
                    </div>
                    <div class="vacancy-grid">
                        <div class="vacancy-empty-card">
                            <div><i class="fas fa-briefcase"></i><h3>No Current Vacancies</h3><p>New GMS vacancies will be displayed here when positions become available.</p></div>
                        </div>
                    </div>
                </div>
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
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
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
                    <li class="footer-contact-responsive"><i class="fas fa-map-marker-alt"></i>292 R. A. De Mel Mawatha, Colombo, Sri Lanka</li>
                    <li class="footer-contact-responsive"><i class="fas fa-phone"></i>+94 11 2 345 678</li>
                    <li class="footer-contact-responsive"><i class="fas fa-envelope"></i>info@gmigroup.lk</li>
                    <li class="footer-contact-responsive"><i class="fas fa-clock"></i>Mon - Fri: 8:30 AM - 5:30 PM</li>
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

    /* Safety fallback for failed images or third-party scripts. */
    window.setTimeout(finishLoader, 7000);
})();
</script>
</body>
</html>