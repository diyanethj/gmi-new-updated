<?php
$eventTitle = (string) $event['name'];
$eventDate = format_event_date((string) $event['event_date']);
$eventTime = trim((string) ($event['event_time'] ?? '')) !== '' ? (string) $event['event_time'] : 'Time not specified';
$eventAuthor = (string) $event['company'];
$eventDescription = description_paragraphs((string) $event['description']);
$mainImage = asset_url((string) $event['main_image']);
$galleryImages = array_map(static fn(array $image): string => asset_url((string) $image['image_path']), $event['images'] ?? []);
$slideshowImages = array_merge([$mainImage], $galleryImages);
?>
<!DOCTYPE html>
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
    <meta name="title" content="<?php echo e($eventTitle); ?> - Global Marine Group">
    <meta name="description" content="<?php echo e($eventDescription[0] ?? $eventTitle); ?>">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Global Marine Group">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo e($eventTitle); ?> - Global Marine Group</title>

    <link rel="shortcut icon" type="image/x-icon" href="images/logo/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preload" as="image" href="<?php echo e($mainImage); ?>" fetchpriority="high">
    <script>document.documentElement.classList.remove('no-js');document.documentElement.classList.add('js');</script>

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
    font-family: 'EB Garamond', Georgia, 'Times New Roman', serif;
    -webkit-font-smoothing: antialiased;
}
::selection { color: #fff; background: #20366C; }
img { max-width: 100%; }
button, a { -webkit-tap-highlight-color: transparent; }
.fa, .fas, .far, .fal, .fab { line-height: 1; }
.container { width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 30px; }

/* Loader */
html.gmi-loading-root,
body.gmi-loading { background: #071525 !important; }
body.gmi-loading { overflow: hidden !important; }
#loader-wrapper {
    position: fixed !important;
    inset: 0 !important;
    z-index: 2147483647 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100vw !important;
    height: 100vh !important;
    background: #071525 !important;
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: all !important;
    transition: opacity .78s cubic-bezier(.22,1,.36,1), visibility .78s ease !important;
}
#loader-wrapper.gmi-loaded { opacity: 0 !important; visibility: hidden !important; pointer-events: none !important; }
#loader { position: relative; display: flex; align-items: center; justify-content: center; width: 210px; height: 210px; }
#loader::before,
#loader::after {
    content: '';
    position: absolute;
    inset: 12px;
    border: 1px solid rgba(138,196,255,.26);
    border-radius: 50%;
    animation: gmiLoaderRing 2.35s cubic-bezier(.22,1,.36,1) infinite;
}
#loader::after { inset: 35px; border-color: rgba(138,196,255,.14); animation-delay: .38s; }
#loader img {
    position: relative;
    z-index: 2;
    display: block;
    width: 130px;
    height: auto;
    filter: drop-shadow(0 0 30px rgba(138,196,255,.34));
    animation: gmiLoaderPulse 2.25s ease-in-out infinite;
}
@keyframes gmiLoaderPulse { 0%,100% { opacity:.68; transform:scale(.95); } 50% { opacity:1; transform:scale(1.055); } }
@keyframes gmiLoaderRing { 0% { opacity:0; transform:scale(.72); } 42% { opacity:.72; } 100% { opacity:0; transform:scale(1.12); } }

