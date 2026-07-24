<!doctype html>
<html class="no-js gmi-loading" lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KQ95BNCRG5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-KQ95BNCRG5');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Companies - Global Marine Group">
    <meta name="description" content="Explore the companies within Global Marine Group across shipping, port services, logistics, marine services, recruitment and related sectors.">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Global Marine Group">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Companies - Global Marine Group</title>

    <link rel="shortcut icon" type="image/x-icon" href="images/logo/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
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
    --premium-ease: cubic-bezier(0.16, 1, 0.3, 1);
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
::selection { color: #fff; background: #20366C; }
img { max-width: 100%; }
.fa, .fas, .far, .fal, .fab { line-height: 1; }
.container { max-width: 1280px; margin: 0 auto; padding: 0 30px; }

/* Loader */
#loader-wrapper {
    position: fixed; inset: 0; z-index: 99999;
    display: flex; align-items: center; justify-content: center;
    background: #fff;
    transition: opacity .4s ease, visibility .4s ease;
}
#loader-wrapper.gmi-loaded { opacity: 0; visibility: hidden; pointer-events: none; }
#loader img { width: 120px; height: auto; }

/* Scroll progress */
.gmi-progress-bar {
    position: fixed; top: 0; left: 0; z-index: 100000;
    width: 100%; height: 4px;
    background: linear-gradient(90deg, #20366C 0%, #2a4a8a 50%, #1e90ff 100%);
    transform: scaleX(0); transform-origin: left center; will-change: transform;
}

/* Header — same structure and styling as index.php */
.gmi-custom-header {
    position: fixed; top: 0; left: 0; z-index: 9999;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;
    width: 100%; min-height: 88px; padding: 14px 30px;
    background: #fff; box-shadow: 0 2px 16px rgba(0,0,0,.10);
}
.gmi-header-left { display: flex; align-items: center; gap: 20px; }
.gmi-logo-link { display: inline-flex; align-items: center; line-height: 0; text-decoration: none; }
.gmi-header-left .logo-img { max-height: 60px; width: auto; }
.gmi-nav-buttons { display: flex; align-items: center; justify-content: flex-end; flex-wrap: wrap; gap: 8px 18px; margin: 5px 0; }
.gmi-nav-buttons > a:not(.gmi-quote-btn) {
    position: relative; padding: 10px 16px; border-radius: 8px;
    color: #0a1a2b; font-size: 14px; font-weight: 600; letter-spacing: .3px;
    text-decoration: none; white-space: nowrap; transition: .25s ease;
}
.gmi-nav-buttons > a:not(.gmi-quote-btn)::after {
    content: ''; position: absolute; left: 16px; right: 16px; bottom: 6px; height: 2px; border-radius: 2px;
    background: var(--gmi-blue-gradient); transform: scaleX(0); transform-origin: left; transition: transform .3s ease;
}
.gmi-nav-buttons > a:not(.gmi-quote-btn):hover { color: #20366C; background: #f0f4f8; }
.gmi-nav-buttons > a:not(.gmi-quote-btn):hover::after,
.gmi-nav-buttons > a.gmi-current::after { transform: scaleX(1); }
.gmi-nav-buttons > a.gmi-current { color: #20366C; background: rgba(32,54,108,.06); }
.gmi-nav-buttons a.gmi-quote-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    min-height: 44px; margin-left: 10px; padding: 12px 24px; border-radius: 30px;
    color: #fff; background: var(--gmi-blue-gradient); box-shadow: 0 6px 18px rgba(32,54,108,.28);
    font-size: 12.5px; font-weight: 700; letter-spacing: .4px; text-decoration: none; white-space: nowrap; transition: .3s ease;
}
.gmi-nav-buttons a.gmi-quote-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(32,54,108,.38); color: #fff; }
.gmi-nav-buttons a.gmi-quote-btn i { font-size: 8.5px; color: #fff; }
.gmi-hamburger {
    display: none; flex-direction: column; align-items: center; justify-content: center; gap: 5px;
    width: 42px; height: 42px; padding: 6px; border: none; border-radius: 8px; background: transparent; cursor: pointer;
}
.gmi-hamburger:hover { background: #f0f4f8; }
.gmi-hamburger span { display: block; width: 30px; height: 3.5px; border-radius: 4px; background: #0a1a2b; }
.gmi-nav-mobile {
    display: none; flex-direction: column; width: 100%; margin-top: 12px; padding: 12px 0;
    border-top: 1px solid #eaeaea; background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,.05);
}
.gmi-nav-mobile.open { display: flex; }
.gmi-nav-mobile a { display: block; width: 100%; padding: 14px 24px; border-bottom: 1px solid #f0f0f0; color: #0a1a2b; font-size: 16px; font-weight: 700; text-decoration: none; }
.gmi-nav-mobile a:hover, .gmi-nav-mobile a.gmi-current { color: #20366C; background: #f5f8fc; }

/* Breadcrumb */
.breadcrumb-section {
    position: relative; overflow: hidden; isolation: isolate;
    min-height: 320px; display: flex; align-items: center;
    background: #071525;
}
.breadcrumb-section::before {
    content: ''; position: absolute; inset: 0; z-index: -2;
    background:
        url('https://images.pexels.com/photos/36712822/pexels-photo-36712822.jpeg?auto=compress&cs=tinysrgb&w=1920')
        center 42% / cover no-repeat;
}
.breadcrumb-section::after {
    content: ''; position: absolute; inset: 0; z-index: -1;
    background:
        radial-gradient(circle at 20% 70%, rgba(63,120,189,.26), transparent 38%),
        linear-gradient(90deg, rgba(4,14,26,.90), rgba(4,14,26,.58) 50%, rgba(4,14,26,.80));
}
.breadcrumb-area { text-align: center; }
.breadcrumb-eyebrow {
    display: inline-flex; align-items: center; gap: 8px; margin-bottom: 14px;
    color: #9dc9ff; font-size: .72rem; font-weight: 700; letter-spacing: 2.2px; text-transform: uppercase;
}
.breadcrumb-title {
    display: inline-block; margin: 0; padding: 12px 22px 12px 26px;
    border: 1px solid rgba(255,255,255,.16); border-left: 6px solid #1e90ff; border-radius: 0 16px 16px 0;
    color: #fff; background: rgba(255,255,255,.07); box-shadow: 0 16px 38px rgba(0,0,0,.20);
    font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; line-height: 1.18; letter-spacing: -1.2px;
    text-shadow: 0 2px 20px rgba(0,0,0,.35);
}
.breadcrumb-ul { display: flex; justify-content: center; flex-wrap: wrap; gap: 12px; margin: 18px 0 0; padding: 0; list-style: none; }
.breadcrumb-ul li { color: #d6e6f5; font-size: 12px; }
.breadcrumb-ul li + li::before { content: '/'; margin-right: 12px; color: rgba(255,255,255,.45); }
.breadcrumb-ul a { color: #8ac4ff; text-decoration: none; }
.breadcrumb-ul a:hover { color: #fff; }

/* Companies */
.companies-section {
    position: relative; overflow: hidden; isolation: isolate;
    padding: 92px 0 105px;
    background: linear-gradient(180deg, #fff 0%, #f4f8fc 100%);
    content-visibility: auto; contain-intrinsic-size: 900px;
}
.companies-section::before,
.companies-section::after {
    content: ''; position: absolute; z-index: -1; width: 440px; height: 440px; border-radius: 50%; pointer-events: none;
}
.companies-section::before { top: -250px; right: -185px; background: radial-gradient(circle, rgba(63,120,189,.13), transparent 68%); }
.companies-section::after { bottom: -280px; left: -210px; background: radial-gradient(circle, rgba(32,54,108,.10), transparent 68%); }
.section-heading { text-align: center; margin-bottom: 48px; }
.section-eyebrow {
    display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px;
    color: #20366C; font-size: .76rem; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase;
}
.section-eyebrow::before, .section-eyebrow::after { content: ''; width: 24px; height: 2px; border-radius: 2px; background: var(--gmi-blue-gradient); }
.section-heading h1 { margin: 0; color: #0a1a2b; font-size: clamp(2rem, 3.4vw, 3rem); font-weight: 800; line-height: 1.1; letter-spacing: -1.4px; }
.section-heading p { max-width: 720px; margin: 15px auto 0; color: #5b6876; font-size: .95rem; line-height: 1.75; }
.companies-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 26px; }
.company-card {
    position: relative; display: block; min-width: 0; overflow: hidden;
    border: 1px solid rgba(32,54,108,.10); border-radius: 24px;
    background: linear-gradient(145deg, #fff, #f2f7fb);
    box-shadow: 0 16px 40px rgba(7,21,37,.10);
    color: inherit; text-decoration: none;
    opacity: 0; transform: translate3d(0,24px,0) scale(.985);
    transition: opacity .75s var(--premium-ease), transform .85s var(--premium-ease), border-color .35s ease, box-shadow .4s ease;
}
.company-card.card-visible { opacity: 1; transform: translate3d(0,0,0) scale(1); }
.company-card.card-visible:hover,
.company-card.card-visible:focus-visible {
    border-color: rgba(63,120,189,.34); box-shadow: 0 24px 58px rgba(7,21,37,.16);
    transform: translate3d(0,-7px,0) scale(1.01); outline: none;
}
.company-image {
    position: relative; display: flex; align-items: center; justify-content: center;
    width: 100%; height: 285px; padding: 34px;
    background: linear-gradient(180deg, #fff, #f8fbfd);
}
.company-image::before {
    content: ''; position: absolute; inset: 16px; border: 1px solid rgba(32,54,108,.07); border-radius: 18px;
    background: linear-gradient(145deg, rgba(255,255,255,.96), rgba(236,243,249,.76));
}
.company-image img {
    position: relative; z-index: 1; display: block; width: 88%; height: 88%; object-fit: contain;
    transition: transform .55s var(--premium-ease);
}
.company-card:hover .company-image img,
.company-card:focus-visible .company-image img { transform: scale(1.045); }
.company-card::after {
    content: '\f35d'; position: absolute; right: 18px; bottom: 18px; z-index: 2;
    display: flex; align-items: center; justify-content: center; width: 42px; height: 42px;
    border-radius: 50%; color: #fff; background: var(--gmi-blue-gradient); box-shadow: 0 12px 25px rgba(32,54,108,.25);
    font-family: 'Font Awesome 6 Free'; font-size: 12px; font-weight: 900;
    opacity: 0; transform: translateY(8px) scale(.94); transition: opacity .25s ease, transform .3s var(--premium-ease);
}
.company-card:hover::after, .company-card:focus-visible::after { opacity: 1; transform: translateY(0) scale(1); }

/* Footer — exact index.php structure and visual rules */
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
    .companies-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 20px; }
    .company-image { height: 255px; }
    .footer-grid-responsive { grid-template-columns: 1fr 1fr; gap: 30px; }
    .footer-heading-responsive { font-size: 1rem; }
    .footer-link-responsive, .footer-contact-responsive { font-size: .88rem; }
    .footer-great-logo-img { max-width: 180px; }
    .footer-offer-logo-img { max-width: 160px; }
}
@media (max-width: 860px) {
    .gmi-nav-buttons { display: none; }
    .gmi-hamburger { display: flex; }
    .gmi-header-left .logo-img { max-height: 38px; }
}
@media (max-width: 768px) {
    .container { padding: 0 20px; }
    .gmi-custom-header { min-height: 62px; padding: 10px 16px; }
    .breadcrumb-section { min-height: 245px; }
    .breadcrumb-title { padding: 10px 16px 10px 18px; border-radius: 0 13px 13px 0; font-size: clamp(1.6rem, 8vw, 2.15rem); }
    .companies-section { padding: 68px 0 78px; }
    .section-heading { margin-bottom: 34px; }
    .section-heading p { font-size: .88rem; }
    .company-image { height: 225px; padding: 25px; }
    .footer-grid-responsive { grid-template-columns: 1fr; gap: 24px; text-align: center; }
    .footer-social-responsive, .footer-contact-responsive { justify-content: center; }
    .footer-bottom-responsive, .footer-bottom-links-responsive { flex-direction: column; text-align: center; }
    .footer-bottom-links-responsive { flex-direction: row; flex-wrap: wrap; justify-content: center; }
    .footer-great-logo-img, .footer-offer-logo-img { max-width: 150px; margin: 0 auto; }
}
@media (max-width: 560px) {
    .companies-grid { grid-template-columns: 1fr; max-width: 450px; margin: 0 auto; gap: 18px; }
    .company-image { height: 230px; }
    .company-card { border-radius: 20px; }
}
@media (max-width: 480px) {
    .gmi-custom-header { min-height: 52px; padding: 8px 12px; }
    .gmi-header-left { gap: 10px; }
    .gmi-header-left .logo-img { max-height: 30px; }
    .gmi-hamburger { width: 38px; height: 38px; }
    .gmi-hamburger span { width: 26px; height: 3px; }
    .breadcrumb-section { min-height: 210px; }
    .breadcrumb-eyebrow { font-size: .62rem; letter-spacing: 1.5px; }
    .breadcrumb-title { font-size: 1.6rem; }
    .breadcrumb-ul li { font-size: 10px; }
    .companies-section { padding: 52px 0 62px; }
    .section-heading h1 { font-size: 1.8rem; }
    .company-image { height: 205px; padding: 21px; }
    .company-image::before { inset: 12px; border-radius: 15px; }
    .footer-inline { padding: 40px 16px 25px; }
    .footer-heading-responsive { font-size: .95rem; margin-bottom: 12px; }
    .footer-link-responsive, .footer-contact-responsive { font-size: .82rem; }
    .footer-link-item { margin: 6px 0; }
    .footer-social-responsive a { width: 38px; height: 38px; font-size: 1rem; }
    .footer-bottom-text { font-size: .78rem; }
    .footer-great-logo-img { max-width: 120px; }
    .footer-offer-logo-img { max-width: 110px; }
}
@media (max-width: 992px), (hover: none), (pointer: coarse) {
    .company-card { box-shadow: 0 8px 24px rgba(7,21,37,.10); }
    .company-card::after { display: none; }
}
@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    #loader-wrapper, .company-card, .company-image img, .footer-social-responsive a { transition: none !important; }
    .company-card { opacity: 1 !important; transform: none !important; }
}


/* =========================================================
   FINAL LOADER + SCROLLING HEADER OVERRIDE
   Uses the same interaction as the updated homepage.
   ========================================================= */
html.gmi-loading,
body.gmi-loading {
    overflow: hidden !important;
}

#loader-wrapper {
    position: fixed !important;
    inset: 0 !important;
    z-index: 1000000 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100% !important;
    height: 100% !important;
    background: #071525 !important;
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: all !important;
    transition: opacity .8s cubic-bezier(.22,1,.36,1), visibility .8s ease !important;
}

#loader-wrapper.gmi-loaded {
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
}

#loader {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 190px !important;
    height: 190px !important;
}

#loader::before,
#loader::after {
    content: '';
    position: absolute;
    inset: 12px;
    border: 1px solid rgba(138,196,255,.24);
    border-radius: 50%;
    animation: gmiCompaniesLoaderRing 2.4s ease-out infinite;
}

#loader::after {
    inset: 31px;
    border-color: rgba(138,196,255,.14);
    animation-delay: .8s;
}

#loader img {
    position: relative !important;
    z-index: 2 !important;
    width: 130px !important;
    height: auto !important;
    filter: drop-shadow(0 0 30px rgba(138,196,255,.34)) !important;
    animation: gmiCompaniesLoaderPulse 2.2s ease-in-out infinite !important;
    will-change: transform, opacity;
}

@keyframes gmiCompaniesLoaderPulse {
    0%, 100% { opacity: .68; transform: scale(.95); }
    50% { opacity: 1; transform: scale(1.06); }
}

@keyframes gmiCompaniesLoaderRing {
    0% { opacity: 0; transform: scale(.72); }
    34% { opacity: .75; }
    100% { opacity: 0; transform: scale(1.18); }
}

.gmi-custom-header {
    min-height: 88px !important;
    padding: 14px 30px !important;
    border-bottom: 1px solid transparent !important;
    background: #fff !important;
    box-shadow: 0 2px 16px rgba(0,0,0,.10) !important;
    transition:
        min-height .4s var(--premium-ease),
        padding .4s var(--premium-ease),
        background .3s ease,
        border-color .3s ease,
        box-shadow .4s ease !important;
}

.gmi-header-left .logo-img {
    max-height: 60px !important;
    transition: max-height .4s var(--premium-ease), transform .4s var(--premium-ease) !important;
}

.gmi-custom-header.gmi-header-scrolled {
    min-height: 68px !important;
    padding-top: 6px !important;
    padding-bottom: 6px !important;
    border-bottom-color: rgba(32,54,108,.14) !important;
    background: rgba(255,255,255,.98) !important;
    box-shadow: 0 12px 36px rgba(7,21,37,.15) !important;
}

.gmi-custom-header.gmi-header-scrolled .logo-img {
    max-height: 44px !important;
    transform: translateZ(0);
}

.gmi-hamburger span {
    transition: transform .3s ease, opacity .3s ease !important;
}
.gmi-hamburger.is-open span:nth-child(1) { transform: translateY(8.5px) rotate(45deg); }
.gmi-hamburger.is-open span:nth-child(2) { opacity: 0; }
.gmi-hamburger.is-open span:nth-child(3) { transform: translateY(-8.5px) rotate(-45deg); }

@media (max-width: 992px) {
    .gmi-custom-header {
        min-height: 72px !important;
        padding: 12px 20px !important;
    }
    .gmi-custom-header.gmi-header-scrolled {
        min-height: 62px !important;
        padding-top: 7px !important;
        padding-bottom: 7px !important;
    }
}

@media (max-width: 860px) {
    .gmi-header-left .logo-img,
    .gmi-custom-header.gmi-header-scrolled .logo-img {
        max-height: 38px !important;
    }
}

@media (max-width: 768px) {
    .gmi-custom-header {
        min-height: 62px !important;
        padding: 10px 16px !important;
    }
    .gmi-custom-header.gmi-header-scrolled {
        min-height: 54px !important;
        padding-top: 6px !important;
        padding-bottom: 6px !important;
    }
}

@media (max-width: 480px) {
    #loader { width: 155px !important; height: 155px !important; }
    #loader img { width: 105px !important; }
    .gmi-custom-header {
        min-height: 52px !important;
        padding: 8px 12px !important;
    }
    .gmi-header-left .logo-img { max-height: 30px !important; }
    .gmi-custom-header.gmi-header-scrolled {
        min-height: 46px !important;
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }
    .gmi-custom-header.gmi-header-scrolled .logo-img { max-height: 26px !important; }
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

<div id="loader-wrapper">
    <div id="loader">
        <img src="images/logo/loader/GMG_loading.png" alt="Loading..." decoding="async" loading="eager">
    </div>
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
        <a href="companies.php" class="gmi-current" aria-current="page">Companies</a>
        <a href="events.php">Events</a>
        <a href="careers.php">Careers</a>
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
        <a href="companies.php" class="gmi-current" aria-current="page">Companies</a>
        <a href="events.php">Events</a>
        <a href="careers.php">Careers</a>
        <a href="contact-us.php">Contact Us</a>
    </nav>
</header>

<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb-area">
            <div class="breadcrumb-eyebrow"><i class="fas fa-building"></i> Global Marine Group</div><br>
            <h1 class="breadcrumb-title">Our Companies</h1>
            <ul class="breadcrumb-ul">
                <li><a href="/">Home</a></li>
                <li aria-current="page">Companies</li>
            </ul>
        </div>
    </div>
</section>

<section class="companies-section">
    <div class="container">
        <div class="section-heading">
            <div class="section-eyebrow">Our Group</div>
            <h1>Companies Within Our Network</h1>
            <p>Explore the specialist businesses that operate across shipping, logistics, port services, marine services and workforce solutions under Global Marine Group.</p>
        </div>

        <div class="companies-grid">
            <a href="http://www.samudera.id/" target="_blank" rel="noopener noreferrer" class="company-card" aria-label="Visit SSL Agency Lanka website">
                <div class="company-image"><img src="images/logofinal/SSL.png" alt="SSL Agency Lanka" loading="lazy" decoding="async"></div>
            </a>

            <a href="port-agency-services.php" class="company-card" aria-label="View Global Port Services">
                <div class="company-image"><img src="images/logofinal/GPS.png" alt="Global Port Services" loading="lazy" decoding="async"></div>
            </a>

            <a href="http://www.globalfeeders.com/" target="_blank" rel="noopener noreferrer" class="company-card" aria-label="Visit Global Feeders Lanka website">
                <div class="company-image"><img src="images/logofinal/GFL.png" alt="Global Feeders Lanka" loading="lazy" decoding="async"></div>
            </a>

            <a href="https://globalmarineservices.lk/" target="_blank" rel="noopener noreferrer" class="company-card" aria-label="Visit Global Marine Services website">
                <div class="company-image"><img src="images/logofinal/GMS.png" alt="Global Marine Services" loading="lazy" decoding="async"></div>
            </a>

            <a href="freight-forwarding-and-logistics.php" class="company-card" aria-label="View Global Multimodal Logistics">
                <div class="company-image"><img src="images/logofinal/GML.png" alt="Global Multimodal Logistics" loading="lazy" decoding="async"></div>
            </a>

            <a href="http://www.cordelialine.com/" target="_blank" rel="noopener noreferrer" class="company-card" aria-label="Visit Cordelia Container Line website">
                <div class="company-image"><img src="images/logofinal/CSL.png" alt="Cordelia Container Line Lanka" loading="lazy" decoding="async"></div>
            </a>

            <a href="contact-us.php" class="company-card" aria-label="Contact us about MPSS Shipping">
                <div class="company-image"><img src="images/logofinal/MPSS.png" alt="MPSS Shipping" loading="lazy" decoding="async"></div>
            </a>

            <a href="foreign-employment-agency.php" class="company-card" aria-label="View KSL Resources">
                <div class="company-image"><img src="images/logofinal/KSL.png" alt="KSL Resources" loading="lazy" decoding="async"></div>
            </a>

            <a href="contact-us.php" class="company-card" aria-label="Contact us about Global Marine Ship Management">
                <div class="company-image"><img src="images/logofinal/MPSS.png" alt="Global Marine Ship Management" loading="lazy" decoding="async"></div>
            </a>
        </div>
    </div>
</section>

<footer class="footer-inline section">
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
    var startedAt = window.performance && performance.now ? performance.now() : Date.now();
    var minimumLoaderTime = 900;
    var scrollFrame = 0;
    var resizeFrame = 0;
    var loaderFinished = false;

    root.classList.remove('no-js');
    root.classList.add('gmi-loading');
    body.classList.add('gmi-loading');

    function syncHeaderOffset() {
        if (!header) return;
        body.style.paddingTop = Math.ceil(header.getBoundingClientRect().height) + 'px';
    }

    function updatePageChrome() {
        scrollFrame = 0;

        var scrollTop = window.pageYOffset || root.scrollTop || 0;
        var maxScroll = Math.max(0, root.scrollHeight - root.clientHeight);
        var progress = maxScroll > 0 ? scrollTop / maxScroll : 0;

        if (progressBar) {
            progressBar.style.transform = 'scaleX(' + Math.min(1, Math.max(0, progress)) + ')';
        }

        if (header) {
            var shouldShrink = scrollTop > 36;
            if (header.classList.contains('gmi-header-scrolled') !== shouldShrink) {
                header.classList.toggle('gmi-header-scrolled', shouldShrink);
                window.requestAnimationFrame(syncHeaderOffset);
            }
        }
    }

    function requestScrollUpdate() {
        if (!scrollFrame) scrollFrame = window.requestAnimationFrame(updatePageChrome);
    }

    function requestResizeUpdate() {
        if (resizeFrame) window.cancelAnimationFrame(resizeFrame);
        resizeFrame = window.requestAnimationFrame(function () {
            resizeFrame = 0;
            if (window.innerWidth > 860 && mobileNav && mobileNav.classList.contains('open')) {
                mobileNav.classList.remove('open');
                if (hamburger) {
                    hamburger.classList.remove('is-open');
                    hamburger.setAttribute('aria-expanded', 'false');
                }
            }
            syncHeaderOffset();
            updatePageChrome();
        });
    }

    window.toggleMobileNav = function () {
        if (!mobileNav) return;
        var isOpen = mobileNav.classList.toggle('open');
        if (hamburger) {
            hamburger.classList.toggle('is-open', isOpen);
            hamburger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }
        window.requestAnimationFrame(syncHeaderOffset);
    };

    if (mobileNav) {
        mobileNav.addEventListener('click', function (event) {
            if (!event.target.closest('a')) return;
            mobileNav.classList.remove('open');
            if (hamburger) {
                hamburger.classList.remove('is-open');
                hamburger.setAttribute('aria-expanded', 'false');
            }
            window.requestAnimationFrame(syncHeaderOffset);
        });
    }

    var cards = doc.querySelectorAll('.company-card');
    if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        cards.forEach(function (card) { card.classList.add('card-visible'); });
    } else {
        var cardObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('card-visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.08, rootMargin: '100px 0px -5% 0px' });

        cards.forEach(function (card, index) {
            card.style.transitionDelay = Math.min(index % 3, 2) * 90 + 'ms';
            cardObserver.observe(card);
        });
    }

    function finishLoader() {
        if (loaderFinished) return;
        loaderFinished = true;
        if (loader) loader.classList.add('gmi-loaded');
        root.classList.remove('gmi-loading');
        body.classList.remove('gmi-loading');
        syncHeaderOffset();
        updatePageChrome();
    }

    function scheduleLoaderFinish() {
        var now = window.performance && performance.now ? performance.now() : Date.now();
        var wait = Math.max(0, minimumLoaderTime - (now - startedAt));
        window.setTimeout(finishLoader, wait);
    }

    doc.addEventListener('DOMContentLoaded', function () {
        syncHeaderOffset();
        updatePageChrome();
    }, { once: true });

    if (doc.readyState === 'complete') {
        scheduleLoaderFinish();
    } else {
        window.addEventListener('load', scheduleLoaderFinish, { once: true });
    }

    window.addEventListener('scroll', requestScrollUpdate, { passive: true });
    window.addEventListener('resize', requestResizeUpdate, { passive: true });
    window.addEventListener('orientationchange', requestResizeUpdate, { passive: true });

    if ('ResizeObserver' in window && header) {
        new ResizeObserver(syncHeaderOffset).observe(header);
    }

    window.setTimeout(scheduleLoaderFinish, 7000);
    syncHeaderOffset();
    updatePageChrome();
}());
</script>

</body>
</html>