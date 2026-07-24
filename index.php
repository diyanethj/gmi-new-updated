<!DOCTYPE html>
<html class="no-js gmi-loading-root" lang="en" style="background:#071525;">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KQ95BNCRG5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-KQ95BNCRG5');
    </script>

    <meta name="google-site-verification" content="s4FHWvq2Z0XJayS-hsCU6sznbprxnNA9uQABlyGXhPg" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Global Marine Group">
    <meta name="description" content="Global Marine Group is a privately owned Group of companies, licensed and registered to carry out businesses in the liner shipping, NVOCC etc">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Global Marine group">
    <title>Global Marine Group</title>
    <meta property="og:site_name" content="Global Marine Group" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Global Marine Group" />
    <meta property="og:url" content="https://gmigroup.lk/" />
    <link rel="shortcut icon" type="image/x-icon" href="images/logo/favicon.png" />

    <!-- Only two external origins left: fonts + icons. Both preconnected so they don't start cold. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
/* =====================================================
   GLOBAL MARINE GROUP - HOMEPAGE
   Single consolidated stylesheet (no template bloat,
   no triple-cascade overrides - final look computed once)
   ===================================================== */

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
    padding-top: 88px; /* kept in sync with header height by JS */
    background: var(--gmi-surface);
    color: #102033;
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    -webkit-font-smoothing: antialiased;
}

::selection { color: #fff; background: #20366C; }

img { max-width: 100%; }

.fa, .fas, .far, .fal, .fab { line-height: 1; }

/* ---------- Premium loading animation ---------- */
#loader-wrapper {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    background: var(--gmi-navy);
    opacity: 1;
    visibility: visible;
    transition: opacity .8s cubic-bezier(.22,1,.36,1), visibility .8s ease;
}
#loader-wrapper.gmi-loaded {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}
#loader {
    display: flex;
    align-items: center;
    justify-content: center;
}
#loader img {
    width: 130px;
    height: auto;
    animation: gmiLoaderPulse 2.3s ease-in-out infinite;
    filter: drop-shadow(0 0 28px rgba(138,196,255,.28));
    will-change: transform, opacity;
}
@keyframes gmiLoaderPulse {
    0%, 100% { opacity: .68; transform: scale(.95); }
    50% { opacity: 1; transform: scale(1.055); }
}