/* Scroll progress */
.gmi-progress-bar {
    position: fixed; top: 0; left: 0; z-index: 100000;
    width: 100%; height: 4px;
    background: linear-gradient(90deg, #20366C 0%, #2a4a8a 50%, #1e90ff 100%);
    transform: scaleX(0); transform-origin: left center; will-change: transform;
}

/* Header — matches events.php */
.gmi-custom-header {
    position: fixed; top: 0; left: 0; z-index: 9999;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;
    width: 100%; min-height: 88px; padding: 14px 30px;
    border-bottom: 1px solid transparent;
    background: #fff; box-shadow: 0 2px 16px rgba(0,0,0,.10);
    transition: min-height .42s var(--premium-ease), padding .42s var(--premium-ease), border-color .32s ease, background .32s ease, box-shadow .42s ease;
}
.gmi-custom-header.gmi-header-scrolled {
    min-height: 68px; padding-top: 8px; padding-bottom: 8px;
    border-bottom-color: rgba(32,54,108,.12);
    background: rgba(255,255,255,.98);
    box-shadow: 0 14px 38px rgba(7,21,37,.14);
}
.gmi-header-left { display: flex; align-items: center; gap: 20px; }
.gmi-logo-link { display: inline-flex; align-items: center; line-height: 0; text-decoration: none; }
.gmi-header-left .logo-img { max-height: 60px; width: auto; transition: max-height .42s var(--premium-ease), transform .42s var(--premium-ease); }
.gmi-custom-header.gmi-header-scrolled .logo-img { max-height: 44px; }
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
.gmi-hamburger span { display: block; width: 30px; height: 3.5px; border-radius: 4px; background: #0a1a2b; transition: transform .32s var(--premium-ease), opacity .22s ease; }
.gmi-hamburger.is-open span:nth-child(1) { transform: translateY(8.5px) rotate(45deg); }
.gmi-hamburger.is-open span:nth-child(2) { opacity: 0; }
.gmi-hamburger.is-open span:nth-child(3) { transform: translateY(-8.5px) rotate(-45deg); }
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
    background: url('https://images.pexels.com/photos/8761325/pexels-photo-8761325.jpeg?auto=compress&cs=tinysrgb&w=1920&h=900&fit=crop') center 42% / cover no-repeat;
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


/* Event details */
.event-details-section,
.event-gallery-section {
    position: relative; overflow: hidden; isolation: isolate;
    background: linear-gradient(180deg, #fff 0%, #f4f8fc 100%);
}
.event-details-section { padding: 92px 0 44px; }
.event-gallery-section { padding: 44px 0 105px; }
.event-details-section::before,
.event-details-section::after,
.event-gallery-section::after {
    content: ''; position: absolute; z-index: -1; width: 440px; height: 440px; border-radius: 50%; pointer-events: none;
}
.event-details-section::before { top: -250px; right: -185px; background: radial-gradient(circle, rgba(63,120,189,.13), transparent 68%); }
.event-details-section::after { bottom: -300px; left: -220px; background: radial-gradient(circle, rgba(32,54,108,.09), transparent 68%); }
.event-gallery-section::after { bottom: -280px; right: -210px; background: radial-gradient(circle, rgba(32,54,108,.10), transparent 68%); }
.event-details-grid { display: grid; grid-template-columns: minmax(0, 1.23fr) minmax(340px, .77fr); gap: 26px; align-items: stretch; }
.event-main-button {
    position: relative; display: block; width: 100%; min-height: 520px; padding: 0; overflow: hidden;
    border: 1px solid rgba(32,54,108,.10); border-radius: 24px; background: #eaf0f5;
    box-shadow: 0 16px 40px rgba(7,21,37,.13); cursor: zoom-in;
}
.event-main-button::after { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, transparent 52%, rgba(5,16,29,.52) 100%); pointer-events: none; }
.event-main-button img { display: block; width: 100%; height: 100%; min-height: 520px; object-fit: cover; transition: transform .7s var(--premium-ease); }
.event-main-button:hover img, .event-main-button:focus-visible img { transform: scale(1.045); }
.event-main-view {
    position: absolute; right: 22px; bottom: 22px; z-index: 2; display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 15px; border: 1px solid rgba(255,255,255,.28); border-radius: 999px;
    color: #fff; background: rgba(7,21,37,.80); font-size: 11px; font-weight: 700; box-shadow: 0 10px 28px rgba(0,0,0,.22);
}
.event-info-card {
    position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: center; padding: 34px;
    border: 1px solid rgba(138,196,255,.15); border-radius: 24px;
    background: linear-gradient(155deg, #10243d 0%, #1A2A3A 66%, #20366C 100%);
    box-shadow: 0 16px 40px rgba(7,21,37,.18); color: #fff;
}
.event-info-card::before { content: ''; position: absolute; top: -160px; right: -150px; width: 330px; height: 330px; border-radius: 50%; background: radial-gradient(circle, rgba(138,196,255,.18), transparent 68%); pointer-events: none; }
.event-eyebrow { position: relative; z-index: 1; display: inline-flex; align-items: center; gap: 8px; align-self: flex-start; margin-bottom: 13px; color: #9dc9ff; font-size: .72rem; font-weight: 700; letter-spacing: 2.2px; text-transform: uppercase; }
.event-eyebrow::before { content: ''; width: 24px; height: 2px; border-radius: 2px; background: linear-gradient(90deg,#8ac4ff,#2a4a8a); }
.event-info-card h1 { position: relative; z-index: 1; margin: 0 0 20px; color: #fff; font-size: clamp(1.65rem, 2.6vw, 2.45rem); font-weight: 800; line-height: 1.2; letter-spacing: -.9px; }
.event-meta-grid { position: relative; z-index: 1; display: grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap: 10px; margin-bottom: 22px; }
.event-meta-item { display: flex; align-items: center; gap: 10px; min-width: 0; padding: 12px; border: 1px solid rgba(138,196,255,.14); border-radius: 14px; background: rgba(255,255,255,.06); }
.event-meta-icon { display: inline-flex; align-items: center; justify-content: center; flex: 0 0 36px; width: 36px; height: 36px; border-radius: 50%; color: #fff; background: rgba(138,196,255,.13); box-shadow: inset 0 0 0 1px rgba(255,255,255,.08); }
.event-meta-copy { min-width: 0; }
.event-meta-copy small { display: block; margin-bottom: 2px; color: #8ac4ff; font-size: 9px; font-weight: 700; letter-spacing: .8px; text-transform: uppercase; }
.event-meta-copy strong { display: block; overflow-wrap: anywhere; color: #fff; font-size: 11px; font-weight: 700; line-height: 1.4; }
.event-description { position: relative; z-index: 1; }
.event-description p { margin: 0 0 12px; color: #d2e2ef; font-size: 13px; line-height: 1.8; }
.event-description p:last-child { margin-bottom: 0; }
.event-back-link { position: relative; z-index: 1; display: inline-flex; align-items: center; gap: 8px; align-self: flex-start; margin-top: 23px; padding-bottom: 3px; border-bottom: 2px solid transparent; color: #8ac4ff; font-size: 11px; font-weight: 700; text-decoration: none; transition: color .25s ease, border-color .25s ease; }
.event-back-link:hover { color: #fff; border-bottom-color: #8ac4ff; }

.section-heading { text-align: center; margin-bottom: 48px; }
.section-eyebrow { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px; color: #20366C; font-size: .76rem; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; }
.section-eyebrow::before, .section-eyebrow::after { content: ''; width: 24px; height: 2px; border-radius: 2px; background: var(--gmi-blue-gradient); }
.section-heading h2 { margin: 0; color: #0a1a2b; font-size: clamp(2rem, 3.4vw, 3rem); font-weight: 800; line-height: 1.1; letter-spacing: -1.4px; }
.section-heading p { max-width: 720px; margin: 15px auto 0; color: #5b6876; font-size: .95rem; line-height: 1.75; }
.event-gallery-grid { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 26px; }
.event-gallery-button {
    position: relative; display: block; width: 100%; aspect-ratio: 4/3; padding: 0; overflow: hidden;
    border: 1px solid rgba(138,196,255,.15); border-radius: 24px;
    background: linear-gradient(155deg, #10243d 0%, #1A2A3A 66%, #20366C 100%);
    box-shadow: 0 16px 40px rgba(7,21,37,.13); cursor: zoom-in;
    opacity: 1; transform: none;
    transition: opacity .70s var(--premium-ease), transform .80s var(--premium-ease), border-color .35s ease, box-shadow .4s ease;
}
.js .event-gallery-button { opacity: 0; transform: translate3d(0,22px,0) scale(.988); }
.js .event-gallery-button.card-visible { opacity: 1; transform: translate3d(0,0,0) scale(1); }
.event-gallery-button.card-visible:hover { border-color: rgba(138,196,255,.40); box-shadow: 0 24px 58px rgba(7,21,37,.22); transform: translate3d(0,-7px,0) scale(1.01); }
.event-gallery-button::after { content: '\f00e'; position: absolute; right: 16px; bottom: 16px; z-index: 2; display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 50%; color: #fff; background: rgba(7,21,37,.84); box-shadow: 0 10px 24px rgba(0,0,0,.25); font-family: 'Font Awesome 6 Free'; font-size: 12px; font-weight: 900; opacity: 0; transform: translateY(8px) scale(.94); transition: opacity .25s ease, transform .3s var(--premium-ease); }
.event-gallery-button:hover::after, .event-gallery-button:focus-visible::after { opacity: 1; transform: translateY(0) scale(1); }
.event-gallery-button img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform .55s var(--premium-ease); }
.event-gallery-button:hover img { transform: scale(1.045); }

/* Lightbox */
body.event-modal-open { overflow: hidden !important; }
.event-lightbox { position: fixed; inset: 0; z-index: 200000; display: flex; align-items: center; justify-content: center; padding: 70px 90px; background: rgba(4,14,26,.96); opacity: 0; visibility: hidden; pointer-events: none; transition: opacity .35s ease, visibility .35s ease; }
.event-lightbox.is-open { opacity: 1; visibility: visible; pointer-events: auto; }
.event-lightbox-stage { position: relative; display: flex; align-items: center; justify-content: center; width: min(1200px,100%); height: min(78vh,820px); transform: scale(.97); transition: transform .45s var(--premium-ease); }
.event-lightbox.is-open .event-lightbox-stage { transform: scale(1); }
.event-lightbox-image { display: block; max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 16px; box-shadow: 0 24px 80px rgba(0,0,0,.46); transition: opacity .18s ease, transform .18s ease; }
.event-lightbox-image.is-changing { opacity: .25; transform: scale(.985); }
.event-lightbox-close,
.event-lightbox-nav { position: absolute; z-index: 3; display: inline-flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,.20); border-radius: 50%; color: #fff; background: rgba(255,255,255,.08); cursor: pointer; transition: background .25s ease, transform .25s ease; }
.event-lightbox-close:hover, .event-lightbox-nav:hover { background: #20366C; transform: scale(1.06); }
.event-lightbox-close { top: 24px; right: 28px; width: 46px; height: 46px; font-size: 17px; }
.event-lightbox-nav { top: 50%; width: 52px; height: 52px; font-size: 17px; transform: translateY(-50%); }
.event-lightbox-nav:hover { transform: translateY(-50%) scale(1.06); }
.event-lightbox-prev { left: 24px; }
.event-lightbox-next { right: 24px; }
.event-lightbox-counter { position: absolute; left: 50%; bottom: 24px; z-index: 3; padding: 8px 14px; border: 1px solid rgba(255,255,255,.16); border-radius: 999px; color: #d6e6f5; background: rgba(7,21,37,.72); font-size: 11px; font-weight: 700; transform: translateX(-50%); }

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
    .gmi-custom-header, .gmi-custom-header.gmi-header-scrolled { min-height: 72px; padding: 12px 20px; }
    .gmi-nav-buttons a.gmi-quote-btn { display: none; }
    .event-details-grid { grid-template-columns: 1fr; }
    .event-main-button, .event-main-button img { min-height: 480px; }
    .event-gallery-grid { grid-template-columns: repeat(2,minmax(0,1fr)); gap: 20px; }
    .footer-grid-responsive { grid-template-columns: 1fr 1fr; gap: 30px; }
    .footer-heading-responsive { font-size: 1rem; }
    .footer-link-responsive, .footer-contact-responsive { font-size: .88rem; }
    .footer-great-logo-img { max-width: 180px; }
    .footer-offer-logo-img { max-width: 160px; }
}
@media (max-width: 860px) {
    .gmi-nav-buttons { display: none; }
    .gmi-hamburger { display: flex; }
    .gmi-header-left .logo-img, .gmi-custom-header.gmi-header-scrolled .logo-img { max-height: 38px; }
}
@media (max-width: 768px) {
    .container { padding: 0 20px; }
    .gmi-custom-header, .gmi-custom-header.gmi-header-scrolled { min-height: 62px; padding: 10px 16px; }
    .breadcrumb-section { min-height: 245px; }
    .breadcrumb-title { padding: 10px 16px 10px 18px; border-radius: 0 13px 13px 0; font-size: clamp(1.6rem, 8vw, 2.15rem); }
    .event-details-section { padding: 68px 0 32px; }
    .event-gallery-section { padding: 32px 0 78px; }
    .event-main-button, .event-main-button img { min-height: 360px; }
    .event-info-card { padding: 26px 22px; }
    .section-heading { margin-bottom: 34px; }
    .section-heading p { font-size: .88rem; }
    .event-lightbox { padding: 70px 20px; }
    .event-lightbox-prev { left: 12px; }
    .event-lightbox-next { right: 12px; }
    .footer-grid-responsive { grid-template-columns: 1fr; gap: 24px; text-align: center; }
    .footer-social-responsive, .footer-contact-responsive { justify-content: center; }
    .footer-bottom-responsive, .footer-bottom-links-responsive { flex-direction: column; text-align: center; }
    .footer-bottom-links-responsive { flex-direction: row; flex-wrap: wrap; justify-content: center; }
    .footer-great-logo-img, .footer-offer-logo-img { max-width: 150px; margin: 0 auto; }
}
@media (max-width: 560px) {
    .event-gallery-grid { grid-template-columns: 1fr; max-width: 450px; margin: 0 auto; gap: 18px; }
    .event-meta-grid { grid-template-columns: 1fr; }
    .event-main-button, .event-main-button img { min-height: 290px; }
    .event-info-card, .event-main-button, .event-gallery-button { border-radius: 20px; }
}
@media (max-width: 480px) {
    .gmi-custom-header, .gmi-custom-header.gmi-header-scrolled { min-height: 52px; padding: 8px 12px; }
    .gmi-header-left { gap: 10px; }
    .gmi-header-left .logo-img, .gmi-custom-header.gmi-header-scrolled .logo-img { max-height: 30px; }
    .gmi-hamburger { width: 38px; height: 38px; }
    .gmi-hamburger span { width: 26px; height: 3px; }
    .breadcrumb-section { min-height: 210px; }
    .breadcrumb-eyebrow { font-size: .62rem; letter-spacing: 1.5px; }
    .breadcrumb-title { font-size: 1.6rem; }
    .breadcrumb-ul li { font-size: 10px; }
    .event-details-section { padding: 52px 0 26px; }
    .event-gallery-section { padding: 26px 0 62px; }
    .section-heading h2 { font-size: 1.8rem; }
    .event-main-button, .event-main-button img { min-height: 240px; }
    .event-main-view { right: 14px; bottom: 14px; padding: 8px 12px; font-size: 10px; }
    .event-info-card { padding: 24px 18px; }
    .event-lightbox { padding: 62px 10px; }
    .event-lightbox-close { top: 14px; right: 14px; width: 42px; height: 42px; }
    .event-lightbox-nav { width: 44px; height: 44px; }
    .event-lightbox-prev { left: 8px; }
    .event-lightbox-next { right: 8px; }
    .footer-inline { padding: 40px 16px 25px; }
    .footer-heading-responsive { font-size: .95rem; margin-bottom: 12px; }
    .footer-link-responsive, .footer-contact-responsive { font-size: .82rem; }
    .footer-link-item { margin: 6px 0; }
    .footer-social-responsive a { width: 38px; height: 38px; font-size: 1rem; }
    .footer-bottom-text { font-size: .78rem; }
    .footer-great-logo-img { max-width: 120px; }
    .footer-offer-logo-img { max-width: 110px; }
    #loader { width: 170px; height: 170px; }
    #loader img { width: 108px; }
}
@media (max-width: 992px), (hover:none), (pointer:coarse) {
    .event-gallery-button { box-shadow: 0 8px 24px rgba(7,21,37,.11); }
    .event-gallery-button.card-visible:hover { transform: none; }
    .event-gallery-button:hover img { transform: none; }
    .event-gallery-button::after { display: none; }
}
@media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    #loader::before, #loader::after, #loader img, .gmi-custom-header, .gmi-header-left .logo-img, .gmi-hamburger span, .event-gallery-button, .event-main-button img, .event-gallery-button img, .event-lightbox, .event-lightbox-stage, .event-lightbox-image { animation: none !important; transition: none !important; }
    .event-gallery-button { opacity: 1 !important; transform: none !important; }
}
</style>

<style id="gmi-event-details-index-font-match">
/* =========================================================
   EVENT DETAILS PAGE
   EB GARAMOND + SAME LARGE TYPOGRAPHY AS INDEX.PHP
   ========================================================= */

/* Global font */
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
small,
strong {
    font-family: 'EB Garamond', Georgia, 'Times New Roman', serif;
}

/* Preserve Font Awesome */
.fa,
.fas,
.far,
.fal,
.fab,
.fa-solid,
.fa-regular {
    font-family: "Font Awesome 6 Free" !important;
}

.fab,
.fa-brands {
    font-family: "Font Awesome 6 Brands" !important;
}

/* Base page size */
body {
    font-size: 18px !important;
    line-height: 1.7 !important;
}


/* =========================================================
   HEADER
   ========================================================= */

.gmi-nav-buttons > a:not(.gmi-quote-btn) {
    font-size: 17px !important;
}

.gmi-nav-buttons a.gmi-quote-btn {
    font-size: 15px !important;
}

.gmi-nav-mobile a {
    font-size: 19px !important;
}


/* =========================================================
   BREADCRUMB
   ========================================================= */

.breadcrumb-eyebrow {
    font-size: .88rem !important;
    letter-spacing: 2px !important;
}

.breadcrumb-title {
    font-size: clamp(2.7rem, 4.2vw, 4.35rem) !important;
    line-height: 1.08 !important;
}

.breadcrumb-ul li,
.breadcrumb-ul li a {
    font-size: 1rem !important;
}


/* =========================================================
   EVENT DETAILS CARD
   ========================================================= */

.event-eyebrow {
    font-size: 1rem !important;
    letter-spacing: 1.8px !important;
}

.event-info-card h1 {
    font-size: clamp(2.35rem, 3.8vw, 3.5rem) !important;
    line-height: 1.12 !important;
    letter-spacing: -1px !important;
}

.event-meta-copy small {
    font-size: .92rem !important;
    letter-spacing: .7px !important;
}

.event-meta-copy strong {
    font-size: 1.08rem !important;
    line-height: 1.45 !important;
}

.event-meta-icon {
    flex-basis: 42px !important;
    width: 42px !important;
    height: 42px !important;
    font-size: 1rem !important;
}

.event-description p {
    font-size: 1.12rem !important;
    line-height: 1.8 !important;
}

.event-back-link {
    font-size: 1rem !important;
}

.event-main-view {
    font-size: .95rem !important;
}


/* =========================================================
   GALLERY
   ========================================================= */

.section-eyebrow {
    font-size: 1rem !important;
}

.section-heading h2 {
    font-size: clamp(2.65rem, 4vw, 3.8rem) !important;
    line-height: 1.08 !important;
}

.section-heading p {
    max-width: 820px !important;
    font-size: 1.12rem !important;
    line-height: 1.75 !important;
}


/* =========================================================
   LIGHTBOX
   ========================================================= */

.event-lightbox-counter {
    font-size: .95rem !important;
}


/* =========================================================
   FOOTER
   ========================================================= */

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
   TABLET
   ========================================================= */

@media (max-width: 992px) {
    body {
        font-size: 17px !important;
    }

    .breadcrumb-title {
        font-size: clamp(2.4rem, 5vw, 3.55rem) !important;
    }

    .event-info-card h1 {
        font-size: clamp(2.15rem, 4.8vw, 3rem) !important;
    }

    .event-description p {
        font-size: 1.08rem !important;
    }

    .section-heading h2 {
        font-size: clamp(2.3rem, 5vw, 3.25rem) !important;
    }

    .section-heading p {
        font-size: 1.08rem !important;
    }

    .footer-heading-responsive {
        font-size: 1.28rem !important;
    }

    .footer-link-responsive,
    .footer-contact-responsive {
        font-size: 1.06rem !important;
    }
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 768px) {
    body {
        font-size: 16.5px !important;
    }

    .gmi-nav-mobile a {
        font-size: 18px !important;
    }

    .breadcrumb-eyebrow {
        font-size: .78rem !important;
    }

    .breadcrumb-title {
        font-size: clamp(2.15rem, 7.6vw, 3rem) !important;
    }

    .breadcrumb-ul li,
    .breadcrumb-ul li a {
        font-size: .95rem !important;
    }

    .event-info-card h1 {
        font-size: clamp(2rem, 7vw, 2.7rem) !important;
    }

    .event-eyebrow {
        font-size: .9rem !important;
    }

    .event-meta-copy small {
        font-size: .85rem !important;
    }

    .event-meta-copy strong {
        font-size: 1rem !important;
    }

    .event-description p {
        font-size: 1.02rem !important;
    }

    .event-back-link {
        font-size: .98rem !important;
    }

    .event-main-view {
        font-size: .88rem !important;
    }

    .section-eyebrow {
        font-size: .9rem !important;
    }

    .section-heading h2 {
        font-size: clamp(2rem, 7.5vw, 2.8rem) !important;
    }

    .section-heading p {
        font-size: 1.02rem !important;
    }
}


/* =========================================================
   SMALL MOBILE
   ========================================================= */

@media (max-width: 480px) {
    body {
        font-size: 16px !important;
    }

    .breadcrumb-eyebrow {
        font-size: .72rem !important;
    }

    .breadcrumb-title {
        font-size: 2rem !important;
    }

    .breadcrumb-ul li,
    .breadcrumb-ul li a {
        font-size: .9rem !important;
    }

    .event-info-card h1 {
        font-size: 1.95rem !important;
    }

    .event-eyebrow {
        font-size: .84rem !important;
    }

    .event-meta-copy small {
        font-size: .8rem !important;
    }

    .event-meta-copy strong {
        font-size: .96rem !important;
    }

    .event-description p {
        font-size: .98rem !important;
    }

    .event-back-link {
        font-size: .94rem !important;
    }

    .section-heading h2 {
        font-size: 2.15rem !important;
    }

    .section-heading p {
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

</head>
<body class="gmi-loading">

<div id="loader-wrapper" style="background:#071525;">
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
        <a href="companies.php">Companies</a>
        <a href="events.php" class="gmi-current" aria-current="page">Events</a>
        <a href="careers.php">Careers</a>
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
        <a href="events.php" class="gmi-current" aria-current="page">Events</a>
        <a href="careers.php">Careers</a>
        <a href="contact-us.php">Contact Us</a>
    </nav>
</header>

<section class="breadcrumb-section"><div class="container"><div class="breadcrumb-area"><div class="breadcrumb-eyebrow"><i class="fas fa-calendar-check"></i> Global Marine Group</div><br/><h1 class="breadcrumb-title">Event Details</h1><ul class="breadcrumb-ul"><li><a href="/">Home</a></li><li aria-current="page">Event Details</li></ul></div></div></section>

<main>
    <section class="event-details-section">
        <div class="container">
            <div class="event-details-grid">
                <button type="button" class="event-main-button" data-lightbox-index="0" aria-label="Open the main event image">
                    <img src="<?php echo e($mainImage); ?>" alt="<?php echo e($eventTitle); ?>" decoding="async" loading="eager" fetchpriority="high">
                    <span class="event-main-view"><i class="fas fa-expand"></i> View Full Image</span>
                </button>

                <article class="event-info-card">
                    <div class="event-eyebrow">Event Details</div>
                    <h1><?php echo e($eventTitle); ?></h1>

                    <div class="event-meta-grid">
                        <div class="event-meta-item">
                            <span class="event-meta-icon"><i class="fas fa-calendar-alt"></i></span>
                            <span class="event-meta-copy"><small>Date</small><strong><?php echo e($eventDate); ?></strong></span>
                        </div>
                        <div class="event-meta-item">
                            <span class="event-meta-icon"><i class="fas fa-clock"></i></span>
                            <span class="event-meta-copy"><small>Time</small><strong><?php echo e($eventTime); ?></strong></span>
                        </div>
                        <div class="event-meta-item">
                            <span class="event-meta-icon"><i class="fas fa-building"></i></span>
                            <span class="event-meta-copy"><small>Organized By</small><strong><?php echo e($eventAuthor); ?></strong></span>
                        </div>
                        <div class="event-meta-item">
                            <span class="event-meta-icon"><i class="fas fa-images"></i></span>
                            <span class="event-meta-copy"><small>Gallery</small><strong><?php echo count($galleryImages); ?> Photos</strong></span>
                        </div>
                    </div>

                    <div class="event-description">
                        <?php foreach ($eventDescription as $paragraph): ?>
                            <p><?php echo e($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>

                    <a href="events.php" class="event-back-link"><i class="fas fa-arrow-left"></i> Back to all events</a>
                </article>
            </div>
        </div>
    </section>

    <section class="event-gallery-section">
        <div class="container">
            <div class="section-heading">
                <div class="section-eyebrow">Event Gallery</div>
                <h2>Event Images</h2>
                <p>Explore highlights from <?php echo e($eventTitle); ?>.</p>
            </div>

            <div class="event-gallery-grid">
                <?php foreach ($galleryImages as $index => $image): ?>
                    <button type="button" class="event-gallery-button" data-lightbox-index="<?php echo $index + 1; ?>" aria-label="Open event image <?php echo $index + 1; ?>">
                        <img src="<?php echo e($image); ?>" alt="<?php echo e($eventTitle); ?> - Photo <?php echo $index + 1; ?>" loading="lazy" decoding="async">
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<div id="eventLightbox" class="event-lightbox" role="dialog" aria-modal="true" aria-label="Event image slideshow" aria-hidden="true">
    <button type="button" id="eventLightboxClose" class="event-lightbox-close" aria-label="Close slideshow"><i class="fas fa-times"></i></button>
    <button type="button" id="eventLightboxPrev" class="event-lightbox-nav event-lightbox-prev" aria-label="Previous image"><i class="fas fa-chevron-left"></i></button>
    <div class="event-lightbox-stage">
        <img id="eventLightboxImage" class="event-lightbox-image" src="<?php echo e($mainImage); ?>" alt="<?php echo e($eventTitle); ?>">
    </div>
    <button type="button" id="eventLightboxNext" class="event-lightbox-nav event-lightbox-next" aria-label="Next image"><i class="fas fa-chevron-right"></i></button>
    <div id="eventLightboxCounter" class="event-lightbox-counter">1 / <?php echo count($slideshowImages); ?></div>
</div>

<footer class="footer-inline section">
<div class="container">
<div class="footer-grid-responsive">
<div class="footer-offer-container">
<img alt="Global Marine Group" class="footer-offer-logo-img" decoding="async" loading="lazy" src="images/logo/GMG 3L WHITE.png"/>
<div class="footer-social-responsive">
<a aria-label="LinkedIn" href="#"><i class="fab fa-linkedin-in"></i></a>
<a aria-label="Facebook" href="#"><i class="fab fa-facebook-f"></i></a>
<a aria-label="Instagram" href="#"><i class="fab fa-instagram"></i></a>
<a aria-label="TikTok" href="#"><i class="fab fa-tiktok"></i></a>
<a aria-label="YouTube" href="#"><i class="fab fa-youtube"></i></a>
</div>
</div>
<div>
<h5 class="footer-heading-responsive">Quick Links</h5>
<ul style="list-style:none;padding:0;margin:0;">
<li class="footer-link-item"><a class="footer-link-responsive" href="about-us.php"><i class="fas fa-chevron-right"></i>About Us</a></li>
<li class="footer-link-item"><a class="footer-link-responsive" href="services.php"><i class="fas fa-chevron-right"></i>Services</a></li>
<li class="footer-link-item"><a class="footer-link-responsive" href="companies.php"><i class="fas fa-chevron-right"></i>Companies</a></li>
<li class="footer-link-item"><a class="footer-link-responsive" href="careers.php"><i class="fas fa-chevron-right"></i>Careers</a></li>
<li class="footer-link-item"><a class="footer-link-responsive" href="contact-us.php"><i class="fas fa-chevron-right"></i>Contact Us</a></li>
</ul>
</div>
<div>
<h5 class="footer-heading-responsive">Our Services</h5>
<ul style="list-style:none;padding:0;margin:0;">
<li class="footer-link-item"><a class="footer-link-responsive" href="services.php#liner-shipping"><i class="fas fa-chevron-right"></i>Liner Shipping</a></li>
<li class="footer-link-item"><a class="footer-link-responsive" href="services.php#nvocc"><i class="fas fa-chevron-right"></i>NVOCC</a></li>
<li class="footer-link-item"><a class="footer-link-responsive" href="services.php#freight"><i class="fas fa-chevron-right"></i>Freight &amp; Logistics</a></li>
<li class="footer-link-item"><a class="footer-link-responsive" href="services.php#port-agency"><i class="fas fa-chevron-right"></i>Port Agency</a></li>
<li class="footer-link-item"><a class="footer-link-responsive" href="services.php#marine-technical"><i class="fas fa-chevron-right"></i>Marine Technical</a></li>
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
<img alt="Great Place to Work" class="footer-great-logo-img" decoding="async" loading="lazy" src="images/logo/great-place-work-resized.png"/>
<p>Proudly certified as a Great Place to Work</p>
</div>
</div>
<div class="footer-bottom-responsive">
<span class="footer-bottom-text">© 2026 <a href="https://gmigroup.lk/" style="color:#b8d4f0;text-decoration:none;">Global Marine Group</a>. All rights reserved.</span>
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
    var loaderStartedAt = window.performance && performance.now ? performance.now() : Date.now();
    var minimumLoaderTime = 1100;
    var scrollFrame = 0;
    var resizeFrame = 0;
    var headerWasScrolled = false;

    function now() {
        return window.performance && performance.now ? performance.now() : Date.now();
    }

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
            var isScrolled = scrollTop > 36;
            header.classList.toggle('gmi-header-scrolled', isScrolled);
            if (isScrolled !== headerWasScrolled) {
                headerWasScrolled = isScrolled;
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
        if (!mobileNav || !hamburger) return;
        var isOpen = mobileNav.classList.toggle('open');
        hamburger.classList.toggle('is-open', isOpen);
        hamburger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
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

    var galleryCards = doc.querySelectorAll('.event-gallery-button');
    if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        galleryCards.forEach(function (card) { card.classList.add('card-visible'); });
    } else {
        var galleryObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('card-visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.06, rootMargin: '120px 0px -3% 0px' });

        galleryCards.forEach(function (card, index) {
            card.style.transitionDelay = Math.min(index % 3, 2) * 70 + 'ms';
            galleryObserver.observe(card);
        });
    }

    function finishLoading() {
        var elapsed = now() - loaderStartedAt;
        var remaining = Math.max(0, minimumLoaderTime - elapsed);

        window.setTimeout(function () {
            if (loader) loader.classList.add('gmi-loaded');
            body.classList.remove('gmi-loading');
            root.classList.remove('gmi-loading-root');
            root.style.background = '';
            syncHeaderOffset();
            updatePageChrome();
        }, remaining);
    }

    doc.addEventListener('DOMContentLoaded', function () {
        syncHeaderOffset();
        updatePageChrome();
    }, { once: true });

    window.addEventListener('scroll', requestScrollUpdate, { passive: true });
    window.addEventListener('resize', requestResizeUpdate, { passive: true });
    window.addEventListener('orientationchange', requestResizeUpdate, { passive: true });

    if ('ResizeObserver' in window && header) {
        new ResizeObserver(function () {
            window.requestAnimationFrame(syncHeaderOffset);
        }).observe(header);
    }

    if (doc.readyState === 'complete') {
        finishLoading();
    } else {
        window.addEventListener('load', finishLoading, { once: true });
        window.setTimeout(finishLoading, 6000);
    }
})();

(function () {
    'use strict';

    var images = <?php echo json_encode($slideshowImages, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
    var lightbox = document.getElementById('eventLightbox');
    var lightboxImage = document.getElementById('eventLightboxImage');
    var lightboxCounter = document.getElementById('eventLightboxCounter');
    var closeButton = document.getElementById('eventLightboxClose');
    var previousButton = document.getElementById('eventLightboxPrev');
    var nextButton = document.getElementById('eventLightboxNext');
    var openButtons = document.querySelectorAll('[data-lightbox-index]');
    var currentIndex = 0;
    var lastFocusedElement = null;
    var touchStartX = 0;

    if (!lightbox || !lightboxImage || !closeButton || !previousButton || !nextButton || !images.length) return;

    function normalizeIndex(index) {
        if (index < 0) return images.length - 1;
        if (index >= images.length) return 0;
        return index;
    }

    function displayImage(index, animate) {
        currentIndex = normalizeIndex(index);

        function update() {
            lightboxImage.src = images[currentIndex];
            lightboxImage.alt = <?php echo json_encode($eventTitle, JSON_UNESCAPED_UNICODE); ?> + ' - Image ' + (currentIndex + 1);
            if (lightboxCounter) lightboxCounter.textContent = (currentIndex + 1) + ' / ' + images.length;
            lightboxImage.classList.remove('is-changing');
        }

        if (animate) {
            lightboxImage.classList.add('is-changing');
            window.setTimeout(update, 150);
        } else {
            update();
        }
    }

    function openLightbox(index, trigger) {
        lastFocusedElement = trigger || document.activeElement;
        displayImage(index, false);
        lightbox.classList.add('is-open');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.classList.add('event-modal-open');
        closeButton.focus();
    }

    function closeLightbox() {
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('event-modal-open');
        if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') lastFocusedElement.focus();
    }

    openButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            openLightbox(Number(button.dataset.lightboxIndex), button);
        });
    });

    closeButton.addEventListener('click', closeLightbox);
    previousButton.addEventListener('click', function () { displayImage(currentIndex - 1, true); });
    nextButton.addEventListener('click', function () { displayImage(currentIndex + 1, true); });

    lightbox.addEventListener('click', function (event) {
        if (event.target === lightbox) closeLightbox();
    });

    lightbox.addEventListener('touchstart', function (event) {
        touchStartX = event.changedTouches[0].screenX;
    }, { passive: true });

    lightbox.addEventListener('touchend', function (event) {
        var difference = event.changedTouches[0].screenX - touchStartX;
        if (Math.abs(difference) < 45) return;
        displayImage(currentIndex + (difference > 0 ? -1 : 1), true);
    }, { passive: true });

    document.addEventListener('keydown', function (event) {
        if (!lightbox.classList.contains('is-open')) return;
        if (event.key === 'Escape') closeLightbox();
        if (event.key === 'ArrowLeft') displayImage(currentIndex - 1, true);
        if (event.key === 'ArrowRight') displayImage(currentIndex + 1, true);
    });
})();
</script>
</body>
</html>