/* ---------- Scroll progress bar ---------- */
.gmi-progress-bar {
    position: fixed; top: 0; left: 0; z-index: 100000;
    width: 100%; height: 4px;
    background: linear-gradient(90deg, #20366C 0%, #2a4a8a 50%, #1e90ff 100%);
    transform: scaleX(0);
    transform-origin: left center;
    will-change: transform;
}

/* ---------- Header ---------- */
.gmi-custom-header {
    position: fixed; top: 0; left: 0; z-index: 9999;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;
    width: 100%; min-height: 88px;
    padding: 14px 30px;
    border-bottom: 1px solid transparent;
    background: #ffffff;
    box-shadow: 0 2px 16px rgba(0,0,0,.10);
    transition: min-height .4s var(--premium-ease), padding .4s var(--premium-ease),
                background .3s ease, border-color .3s ease, box-shadow .4s ease;
    will-change: min-height, padding;
}
.gmi-custom-header.gmi-header-scrolled {
    min-height: 72px;
    padding-top: 9px;
    padding-bottom: 9px;
    border-bottom-color: rgba(32,54,108,.10);
    background: rgba(255,255,255,.97);
    box-shadow: 0 12px 36px rgba(7,21,37,.13);
}
.gmi-header-left { display: flex; align-items: center; gap: 20px; }
.gmi-logo-link { display: inline-flex; align-items: center; line-height: 0; text-decoration: none; }
.gmi-header-left .logo-img {
    max-height: 60px;
    width: auto;
    transition: max-height .4s var(--premium-ease), transform .4s var(--premium-ease);
}
.gmi-custom-header.gmi-header-scrolled .logo-img {
    max-height: 48px;
    transform: translateZ(0);
}

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
.gmi-nav-buttons > a:not(.gmi-quote-btn):hover::after { transform: scaleX(1); }
.gmi-nav-buttons > a.gmi-current::after { transform: scaleX(1); }

.gmi-nav-buttons a.gmi-quote-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    min-height: 44px; margin-left: 10px; padding: 12px 24px; border-radius: 30px;
    color: #fff; background: var(--gmi-blue-gradient);
    box-shadow: 0 6px 18px rgba(32,54,108,0.28);
    font-size: 12.5px; font-weight: 700; letter-spacing: .4px; text-decoration: none;
    white-space: nowrap; transition: .3s ease;
}
.gmi-nav-buttons a.gmi-quote-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(32,54,108,0.38); background: linear-gradient(145deg, #2a4a8a 0%, #20366C 100%); }
.gmi-nav-buttons a.gmi-quote-btn i { font-size: 8.5px; color: #fff; }
@media (max-width: 992px) { .gmi-nav-buttons a.gmi-quote-btn { display: none; } }

.gmi-hamburger {
    display: none; flex-direction: column; align-items: center; justify-content: center; gap: 5px;
    width: 42px; height: 42px; padding: 6px; border: none; border-radius: 8px;
    background: transparent; cursor: pointer;
}
.gmi-hamburger:hover { background: #f0f4f8; }
.gmi-hamburger span {
    display: block; width: 30px; height: 3.5px; border-radius: 4px; background: #0a1a2b;
    transition: transform .3s ease, opacity .3s ease;
}
.gmi-hamburger.is-open span:nth-child(1) { transform: translateY(8.5px) rotate(45deg); }
.gmi-hamburger.is-open span:nth-child(2) { opacity: 0; }
.gmi-hamburger.is-open span:nth-child(3) { transform: translateY(-8.5px) rotate(-45deg); }

.gmi-nav-mobile {
    display: none; flex-direction: column; width: 100%; margin-top: 12px; padding: 12px 0;
    border-top: 1px solid #eaeaea; background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.gmi-nav-mobile.open { display: flex; }
.gmi-nav-mobile a {
    display: block; width: 100%; padding: 14px 24px; border-bottom: 1px solid #f0f0f0;
    color: #0a1a2b; font-size: 16px; font-weight: 700; text-decoration: none;
}
.gmi-nav-mobile a:hover { color: #20366C; background: #f5f8fc; }

@media (max-width: 992px) { .gmi-custom-header { min-height: 72px; padding: 12px 20px; } }
@media (max-width: 860px) {
    .gmi-nav-buttons { display: none; }
    .gmi-hamburger { display: flex; }
    .gmi-header-left .logo-img,
    .gmi-custom-header.gmi-header-scrolled .logo-img { max-height: 38px; }
}
@media (max-width: 768px) { .gmi-custom-header { min-height: 62px; padding: 10px 16px; } }
@media (max-width: 480px) {
    .gmi-custom-header { min-height: 52px; padding: 8px 12px; }
    .gmi-header-left { gap: 10px; }
    .gmi-header-left .logo-img,
    .gmi-custom-header.gmi-header-scrolled .logo-img { max-height: 30px; }
    .gmi-hamburger { width: 38px; height: 38px; }
    .gmi-hamburger span { width: 26px; height: 3px; }
}

/* ---------- Section reveal (scroll-in) ---------- */
.section { opacity: 0; transform: translateY(40px); transition: opacity .8s var(--premium-ease), transform .8s var(--premium-ease); }
.section.visible { opacity: 1; transform: translateY(0); will-change: auto; }
.main-banner, .video-banner-container, .gmi-slogan-bar { opacity: 1; transform: none; transition: none; }

.premium-reveal { opacity: 0; transform: translate3d(0, 34px, 0) scale(0.982); transition: opacity 1.05s var(--premium-ease), transform 1.25s var(--premium-ease); transition-delay: var(--premium-delay, 0ms); }
.premium-reveal.premium-visible { opacity: 1; transform: translate3d(0,0,0) scale(1); will-change: auto; }

/* ---------- Hero ---------- */
.main-banner { position: relative; overflow: hidden; background: #071525; margin: 0; line-height: 0; }
.video-banner-container {
    position: relative; width: 100%; overflow: hidden;
    min-height: clamp(610px, calc(100vh - 88px), 880px);
    background: #071525;
}
.video-banner-container video {
    position: absolute; inset: 0; width: 100%; height: 100%;
    object-fit: cover; object-position: center; display: block;
    transform: scale(1.01);
}
.video-banner-container > img.hero-eagle {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    width: clamp(180px, 24vw, 410px); height: auto; z-index: 5; opacity: 0.8; pointer-events: none;
}
.hero-scrim {
    position: absolute; inset: 0; z-index: 4; pointer-events: none;
    background:
        radial-gradient(circle at 18% 70%, rgba(30,87,145,0.28), transparent 38%),
        linear-gradient(90deg, rgba(4,14,26,0.90) 0%, rgba(4,14,26,0.58) 43%, rgba(4,14,26,0.18) 72%, rgba(4,14,26,0.44) 100%),
        linear-gradient(180deg, rgba(4,14,26,0.28) 0%, rgba(4,14,26,0.10) 40%, rgba(4,14,26,0.86) 100%);
}
.hero-content {
    position: absolute; left: max(6%, calc((100vw - 1280px) / 2 + 20px)); bottom: 12%; z-index: 6;
    max-width: 920px; color: #fff; line-height: 1.4;
    opacity: 0; transform: translate3d(-34px, 24px, 0);
    transition: opacity 1.25s var(--premium-ease), transform 1.45s var(--premium-ease);
}
body.premium-ready .hero-content { opacity: 1; transform: translate3d(0,0,0); }
.hero-content::before {
    content: ''; position: absolute; top: -18px; left: 0; width: 110px; height: 3px; border-radius: 5px;
    background: linear-gradient(90deg, #8ac4ff, rgba(138,196,255,0));
    box-shadow: 0 0 22px rgba(138,196,255,0.55);
}
.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 10px; margin-bottom: 18px;
    padding: 9px 17px; border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.22); background: rgba(255,255,255,0.09);
    color: #b8d4f0; font-size: 0.68rem; font-weight: 700; letter-spacing: 1.6px; text-transform: uppercase;
}
.hero-eyebrow i { color: #6ab0ff; }
.hero-content h1 {
    margin: 0 0 16px; max-width: 900px; white-space: normal;
    font-size: clamp(1.9rem, 3.2vw, 3.15rem); font-weight: 800; line-height: 1.15; letter-spacing: -1px;
    text-shadow: 0 2px 14px rgba(0,0,0,0.30);
}
.hero-content h1 span {
    background: linear-gradient(135deg, #eaf3ff 0%, #9dc9ff 55%, #d6ebff 100%);
    -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; color: transparent;
}
.hero-content p {
    margin: 0 0 28px; max-width: 610px; color: #d8e7f5;
    font-size: clamp(0.88rem, 1.05vw, 1rem); line-height: 1.65;
    text-shadow: 0 2px 12px rgba(0,0,0,0.3);
}
.hero-cta-group { display: flex; gap: 12px; flex-wrap: wrap; }
.hero-btn-primary, .hero-btn-secondary {
    position: relative; overflow: hidden; display: inline-flex; align-items: center; gap: 10px;
    min-height: 42px; padding: 10px 20px; border-radius: 999px;
    font-weight: 700; font-size: 0.8rem; letter-spacing: .3px; text-decoration: none;
    box-shadow: 0 14px 34px rgba(4,14,26,0.25);
    transition: transform .4s var(--premium-ease), box-shadow .4s ease;
}
.hero-btn-primary { background: var(--gmi-blue-gradient); color: #fff; }
.hero-btn-secondary { background: rgba(255,255,255,0.08); border: 1.5px solid rgba(255,255,255,0.4); color: #fff; }
.hero-btn-primary::before, .hero-btn-secondary::before {
    content: ''; position: absolute; top: -120%; left: -35%; width: 30%; height: 340%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.34), transparent);
    transform: rotate(23deg); transition: left .7s var(--premium-ease);
}
.hero-btn-primary:hover::before, .hero-btn-secondary:hover::before { left: 120%; }
.hero-btn-primary:hover, .hero-btn-secondary:hover { transform: translate3d(0,-4px,0); box-shadow: 0 20px 46px rgba(4,14,26,0.35); color: #fff; }

.hero-scroll-cue {
    position: absolute; right: 6%; bottom: 14%; z-index: 6;
    display: flex; flex-direction: column; align-items: center; gap: 10px; color: #d5e6f7;
    opacity: 0; transform: translateY(15px);
    transition: opacity 1s ease .75s, transform 1.1s var(--premium-ease) .75s;
}
body.premium-ready .hero-scroll-cue { opacity: 1; transform: translateY(0); }
.hero-scroll-cue span { font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase; font-weight: 600; writing-mode: vertical-rl; }
.hero-scroll-cue .scroll-line { width: 1px; height: 50px; background: linear-gradient(180deg, rgba(255,255,255,0.7), transparent); position: relative; overflow: hidden; }
.hero-scroll-cue .scroll-line::after {
    content: ''; position: absolute; top: -100%; left: 0; width: 100%; height: 100%; background: #fff;
    animation: scrollLineMove 2s ease-in-out infinite;
}
@keyframes scrollLineMove { 0% { top: -100%; } 60% { top: 100%; } 100% { top: 100%; } }

@media (max-width: 1150px) { .video-banner-container { min-height: clamp(590px, calc(100vh - 72px), 800px); } }
@media (max-width: 992px) {
    .hero-content { left: 5%; right: 5%; bottom: 10%; max-width: 100%; }
    .hero-scroll-cue { display: none; }
}
@media (max-width: 768px) {
    .video-banner-container { min-height: clamp(580px, calc(100svh - 62px), 760px); }
    .video-banner-container > img.hero-eagle { top: 35%; width: clamp(145px, 34vw, 250px); }
    .hero-content { bottom: 8%; }
    .hero-content::before { width: 80px; }
    .hero-content h1 { font-size: clamp(1.9rem, 6vw, 2.6rem); letter-spacing: -0.8px; }
    .hero-content p { max-width: 540px; font-size: 0.85rem; line-height: 1.6; }
    .hero-btn-primary, .hero-btn-secondary { min-height: 40px; padding: 9px 18px; font-size: 0.76rem; }
}
@media (max-width: 560px) {
    .video-banner-container { min-height: max(610px, calc(100svh - 52px)); }
    .hero-eyebrow { max-width: 100%; font-size: 0.65rem; letter-spacing: 1.4px; }
    .hero-cta-group { flex-direction: column; align-items: stretch; max-width: 310px; }
    .hero-btn-primary, .hero-btn-secondary { justify-content: center; width: 100%; }
}
@media (max-width: 480px) {
    .hero-content h1 { font-size: 1.55rem; }
    .hero-eyebrow { font-size: 0.6rem; padding: 6px 14px; }
    .hero-btn-primary, .hero-btn-secondary { padding: 9px 16px; font-size: 0.7rem; }
}

/* ---------- Slogan bar ---------- */
.gmi-slogan-bar {
    position: relative; overflow: hidden; padding: 16px 20px; text-align: center;
    background: linear-gradient(110deg, #071525 0%, #102a47 48%, #071525 100%);
    border-top: 1px solid rgba(138,196,255,0.16);
    border-bottom: 1px solid rgba(138,196,255,0.10);
}
.gmi-slogan-bar::before {
    content: ''; position: absolute; inset: 0;
    background:
        repeating-linear-gradient(90deg, transparent, transparent 50%, rgba(32,54,108,0.05) 50%, rgba(32,54,108,0.05) 100%),
        repeating-linear-gradient(0deg, transparent, transparent 50%, rgba(32,54,108,0.03) 50%, rgba(32,54,108,0.03) 100%);
    background-size: 60px 60px; pointer-events: none; z-index: 0;
}
.gmi-slogan-bar .gmi-slogan-text { position: relative; z-index: 1; color: #fff; font-size: 1.5rem; font-weight: 700; letter-spacing: 1.5px; white-space: nowrap; }
.gmi-slogan-bar .gmi-slogan-text span.gmi-part {
    display: inline-block; padding: 0.55rem 2rem; border-radius: 50px;
    background: rgba(255,255,255,0.045); border: 1px solid rgba(138,196,255,0.16);
    box-shadow: 0 12px 30px rgba(0,0,0,0.14);
    white-space: nowrap; opacity: 0; animation: gmiPartIn 0.7s ease both;
}
.gmi-slogan-bar .gmi-part-1 { animation-delay: 0.2s; }
.gmi-slogan-bar .gmi-part-2 { animation-delay: 0.6s; }
.gmi-slogan-bar .gmi-separator {
    display: inline-block; color: #ffd700; margin: 0 10px; font-weight: 300; font-size: 1.7rem; line-height: 1;
    animation: gmiPulseDot 1.8s ease-in-out infinite; animation-delay: 1.2s;
    text-shadow: 0 0 20px rgba(255,215,0,0.3);
}
@keyframes gmiPartIn { 0% { opacity: 0; transform: translateY(15px) scale(0.95); } 100% { opacity: 1; transform: translateY(0) scale(1); } }
@keyframes gmiPulseDot { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.5); opacity: 0.6; } }

@media (max-width: 992px) {
    .gmi-slogan-bar .gmi-slogan-text { font-size: 1.3rem; letter-spacing: 1.2px; }
    .gmi-slogan-bar .gmi-slogan-text span.gmi-part { padding: 0.45rem 1.6rem; }
    .gmi-slogan-bar .gmi-separator { font-size: 1.5rem; margin: 0 8px; }
}
@media (max-width: 768px) {
    .gmi-slogan-bar .gmi-slogan-text { font-size: 1.05rem; letter-spacing: 1px; }
    .gmi-slogan-bar .gmi-slogan-text span.gmi-part { padding: 0.35rem 1.1rem; }
    .gmi-slogan-bar .gmi-separator { font-size: 1.15rem; margin: 0 6px; }
}
@media (max-width: 480px) {
    .gmi-slogan-bar { padding: 10px 8px; }
    .gmi-slogan-bar .gmi-slogan-text { display: flex; flex-direction: column; align-items: center; gap: 7px; white-space: normal; font-size: 0.95rem; letter-spacing: 0.5px; }
    .gmi-slogan-bar .gmi-slogan-text span.gmi-part { padding: 0.25rem 1rem; }
    .gmi-slogan-bar .gmi-separator { display: none; }
}

/* ---------- Wave divider ---------- */
.gmi-wave-divider { display: block; width: 100%; line-height: 0; background: #0a1a2b; }
.gmi-wave-divider svg { display: block; width: 100%; height: 46px; }
@media (max-width: 480px) { .gmi-wave-divider svg { height: 26px; } }

/* ---------- Shared section heading ---------- */
.container { max-width: 1280px; margin: 0 auto; padding: 0 30px; }
.offer-section-three, .logo-section, .home-blog-section { position: relative; overflow: hidden; content-visibility: auto; contain-intrinsic-size: 760px; }

.section-heading { position: relative; margin-bottom: 42px; }
.section-eyebrow {
    display: inline-flex; align-items: center; gap: 8px; margin: 0 0 12px 30px;
    color: #20366C; font-size: 0.76rem; font-weight: 700; letter-spacing: 2.8px; text-transform: uppercase;
}
.section-eyebrow::before { content: ''; width: 26px; height: 2px; background: var(--gmi-blue-gradient); border-radius: 2px; }
.section-heading h1 {
    margin: 0; padding-left: 28px; border-left: 6px solid #20366C;
    font-size: clamp(2rem, 3.4vw, 3.05rem); font-weight: 800; line-height: 1.08; letter-spacing: -1.5px; color: #0a1a2b;
}
.offer-section-three .section-heading { text-align: center; }
.offer-section-three .section-eyebrow { margin: 0 0 12px; justify-content: center; }
.offer-section-three .section-heading h1 { padding-left: 0; border-left: none; }
@media (max-width: 768px) {
    .offer-section-three, .logo-section, .home-blog-section { padding-top: 68px; padding-bottom: 74px; }
    .section-heading { margin-bottom: 32px; }
    .section-eyebrow { margin-left: 22px; }
    .section-heading h1 { padding-left: 18px; font-size: clamp(1.75rem, 7vw, 2.35rem); }
}

/* ---------- Business segments ---------- */
.offer-section-three { padding: 90px 0 100px; background: linear-gradient(180deg, #ffffff 0%, #f4f8fc 100%); }
.offer-section-three::before {
    content: ''; position: absolute; z-index: -1; top: -250px; right: -180px; width: 430px; height: 430px; border-radius: 50%;
    background: radial-gradient(circle, rgba(63,120,189,0.13), transparent 68%); pointer-events: none;
}
.ofer-items { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
.single-offer-item {
    position: relative; isolation: isolate; overflow: hidden;
    display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;
    aspect-ratio: 1 / 1; padding: 32px 20px 27px; border-radius: 22px;
    border: 1px solid rgba(138,196,255,0.15);
    background: linear-gradient(145deg, #10243d 0%, #20366C 52%, #2a4a8a 100%);
    box-shadow: 0 16px 38px rgba(7,21,37,0.14);
    transition: transform .55s var(--premium-ease), border-color .4s ease, box-shadow .5s ease;
}
.single-offer-item::before {
    content: ''; position: absolute; inset: 0; z-index: 0; border-radius: inherit; opacity: 0; transition: opacity .45s ease;
    background: radial-gradient(circle at 50% 50%, rgba(138,196,255,0.26), transparent 38%), linear-gradient(145deg, rgba(42,74,138,0.86), rgba(16,36,61,0.94));
}
.single-offer-item::after {
    content: ''; position: absolute; inset: 0; z-index: 0; border-radius: inherit; pointer-events: none;
    background: linear-gradient(135deg, rgba(255,255,255,0.16), transparent 34%, transparent 70%, rgba(138,196,255,0.10));
}
.single-offer-item:hover::before { opacity: 1; }
.single-offer-item:hover { border-color: rgba(138,196,255,0.46); box-shadow: 0 28px 65px rgba(7,21,37,0.25), 0 0 0 1px rgba(138,196,255,0.08) inset; transform: translate3d(0,-10px,0) scale(1.018); }
.single-offer-item > * { position: relative; z-index: 1; }
.offer-icon {
    width: 82px; height: 82px; margin-bottom: 14px; display: flex; align-items: center; justify-content: center;
    border-radius: 50%; border: 1px solid rgba(255,255,255,0.20);
    background: linear-gradient(145deg, rgba(255,255,255,0.16), rgba(255,255,255,0.06));
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.14), 0 12px 28px rgba(5,16,29,0.22);
    transition: .35s ease;
}
.single-offer-item:hover .offer-icon { background: rgba(255,255,255,0.18); border-color: rgba(255,255,255,0.4); transform: scale(1.06); }
.offer-icon img { width: 54px; height: 54px; object-fit: contain; filter: brightness(0) invert(1); transition: .3s; }
.single-offer-item:hover .offer-icon img { transform: scale(1.1); }
.offer-details h3 { max-width: 220px; margin: 12px auto 7px; color: #fff; font-size: 0.98rem; font-weight: 700; line-height: 1.45; letter-spacing: 0.65px; }
.single-offer-item .read-more { display: inline-flex; align-items: center; gap: 5px; margin-top: 9px; color: #a9d2ff; font-size: 0.76rem; font-weight: 600; text-decoration: none; border-bottom: 2px solid transparent; transition: .25s; }
.single-offer-item .read-more:hover { color: #fff; border-bottom-color: #8ac4ff; }
.single-offer-item .read-more i { margin-left: 4px; transition: .25s; }
.single-offer-item .read-more:hover i { transform: translateX(4px); }

@media (max-width: 992px) { .ofer-items { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .ofer-items { grid-template-columns: repeat(2, 1fr); gap: 12px; } .single-offer-item { padding: 22px 10px 18px; border-radius: 18px; } .offer-icon { width: 62px; height: 62px; } .offer-icon img { width: 42px; height: 42px; } .offer-details h3 { font-size: 0.72rem; } }
@media (max-width: 390px) { .ofer-items { grid-template-columns: 1fr; } }

/* ---------- Counter section ---------- */
.counter-section {
    padding: 92px 0; position: relative; overflow: hidden; content-visibility: auto; contain-intrinsic-size: 760px;
    background: linear-gradient(rgba(5,16,29,0.84), rgba(5,16,29,0.90)), url('images/bg/counter-bg.jpg') center / cover no-repeat;
    background-attachment: scroll;
    border-top: 2px solid rgba(32,54,108,0.2); border-bottom: 2px solid rgba(32,54,108,0.2);
}
.counter-section .container { position: relative; z-index: 1; }
.counter-heading { text-align: center; margin-bottom: 52px; }
.counter-heading .section-eyebrow { color: #8ac4ff; margin: 0 auto 10px; justify-content: center; }
.counter-heading h2 { margin: 0; color: #fff; font-size: clamp(1.5rem, 2.4vw, 2.15rem); font-weight: 800; letter-spacing: -1px; }
.counter-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; max-width: 1080px; margin: 0 auto; }
.single-counter-box {
    display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;
    min-height: 230px; padding: 35px 20px; border-radius: 24px;
    border: 1px solid rgba(255,255,255,0.12);
    background: linear-gradient(145deg, rgba(255,255,255,0.11), rgba(255,255,255,0.045));
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.11), 0 18px 45px rgba(0,0,0,0.20);
    transition: transform .5s var(--premium-ease), border-color .4s ease, box-shadow .5s ease, background .4s ease;
}
.single-counter-box:hover {
    border-color: rgba(138,196,255,0.40);
    background: linear-gradient(145deg, rgba(63,120,189,0.24), rgba(255,255,255,0.08));
    box-shadow: 0 28px 65px rgba(0,0,0,0.30);
    transform: translate3d(0,-10px,0) scale(1.018);
}
.counter-icon-wrapper {
    width: 82px; height: 82px; margin-bottom: 14px; display: flex; align-items: center; justify-content: center;
    border-radius: 50%; border: 1px solid rgba(138,196,255,0.24);
    background: linear-gradient(145deg, rgba(138,196,255,0.20), rgba(32,54,108,0.20));
    transition: .4s ease;
}
.single-counter-box:hover .counter-icon-wrapper { background: rgba(32,54,108,0.25); border-color: rgba(32,54,108,0.5); transform: scale(1.05); }
.counter-icon { width: 50px; height: 50px; filter: brightness(0) invert(1); }
.counter-number {
    display: block; margin-bottom: 6px; font-size: clamp(1.8rem, 2.8vw, 2.5rem); font-weight: 800; letter-spacing: 1px;
    background: linear-gradient(135deg, #fff 0%, #8ac4ff 100%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; color: transparent;
}
.single-counter-box h3 { margin-top: 6px; color: #fff; font-size: 0.85rem; font-weight: 600; letter-spacing: 0.8px; text-transform: uppercase; opacity: 0.9; }
.counter-number.animated { animation: counterPop 0.6s var(--premium-ease) forwards; }
@keyframes counterPop { 0% { opacity: 0; transform: scale(0.5); } 50% { opacity: 1; transform: scale(1.1); } 70% { transform: scale(0.95); } 100% { opacity: 1; transform: scale(1); } }

@media (max-width: 992px) { .counter-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; max-width: 600px; } .single-counter-box { min-height: 180px; } }
@media (max-width: 768px) { .counter-section { padding: 70px 0; } }
@media (max-width: 560px) { .counter-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 390px) { .counter-grid { grid-template-columns: 1fr; } }

/* ---------- Partners ---------- */
.logo-section { padding: 92px 0 100px; background: linear-gradient(180deg, #edf3f9 0%, #f8fbfe 100%); }
.logo-section::before {
    content: ''; position: absolute; z-index: -1; bottom: -260px; left: -180px; width: 430px; height: 430px; border-radius: 50%;
    background: radial-gradient(circle, rgba(32,54,108,0.11), transparent 68%); pointer-events: none;
}
.partner-slider-wrapper {
    position: relative; overflow: hidden; padding: 22px 5px 35px;
    -webkit-mask-image: linear-gradient(90deg, transparent 0%, #000 7%, #000 93%, transparent 100%);
    mask-image: linear-gradient(90deg, transparent 0%, #000 7%, #000 93%, transparent 100%);
}
.partner-track { display: flex; gap: 28px; width: max-content; animation: partnerScroll 38s linear infinite; }
.partner-track:hover { animation-play-state: paused; }
.partner-slide {
    flex: 0 0 255px; min-height: 155px; display: flex; align-items: center; justify-content: center;
    padding: 28px 32px; border-radius: 22px; border: 1px solid rgba(32,54,108,0.09);
    background: rgba(255,255,255,0.90); box-shadow: 0 12px 32px rgba(7,21,37,0.08);
    transition: transform .4s var(--premium-ease), box-shadow .4s ease, border-color .4s ease;
}
.partner-slide:hover { border-color: rgba(32,54,108,0.24); box-shadow: 0 22px 50px rgba(32,54,108,0.14); transform: translate3d(0,-7px,0) scale(1.035); }
.partner-slide img { width: 205px; height: 105px; object-fit: contain; filter: grayscale(18%); opacity: 0.9; transition: .4s ease; }
.partner-slide:hover img { filter: grayscale(0%); opacity: 1; transform: scale(1.05); }
@keyframes partnerScroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

.partner-dots { display: flex; justify-content: center; gap: 10px; margin-top: 30px; }
.partner-dots span { width: 12px; height: 12px; border-radius: 50%; background: #c0d0e0; cursor: pointer; transition: .3s ease; display: inline-block; }
.partner-dots span.active { background: #20366C; transform: scale(1.2); width: 30px; border-radius: 6px; }
.partner-dots span:hover { background: #20366C; opacity: 0.7; }

@media (max-width: 992px) { .partner-slide { flex-basis: 200px; padding: 24px 28px; min-height: 125px; } .partner-slide img { width: 170px; height: 85px; } }
@media (max-width: 768px) {
    .logo-section { padding: 40px 0; }
    .partner-slider-wrapper { -webkit-mask-image: linear-gradient(90deg, transparent 0%, #000 3%, #000 97%, transparent 100%); mask-image: linear-gradient(90deg, transparent 0%, #000 3%, #000 97%, transparent 100%); }
}
@media (max-width: 480px) { .partner-slide { flex-basis: 130px; padding: 14px 16px; min-height: 80px; border-radius: 12px; } .partner-slide img { width: 110px; height: 55px; } .partner-track { gap: 14px; } }

/* ---------- Latest events ---------- */
.home-blog-section { padding: 92px 0 110px; background: linear-gradient(180deg, #ffffff 0%, #f5f8fc 100%); }
.home-blog-section::before {
    content: ''; position: absolute; z-index: -1; top: -240px; right: -170px; width: 430px; height: 430px; border-radius: 50%;
    background: radial-gradient(circle, rgba(63,120,189,0.12), transparent 68%); pointer-events: none;
}
.home-events-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 26px; }
.home-event-card {
    display: flex; flex-direction: column; height: 100%; overflow: hidden; border-radius: 24px;
    border: 1px solid rgba(30,144,255,0.14);
    background: linear-gradient(155deg, #10243d 0%, #1A2A3A 66%, #20366C 100%);
    box-shadow: 0 18px 45px rgba(7,21,37,0.13);
    opacity: 0; transform: translate3d(0, 34px, 0) scale(0.97);
    transition: opacity 1.15s var(--premium-ease), transform 1.3s var(--premium-ease), border-color .4s ease, box-shadow .5s ease;
}
.home-event-card:nth-child(1) { transition-delay: .05s; }
.home-event-card:nth-child(2) { transition-delay: .28s; }
.home-event-card:nth-child(3) { transition-delay: .51s; }
.home-event-card.event-visible { opacity: 1; transform: translate3d(0,0,0) scale(1); will-change: auto; }
.home-event-card.event-visible:hover { border-color: rgba(138,196,255,0.42); box-shadow: 0 30px 70px rgba(7,21,37,0.25); transform: translate3d(0,-10px,0) scale(1.018); }
.home-event-image { position: relative; display: block; width: 100%; height: 260px; overflow: hidden; background: #fff; text-decoration: none; }
.home-event-image::after { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, transparent 54%, rgba(5,16,29,0.50) 100%); pointer-events: none; }
.home-event-image img { display: block; width: 100%; height: 100%; object-fit: cover; transform: scale(1); transition: transform .75s var(--premium-ease); }
.home-event-card:hover .home-event-image img { transform: scale(1.05); }
.home-event-content { display: flex; flex: 1; flex-direction: column; padding: 28px 28px 24px; }
.home-event-content h3 { margin: 0 0 12px; color: #fff; font-size: 17px; font-weight: 800; line-height: 1.42; }
.home-event-content h3 a { color: #fff; text-decoration: none; transition: color .25s ease; }
.home-event-content h3 a:hover { color: #6ab0ff; }
.home-event-meta { display: flex; flex-direction: column; gap: 4px; margin: 8px 0 14px; color: #b8d4f0; font-size: 11px; line-height: 1.7; }
.home-event-meta span { display: flex; align-items: center; }
.home-event-meta i { width: 20px; margin-right: 8px; color: #6ab0ff; font-size: 11px; }
.home-event-meta a { color: #b8d4f0; font-size: 11px; text-decoration: none; transition: color .25s ease; }
.home-event-meta a:hover { color: #fff; }
.home-event-excerpt { display: flex; flex: 1; }
.home-event-excerpt p { flex: 1; margin: 0 0 14px; color: #d2e2ef; font-size: 12.5px; line-height: 1.75; }
.home-event-read-more {
    display: inline-flex; align-items: center; align-self: flex-start; margin-top: 6px;
    color: #6ab0ff; font-size: 11px; font-weight: 700; text-decoration: none;
    border-bottom: 2px solid transparent; transition: color .25s ease, border-color .25s ease;
}
.home-event-read-more i { margin-left: 6px; color: #6ab0ff; font-size: 10px; transition: color .25s ease, transform .25s ease; }
.home-event-read-more:hover { border-bottom-color: #6ab0ff; color: #fff; }
.home-event-read-more:hover i { color: #fff; transform: translateX(4px); }

@media (max-width: 992px) { .home-events-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 20px; } .home-event-image { height: 200px; } }
@media (max-width: 768px) {
    .home-blog-section { padding: 40px 0; }
    .home-events-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 16px; }
    .home-event-image { height: 180px; }
    .home-event-content { padding: 18px 18px 16px; }
    .home-event-content h3 { font-size: 13px; }
    .home-event-excerpt p { font-size: 11px; }
    .home-event-card { transform: translate3d(0, 24px, 0) scale(0.98); }
}
@media (max-width: 560px) { .home-events-grid { grid-template-columns: 1fr; max-width: 430px; margin: 0 auto; } .home-event-card { transition-delay: .08s; } .home-event-image { height: 220px; } }
@media (max-width: 480px) { .home-blog-section { padding: 30px 0; } .home-event-image { height: 200px; } .home-event-content { padding: 18px 20px 16px; } }

/* ---------- Footer ---------- */
.footer-inline { position: relative; overflow: hidden; background: linear-gradient(145deg, #122437 0%, #1A2A3A 52%, #102337 100%); color: #8aaccc; padding: 60px 30px 40px; }
.footer-inline::before {
    content: ''; position: absolute; top: -220px; left: 50%; width: 720px; height: 420px; border-radius: 50%;
    background: radial-gradient(circle, rgba(63,120,189,0.13), transparent 68%); transform: translateX(-50%); pointer-events: none;
}
.footer-inline > .container { position: relative; z-index: 1; max-width: none; width: 100%; margin: 0; padding: 0 30px; }
.footer-grid-responsive { display: grid; grid-template-columns: 1.3fr 1fr 1fr 1.35fr 1.2fr; gap: 30px; padding-bottom: 30px; }
.footer-offer-container { display: flex; flex-direction: column; align-items: center; justify-content: flex-start; }
.footer-offer-logo-img { width: 100%; max-width: 300px; height: auto; filter: brightness(0) invert(1); margin-bottom: 20px; }
.footer-social-responsive { display: flex; gap: 10px; }
.footer-social-responsive a {
    width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
    background: rgba(32,54,108,0.15); border: 1px solid rgba(32,54,108,0.2); color: #b8d4f0; text-decoration: none;
    font-size: 1.2rem; transition: .3s;
}
.footer-social-responsive a:hover { background: #1e90ff; color: #fff; border-color: #1e90ff; transform: translateY(-3px); box-shadow: 0 6px 20px rgba(30,144,255,0.3); }
.footer-heading-responsive { color: #fff; font-weight: 700; margin: 0 0 18px; font-size: 1.05rem; letter-spacing: 0.4px; }
.footer-link-responsive { color: #b8d4f0; text-decoration: none; font-size: 0.92rem; display: inline-flex; align-items: center; gap: 10px; transition: .2s; }
.footer-link-responsive:hover { color: #fff; padding-left: 8px; }
.footer-link-responsive i { font-size: 0.7rem; color: #6ab0ff; }
.footer-link-item { margin: 10px 0; list-style: none; }
.footer-contact-responsive { color: #b8d4f0; font-size: 0.92rem; margin-bottom: 12px; list-style: none; display: flex; align-items: flex-start; gap: 12px; line-height: 1.5; }
.footer-contact-responsive i { color: #6ab0ff; width: 18px; font-size: 0.9rem; margin-top: 3px; flex-shrink: 0; }
.footer-great-text { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
.footer-great-logo-img { width: 100%; max-width: 100px; height: auto; }
.footer-great-text p { color: #b8d4f0; font-size: 0.82rem; margin-top: 12px; opacity: 0.8; }
.footer-bottom-responsive { border-top: 1px solid rgba(32,54,108,0.15); padding-top: 22px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; font-size: 0.85rem; color: #6a8aaa; }
.footer-bottom-links-responsive { display: flex; gap: 15px; align-items: center; }
.footer-bottom-links-responsive a { color: #6a8aaa; text-decoration: none; font-size: 0.85rem; transition: .2s; }
.footer-bottom-links-responsive a:hover { color: #fff; }

@media (max-width: 992px) { .footer-grid-responsive { grid-template-columns: 1fr 1fr; gap: 30px; } .footer-heading-responsive { font-size: 1rem; } .footer-link-responsive, .footer-contact-responsive { font-size: 0.88rem; } .footer-great-logo-img { max-width: 180px; } .footer-offer-logo-img { max-width: 160px; } }
@media (max-width: 768px) {
    .footer-grid-responsive { grid-template-columns: 1fr; gap: 24px; text-align: center; }
    .footer-social-responsive, .footer-contact-responsive { justify-content: center; }
    .footer-bottom-responsive, .footer-bottom-links-responsive { flex-direction: column; text-align: center; }
    .footer-bottom-links-responsive { flex-direction: row; flex-wrap: wrap; justify-content: center; }
    .footer-great-logo-img, .footer-offer-logo-img { max-width: 150px; margin: 0 auto; }
}
@media (max-width: 480px) {
    .footer-heading-responsive { font-size: 0.95rem; margin-bottom: 12px; }
    .footer-link-responsive, .footer-contact-responsive { font-size: 0.82rem; }
    .footer-link-item { margin: 6px 0; }
    .footer-social-responsive a { width: 38px; height: 38px; font-size: 1rem; }
    .footer-bottom-text { font-size: 0.78rem; }
    .footer-great-logo-img { max-width: 120px; }
    .footer-offer-logo-img { max-width: 110px; }
}

/* ---------- Perf: let the browser skip work off-screen / respect motion prefs ---------- */
@media (max-width: 992px), (hover: none), (pointer: coarse) {
    .partner-track { animation-duration: 60s; }
    .single-offer-item, .single-counter-box, .partner-slide, .home-event-card { box-shadow: 0 6px 20px rgba(7,21,37,0.10); }
}
@media (prefers-reduced-motion: reduce) {
    .video-banner-container video, .hero-content, .hero-scroll-cue, .premium-reveal,
    .single-offer-item, .single-counter-box, .partner-slide, .home-event-card,
    .gmi-slogan-bar .gmi-part, .gmi-slogan-bar .gmi-separator,
    #loader img, .gmi-custom-header, .gmi-header-left .logo-img, .gmi-hamburger span {
        animation: none !important; transition: none !important; transform: none !important; opacity: 1 !important;
    }
}


/* =========================================================
   PROTECTED SHARED SITE LOADER
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
    animation: gmiProtectedLoaderRing 2.35s cubic-bezier(.22, 1, .36, 1) infinite;
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
    animation: gmiProtectedLoaderPulse 2.25s ease-in-out infinite !important;
    will-change: transform, opacity;
}

@keyframes gmiProtectedLoaderPulse {
    0%, 100% { opacity: .68; transform: scale(.95); }
    50% { opacity: 1; transform: scale(1.055); }
}

@keyframes gmiProtectedLoaderRing {
    0% { opacity: 0; transform: scale(.72); }
    42% { opacity: .72; }
    100% { opacity: 0; transform: scale(1.12); }
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
        <a href="/" class="gmi-current">Home</a>
        <a href="about-us.php">About Us</a>
        <a href="services.php">Services</a>
        <a href="companies.php">Companies</a>
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
        <a href="companies.php">Companies</a>
        <a href="events.php">Events</a>
        <a href="careers.php">Careers</a>
        <a href="contact-us.php">Contact Us</a>
    </nav>
</header>

<section class="main-banner" id="top">
    <div class="video-banner-container">
        <video autoplay muted loop playsinline id="bg-video" preload="metadata" poster="images/bg/counter-bg.jpg">
            <source src="images/video/clip2.mp4" type="video/mp4" />
        </video>
        <img class="hero-eagle" src="images/logo/global_eagle.png" alt="" decoding="async" loading="eager" fetchpriority="high" />
        <div class="hero-scrim"></div>
        <div class="hero-content">
            <div class="hero-eyebrow"><i class="fas fa-anchor"></i> Sri Lanka's Trusted Maritime Group</div>
            <h1>Global Reach, Local <span>Expertise</span></h1>
            <p>From liner shipping and NVOCC operations to port agency and marine technical services &mdash; we keep the world's cargo moving, safely and on time.</p>
            <div class="hero-cta-group">
                <a href="services.php" class="hero-btn-primary">Explore Our Services <i class="fas fa-arrow-right"></i></a>
                <a href="contact-us.php" class="hero-btn-secondary"><i class="fas fa-phone"></i> Talk to Our Team</a>
            </div>
        </div>
        <div class="hero-scroll-cue">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </div>
</section>

<div class="gmi-slogan-bar">
    <div class="gmi-slogan-text">
        <span class="gmi-part gmi-part-1">Connected by Sea</span>
        <span class="gmi-separator">&middot;</span>
        <span class="gmi-part gmi-part-2">Driven by Expertise</span>
    </div>
</div>

<div class="gmi-wave-divider">
    <svg viewBox="0 0 1440 46" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,16 C240,46 480,0 720,14 C960,28 1200,44 1440,10 L1440,46 L0,46 Z" fill="#ffffff"></path>
    </svg>
</div>

<section class="section offer-section-three">
    <div class="container">
        <div class="section-heading">
            <div class="section-eyebrow"><i class="fas fa-ship"></i> What We Do</div>
            <h1>Our Business Segments</h1>
        </div>
        <div class="ofer-items">
            <div class="single-offer-item">
                <div class="offer-icon"><img src="images/segments/offer-round-one.png" alt="Liner Shipping" decoding="async" loading="lazy" /></div>
                <div class="offer-details"><h3>LINER SHIPPING</h3></div>
                <a href="https://www.samudera.id/" target="_blank" class="read-more">read more <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="single-offer-item">
                <div class="offer-icon"><img src="images/segments/offer-round-two.png" alt="NVOCC" decoding="async" loading="lazy" /></div>
                <div class="offer-details"><h3>NVOCC</h3></div>
                <a href="https://www.cordelialine.com/" target="_blank" class="read-more">read more <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="single-offer-item">
                <div class="offer-icon"><img src="images/segments/offer-round-five.png" alt="Freight Forwarding & Logistics" decoding="async" loading="lazy" /></div>
                <div class="offer-details"><h3>FREIGHT FORWARDING &amp; LOGISTICS</h3></div>
                <a href="freight-forwarding-and-logistics.php" class="read-more">read more <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="single-offer-item">
                <div class="offer-icon"><img src="images/segments/offer-round-four.png" alt="Port Agency Services" decoding="async" loading="lazy" /></div>
                <div class="offer-details"><h3>PORT AGENCY SERVICES</h3></div>
                <a href="port-agency-services.php" class="read-more">read more <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="single-offer-item">
                <div class="offer-icon"><img src="images/segments/offer-round-three.png" alt="Marine Technical Services" decoding="async" loading="lazy" /></div>
                <div class="offer-details"><h3>MARINE TECHNICAL SERVICES</h3></div>
                <a href="marine-technical-services.php" class="read-more">read more <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="single-offer-item">
                <div class="offer-icon"><img src="images/segments/offer-round-six.png" alt="Foreign Employment Agency" decoding="async" loading="lazy" /></div>
                <div class="offer-details"><h3>FOREIGN EMPLOYMENT AGENCY</h3></div>
                <a href="foreign-employment-agency.php" class="read-more">read more <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="single-offer-item">
                <div class="offer-icon"><img src="images/segments/offer-round-7.png" alt="Seafarer Recruitment & Placement" decoding="async" loading="lazy" /></div>
                <div class="offer-details"><h3>SEAFARER RECRUITMENT &amp; PLACEMENT</h3></div>
                <a href="https://globalmarineservices.lk/" target="_blank" class="read-more">read more <i class="fa fa-angle-double-right"></i></a>
            </div>
            <div class="single-offer-item">
                <div class="offer-icon"><img src="images/segments/offer-round-9.png" alt="Education & Training" decoding="async" loading="lazy" /></div>
                <div class="offer-details"><h3>EDUCATION &amp; TRAINING</h3></div>
                <a href="#" class="read-more">read more <i class="fa fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="section counter-section" id="counter-section">
    <div class="container">
        <div class="counter-heading">
            <div class="section-eyebrow"><i class="fas fa-chart-line"></i> By The Numbers</div>
            <h2>A Legacy Built On Scale &amp; Trust</h2>
        </div>
        <div class="counter-grid">
            <div class="single-counter-box">
                <div class="counter-icon-wrapper"><img src="images/icons/tue.png" alt="TEU" class="counter-icon" decoding="async" loading="lazy" /></div>
                <span class="counter-number" data-count="621374">0</span>
                <h3>TEU'S Handled Per Year</h3>
            </div>
            <div class="single-counter-box">
                <div class="counter-icon-wrapper"><img src="images/icons/cus.png" alt="Customers" class="counter-icon" decoding="async" loading="lazy" /></div>
                <span class="counter-number" data-count="304">0</span>
                <h3>Customer Base</h3>
            </div>
            <div class="single-counter-box">
                <div class="counter-icon-wrapper"><img src="images/icons/for.png" alt="Partnerships" class="counter-icon" decoding="async" loading="lazy" /></div>
                <span class="counter-number" data-count="17">0</span>
                <h3>Foreign Partnerships</h3>
            </div>
            <div class="single-counter-box">
                <div class="counter-icon-wrapper"><img src="images/icons/tra.png" alt="Trained" class="counter-icon" decoding="async" loading="lazy" /></div>
                <span class="counter-number" data-count="2417">0</span>
                <h3>Personnel Trained Per Year</h3>
            </div>
        </div>
    </div>
</section>

<section class="section logo-section">
    <div class="container">
        <div class="section-heading">
            <div class="section-eyebrow"><i class="fas fa-handshake"></i> Our Network</div>
            <h1>Our Business Partners</h1>
        </div>
        <div class="partner-slider-wrapper">
            <div class="partner-track" id="partnerTrack">
                <div class="partner-slide"><img src="images/partness/GFSSM-n.png" alt="GFSSM" decoding="async" loading="lazy" /></div>
                <div class="partner-slide"><img src="images/partness/SEASPAN-n.png" alt="Seaspan" decoding="async" loading="lazy" /></div>
                <div class="partner-slide"><img src="images/partness/eastern.png" alt="Eastern" decoding="async" loading="lazy" /></div>
                <div class="partner-slide"><img src="images/partness/Cordelia-n.png" alt="Cordelia" decoding="async" loading="lazy" /></div>
                <div class="partner-slide"><img src="images/partness/Global Feeder Shipping-n.png" alt="Global Feeder" decoding="async" loading="lazy" /></div>
                <div class="partner-slide"><img src="images/partness/KSA-n.png" alt="KSA" decoding="async" loading="lazy" /></div>
                <div class="partner-slide"><img src="images/partness/Phoenix Containers-n.png" alt="Phoenix" decoding="async" loading="lazy" /></div>
                <div class="partner-slide"><img src="images/partness/Resort World Cruises-n.png" alt="Resort World" decoding="async" loading="lazy" /></div>
                <div class="partner-slide"><img src="images/partness/Samudera-n.png" alt="Samudera" decoding="async" loading="lazy" /></div>
                <!-- duplicate set: seamless marquee loop -->
                <div class="partner-slide" aria-hidden="true"><img src="images/partness/GFSSM-n.png" alt="" decoding="async" loading="lazy" /></div>
                <div class="partner-slide" aria-hidden="true"><img src="images/partness/SEASPAN-n.png" alt="" decoding="async" loading="lazy" /></div>
                <div class="partner-slide" aria-hidden="true"><img src="images/partness/eastern.png" alt="" decoding="async" loading="lazy" /></div>
                <div class="partner-slide" aria-hidden="true"><img src="images/partness/Cordelia-n.png" alt="" decoding="async" loading="lazy" /></div>
                <div class="partner-slide" aria-hidden="true"><img src="images/partness/Global Feeder Shipping-n.png" alt="" decoding="async" loading="lazy" /></div>
                <div class="partner-slide" aria-hidden="true"><img src="images/partness/KSA-n.png" alt="" decoding="async" loading="lazy" /></div>
                <div class="partner-slide" aria-hidden="true"><img src="images/partness/Phoenix Containers-n.png" alt="" decoding="async" loading="lazy" /></div>
                <div class="partner-slide" aria-hidden="true"><img src="images/partness/Resort World Cruises-n.png" alt="" decoding="async" loading="lazy" /></div>
                <div class="partner-slide" aria-hidden="true"><img src="images/partness/Samudera-n.png" alt="" decoding="async" loading="lazy" /></div>
            </div>
        </div>
        <div class="partner-dots">
            <span class="active"></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
        </div>
    </div>
</section>

<section class="section home-blog-section">
    <div class="container">
        <div class="section-heading">
            <div class="section-eyebrow"><i class="fas fa-calendar-check"></i> News &amp; Events</div>
            <h1>Latest Events</h1>
        </div>

        <div class="home-events-grid">
            <article class="home-event-card">
                <a href="events-gmg-avurudu-celebration-2026.php" class="home-event-image" aria-label="View GMG Avurudu Celebration 2026">
                    <img src="images/events/gmg-avurudu-celebration-2026/main.jpg" alt="GMG Avurudu Celebration 2026" decoding="async" loading="lazy">
                </a>
                <div class="home-event-content">
                    <h3><a href="events-gmg-avurudu-celebration-2026.php">GMG Avurudu Celebration 2026</a></h3>
                    <div class="home-event-meta">
                        <span><i class="fas fa-calendar-alt"></i> 16 April 2026</span>
                        <span><i class="fas fa-user"></i> <a href="https://gmigroup.lk/">Global Marine Group</a></span>
                    </div>
                    <div class="home-event-excerpt">
                        <p>Global Marine Group proudly celebrates the spirit of unity, culture, and new beginnings this Sinhala and Tamil New Year.</p>
                    </div>
                    <a href="events-gmg-avurudu-celebration-2026.php" class="home-event-read-more">Read More <i class="fas fa-angle-double-right"></i></a>
                </div>
            </article>

            <article class="home-event-card">
                <a href="events-slana-battle-of-the nvoccs-2026.php" class="home-event-image" aria-label="View SLANA Battle of the NVOCCs 2026">
                    <img src="images/events/slana-battle-of-the nvoccs-2026/main.jpg" alt="SLANA Battle of the NVOCCs 2026" decoding="async" loading="lazy">
                </a>
                <div class="home-event-content">
                    <h3><a href="events-slana-battle-of-the nvoccs-2026.php">SLANA Battle of the NVOCCs 2026</a></h3>
                    <div class="home-event-meta">
                        <span><i class="fas fa-calendar-alt"></i> 21 March 2026</span>
                        <span><i class="fas fa-user"></i> <a href="https://gmigroup.lk/">Global Marine Group</a></span>
                    </div>
                    <div class="home-event-excerpt">
                        <p>Cordelia Container Line Lanka, a member of Global Marine Group, took part in the SLANA Battle of the NVOCCs and showcased strong teamwork and competitive spirit.</p>
                    </div>
                    <a href="events-slana-battle-of-the nvoccs-2026.php" class="home-event-read-more">Read More <i class="fas fa-angle-double-right"></i></a>
                </div>
            </article>

            <article class="home-event-card">
                <a href="events-casa-sixes.php" class="home-event-image" aria-label="View CASA Sixes 2026">
                    <img src="images/events/casa-sixes-2026/main.jpg" alt="CASA Sixes 2026" decoding="async" loading="lazy">
                </a>
                <div class="home-event-content">
                    <h3><a href="events-casa-sixes.php">CASA Sixes 2026</a></h3>
                    <div class="home-event-meta">
                        <span><i class="fas fa-calendar-alt"></i> 21 February 2026</span>
                        <span><i class="fas fa-user"></i> <a href="https://gmigroup.lk/">Global Marine Group</a></span>
                    </div>
                    <div class="home-event-excerpt">
                        <p>Global Marine Group participated in CASA Sixes 2026, celebrating sportsmanship, collaboration, and team spirit.</p>
                    </div>
                    <a href="events-casa-sixes.php" class="home-event-read-more">Read More <i class="fas fa-angle-double-right"></i></a>
                </div>
            </article>
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
    var heroVideo = doc.getElementById('bg-video');
    var partnerTrack = doc.getElementById('partnerTrack');
    var loader = doc.getElementById('loader-wrapper');
    var loaderStartedAt = window.performance && performance.now ? performance.now() : Date.now();
    var minimumLoaderTime = 1100;
    var loaderFinished = false;
    var scrollFrame = 0;
    var resizeFrame = 0;

    function syncHeaderOffset() {
        if (!header || !body) return;
        body.style.paddingTop = header.getBoundingClientRect().height + 'px';
    }

    function updateScrollProgress() {
        scrollFrame = 0;
        var scrollTop = window.scrollY || root.scrollTop || 0;
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
        if (!scrollFrame) scrollFrame = window.requestAnimationFrame(updateScrollProgress);
    }

    function requestResizeUpdate() {
        if (resizeFrame) window.cancelAnimationFrame(resizeFrame);
        resizeFrame = window.requestAnimationFrame(function () {
            resizeFrame = 0;
            syncHeaderOffset();
            updateScrollProgress();
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

    window.addEventListener('scroll', requestScrollUpdate, { passive: true });
    window.addEventListener('resize', requestResizeUpdate, { passive: true });
    window.addEventListener('orientationchange', requestResizeUpdate, { passive: true });

    if ('ResizeObserver' in window && header) {
        new ResizeObserver(requestResizeUpdate).observe(header);
    }

    function animateCounter(element) {
        var target = Number(element.getAttribute('data-count')) || 0;
        var duration = 1200;
        var startedAt = performance.now();
        var formatter = new Intl.NumberFormat();
        element.classList.add('animated');

        function step(now) {
            var elapsed = Math.min(1, (now - startedAt) / duration);
            var eased = 1 - Math.pow(1 - elapsed, 3);
            element.textContent = formatter.format(Math.round(target * eased));
            if (elapsed < 1) window.requestAnimationFrame(step);
        }
        window.requestAnimationFrame(step);
    }

    var revealGroups = [
        '.offer-section-three .section-heading',
        '.single-offer-item',
        '.counter-heading',
        '.single-counter-box',
        '.logo-section .section-heading',
        '.partner-slider-wrapper',
        '.home-blog-section .section-heading'
    ];

    doc.querySelectorAll(revealGroups.join(',')).forEach(function (element, index) {
        element.classList.add('premium-reveal');
        element.style.setProperty('--premium-delay', Math.min(index % 8, 7) * 55 + 'ms');
    });

    var observedItems = doc.querySelectorAll('.section, .footer-inline, .home-event-card, .premium-reveal, .counter-number');

    function revealImmediately() {
        observedItems.forEach(function (element) {
            if (element.classList.contains('counter-number')) animateCounter(element);
            else if (element.classList.contains('home-event-card')) element.classList.add('event-visible');
            else if (element.classList.contains('premium-reveal')) element.classList.add('premium-visible');
            else element.classList.add('visible');
        });
    }

    if (!('IntersectionObserver' in window)) {
        revealImmediately();
    } else {
        var revealObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var element = entry.target;
                if (element.classList.contains('counter-number')) animateCounter(element);
                else if (element.classList.contains('home-event-card')) element.classList.add('event-visible');
                else if (element.classList.contains('premium-reveal')) element.classList.add('premium-visible');
                else element.classList.add('visible');
                observer.unobserve(element);
            });
        }, { threshold: 0.10, rootMargin: '100px 0px -5% 0px' });

        observedItems.forEach(function (element) { revealObserver.observe(element); });

        var heroObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!heroVideo) return;
                if (entry.isIntersecting) {
                    var p = heroVideo.play();
                    if (p && typeof p.catch === 'function') p.catch(function () {});
                } else {
                    heroVideo.pause();
                }
            });
        }, { threshold: 0.05 });

        var heroSection = doc.querySelector('.video-banner-container');
        if (heroSection && heroVideo) heroObserver.observe(heroSection);

        var partnerObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (partnerTrack) partnerTrack.style.animationPlayState = entry.isIntersecting ? 'running' : 'paused';
            });
        }, { threshold: 0.01 });

        var partnerSection = doc.querySelector('.logo-section');
        if (partnerSection && partnerTrack) partnerObserver.observe(partnerSection);
    }

    doc.addEventListener('visibilitychange', function () {
        if (doc.hidden) {
            if (heroVideo) heroVideo.pause();
            if (partnerTrack) partnerTrack.style.animationPlayState = 'paused';
        }
    });

    function currentTime() {
        return window.performance && performance.now ? performance.now() : Date.now();
    }

    function completeLoader() {
        if (loaderFinished) return;
        loaderFinished = true;

        if (loader) loader.classList.add('gmi-loaded');
        body.classList.remove('gmi-loading');
        root.classList.remove('gmi-loading-root');
        root.style.background = '';
        body.classList.add('premium-ready');
        syncHeaderOffset();
        updateScrollProgress();

        window.setTimeout(function () {
            if (loader && loader.parentNode) loader.parentNode.removeChild(loader);
        }, 900);
    }

    function hideLoader() {
        var elapsed = currentTime() - loaderStartedAt;
        var remaining = Math.max(0, minimumLoaderTime - elapsed);
        window.setTimeout(completeLoader, remaining);
    }

    if (doc.readyState === 'complete') {
        hideLoader();
    } else {
        window.addEventListener('load', hideLoader, { once: true });
        doc.addEventListener('DOMContentLoaded', function () {
            syncHeaderOffset();
            updateScrollProgress();
        }, { once: true });
    }

    window.setTimeout(completeLoader, 7000);
})();
</script>

</body>
</html>