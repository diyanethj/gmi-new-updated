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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Services - Global Marine Group">
    <meta name="description" content="Explore Global Marine Group services across liner shipping, NVOCC, freight forwarding, logistics, port agency, marine technical services, foreign employment, seafarer recruitment and maritime training.">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Global Marine Group">

    <title>Services - Global Marine Group</title>

    <link rel="shortcut icon" type="image/x-icon" href="images/logo/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <!-- Same font as the updated index.php -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700;800&display=swap">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
/* =========================================================
   GLOBAL MARINE GROUP - SERVICES
   EB GARAMOND + LARGE TYPOGRAPHY + INDIVIDUAL BACKGROUNDS
   ========================================================= */

:root {
    --gmi-blue: #20366C;
    --gmi-blue-light: #2a4a8a;
    --gmi-blue-gradient: linear-gradient(145deg, #20366C 0%, #2a4a8a 100%);
    --gmi-navy: #071525;
    --gmi-sky: #8ac4ff;
    --gmi-surface: #f5f8fc;
    --gmi-text: #102033;
    --premium-ease: cubic-bezier(0.16, 1, 0.3, 1);
}

* {
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
    background: var(--gmi-navy);
}

body {
    margin: 0;
    padding-top: 88px;
    overflow-x: hidden;
    background: var(--gmi-navy);
    color: var(--gmi-text);
    font-family: 'EB Garamond', Georgia, 'Times New Roman', serif;
    font-size: 18px;
    line-height: 1.7;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
}

button,
input,
select,
textarea {
    font-family: 'EB Garamond', Georgia, 'Times New Roman', serif;
}

::selection {
    color: #fff;
    background: var(--gmi-blue);
}

img {
    max-width: 100%;
}

a {
    -webkit-tap-highlight-color: transparent;
}

.fa,
.fas,
.far,
.fal,
.fab {
    line-height: 1;
}

.container {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 30px;
}


/* =========================================================
   LIGHTWEIGHT GRID
   ========================================================= */

.row {
    display: flex;
    flex-wrap: wrap;
    margin: -12px;
}

.row > [class*="col-"] {
    width: 100%;
    padding: 12px;
}

.text-center {
    text-align: center;
}

@media (min-width: 576px) {
    .col-sm-6 {
        width: 50% !important;
    }
}

@media (min-width: 768px) {
    .col-md-3 {
        width: 25% !important;
    }

    .col-md-4 {
        width: 33.333333% !important;
    }

    .col-md-6 {
        width: 50% !important;
    }

    .col-md-12 {
        width: 100% !important;
    }
}


/* =========================================================
   LOADER
   ========================================================= */

body.gmi-loading {
    overflow: hidden;
}

#loader-wrapper {
    position: fixed;
    inset: 0;
    z-index: 2147483647;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100vw;
    height: 100vh;
    background:
        radial-gradient(circle at 50% 48%, rgba(42,74,138,.22), transparent 34%),
        var(--gmi-navy);
    opacity: 1;
    visibility: visible;
    pointer-events: all;
    transition:
        opacity .78s cubic-bezier(.22,1,.36,1),
        visibility .78s ease;
}

#loader-wrapper.gmi-loaded {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

#loader {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 210px;
    height: 210px;
}

#loader::before,
#loader::after {
    content: '';
    position: absolute;
    inset: 12px;
    border: 1px solid rgba(138,196,255,.26);
    border-radius: 50%;
    animation: gmiLoaderRing 2.35s cubic-bezier(.22,1,.36,1) infinite;
}

#loader::after {
    inset: 35px;
    border-color: rgba(138,196,255,.14);
    animation-delay: .38s;
}

#loader img {
    position: relative;
    z-index: 2;
    display: block;
    width: 130px;
    height: auto;
    filter: drop-shadow(0 0 30px rgba(138,196,255,.34));
    animation: gmiLoaderPulse 2.25s ease-in-out infinite;
}

@keyframes gmiLoaderPulse {
    0%, 100% {
        opacity: .68;
        transform: scale(.95);
    }

    50% {
        opacity: 1;
        transform: scale(1.055);
    }
}

@keyframes gmiLoaderRing {
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


/* =========================================================
   SCROLL PROGRESS
   ========================================================= */

.gmi-progress-bar {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100000;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #20366C 0%, #2a4a8a 50%, #1e90ff 100%);
    transform: scaleX(0);
    transform-origin: left center;
    will-change: transform;
}


/* =========================================================
   HEADER - MATCHES UPDATED INDEX.PHP TYPOGRAPHY
   ========================================================= */

.gmi-custom-header {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    width: 100%;
    min-height: 88px;
    padding: 14px 30px;
    border-bottom: 1px solid transparent;
    background: #fff;
    box-shadow: 0 2px 16px rgba(0,0,0,.10);
    transition:
        min-height .4s var(--premium-ease),
        padding .4s var(--premium-ease),
        background .3s ease,
        border-color .3s ease,
        box-shadow .4s ease;
}

.gmi-custom-header.gmi-header-scrolled {
    min-height: 72px;
    padding-top: 9px;
    padding-bottom: 9px;
    border-bottom-color: rgba(32,54,108,.10);
    background: rgba(255,255,255,.97);
    box-shadow: 0 12px 36px rgba(7,21,37,.13);
}

.gmi-header-left {
    display: flex;
    align-items: center;
    gap: 20px;
}

.gmi-logo-link {
    display: inline-flex;
    align-items: center;
    line-height: 0;
    text-decoration: none;
}

.gmi-header-left .logo-img {
    width: auto;
    max-height: 60px;
    transition:
        max-height .4s var(--premium-ease),
        transform .4s var(--premium-ease);
}

.gmi-custom-header.gmi-header-scrolled .logo-img {
    max-height: 48px;
}

.gmi-nav-buttons {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 8px 18px;
    margin: 5px 0;
}

.gmi-nav-buttons > a:not(.gmi-quote-btn) {
    position: relative;
    padding: 10px 16px;
    border-radius: 8px;
    color: #0a1a2b;
    font-size: 17px;
    font-weight: 600;
    letter-spacing: .2px;
    text-decoration: none;
    white-space: nowrap;
    transition: .25s ease;
}

.gmi-nav-buttons > a:not(.gmi-quote-btn)::after {
    content: '';
    position: absolute;
    right: 16px;
    bottom: 6px;
    left: 16px;
    height: 2px;
    border-radius: 2px;
    background: var(--gmi-blue-gradient);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .3s ease;
}

.gmi-nav-buttons > a:not(.gmi-quote-btn):hover,
.gmi-nav-buttons > a.gmi-current {
    color: var(--gmi-blue);
    background: #f0f4f8;
}

.gmi-nav-buttons > a:not(.gmi-quote-btn):hover::after,
.gmi-nav-buttons > a.gmi-current::after {
    transform: scaleX(1);
}

.gmi-nav-buttons a.gmi-quote-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 44px;
    margin-left: 10px;
    padding: 12px 24px;
    border-radius: 30px;
    color: #fff;
    background: var(--gmi-blue-gradient);
    box-shadow: 0 6px 18px rgba(32,54,108,.28);
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    transition: .3s ease;
}

.gmi-nav-buttons a.gmi-quote-btn:hover {
    color: #fff;
    background: linear-gradient(145deg, #2a4a8a 0%, #20366C 100%);
    box-shadow: 0 10px 24px rgba(32,54,108,.38);
    transform: translateY(-2px);
}

.gmi-hamburger {
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    width: 42px;
    height: 42px;
    padding: 6px;
    border: 0;
    border-radius: 8px;
    background: transparent;
    cursor: pointer;
}

.gmi-hamburger:hover {
    background: #f0f4f8;
}

.gmi-hamburger span {
    display: block;
    width: 30px;
    height: 3.5px;
    border-radius: 4px;
    background: #0a1a2b;
    transition: transform .3s ease, opacity .3s ease;
}

.gmi-hamburger.is-open span:nth-child(1) {
    transform: translateY(8.5px) rotate(45deg);
}

.gmi-hamburger.is-open span:nth-child(2) {
    opacity: 0;
}

.gmi-hamburger.is-open span:nth-child(3) {
    transform: translateY(-8.5px) rotate(-45deg);
}

.gmi-nav-mobile {
    display: none;
    flex-direction: column;
    width: 100%;
    margin-top: 12px;
    padding: 12px 0;
    border-top: 1px solid #eaeaea;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,.05);
}

.gmi-nav-mobile.open {
    display: flex;
}

.gmi-nav-mobile a {
    display: block;
    width: 100%;
    padding: 14px 24px;
    border-bottom: 1px solid #f0f0f0;
    color: #0a1a2b;
    font-size: 19px;
    font-weight: 700;
    text-decoration: none;
}

.gmi-nav-mobile a:hover,
.gmi-nav-mobile a.gmi-current {
    color: var(--gmi-blue);
    background: #f5f8fc;
}


/* =========================================================
   SERVICE SIDE NAVIGATION
   ========================================================= */

.segment-nav {
    position: fixed;
    top: 50%;
    right: 28px;
    z-index: 1000;
    transform: translateY(-50%);
}

.segment-nav-dot {
    position: relative;
    width: 12px;
    height: 12px;
    margin: 17px 0;
    border: 2px solid rgba(255,255,255,.86);
    border-radius: 50%;
    background: rgba(138,196,255,.28);
    box-shadow: 0 5px 18px rgba(0,0,0,.25);
    cursor: pointer;
    transition:
        transform .3s var(--premium-ease),
        background .25s ease,
        box-shadow .25s ease;
}

.segment-nav-dot:hover,
.segment-nav-dot.active {
    background: #8ac4ff;
    box-shadow: 0 0 22px rgba(138,196,255,.55);
    transform: scale(1.42);
}

.dot-label {
    position: absolute;
    top: 50%;
    right: 28px;
    padding: 7px 14px;
    border: 1px solid rgba(138,196,255,.2);
    border-radius: 999px;
    color: #fff;
    background: rgba(7,21,37,.94);
    box-shadow: 0 10px 25px rgba(0,0,0,.22);
    font-size: 1rem;
    font-weight: 600;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transform: translate(8px,-50%);
    transition: .25s ease;
}

.segment-nav-dot:hover .dot-label {
    opacity: 1;
    visibility: visible;
    transform: translate(0,-50%);
}


/* =========================================================
   FIXED SERVICE BACKGROUND
   Content scrolls normally; background cross-fades per section
   ========================================================= */

.services-background-stage {
    position: fixed;
    inset: 0;
    z-index: 0;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    pointer-events: none;
    background: #071525;
    opacity: 1;
}

.services-background-layer {
    position: absolute;
    inset: -2%;
    width: 104%;
    height: 104%;
    opacity: 0;
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    filter: saturate(.96) contrast(1.05) brightness(.88);
    transform: scale(1.035);
    transition:
        opacity 1.15s cubic-bezier(.22,1,.36,1),
        transform 1.45s cubic-bezier(.22,1,.36,1),
        filter 1s ease;
    will-change: opacity, transform;
}

.services-background-layer.is-visible {
    opacity: 1;
    transform: scale(1);
    filter: saturate(1) contrast(1.06) brightness(.92);
}

.services-background-overlay {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 18% 72%, rgba(63,120,189,.28), transparent 38%),
        linear-gradient(90deg, rgba(4,14,26,.80) 0%, rgba(4,14,26,.55) 48%, rgba(4,14,26,.79) 100%),
        linear-gradient(180deg, rgba(4,14,26,.20) 0%, rgba(4,14,26,.66) 100%);
}

/* Service sections now stay transparent so the fixed background is visible */
.segment-section {
    position: relative;
    z-index: 1;
    isolation: isolate;
    display: flex;
    align-items: center;
    min-height: calc(100vh - 30px);
    width: 100%;
    padding: 90px 0;
    background: transparent !important;
    border-top: 1px solid rgba(138,196,255,.10);
    border-bottom: 1px solid rgba(138,196,255,.06);
}

.segment-section:first-of-type {
    padding-top: 100px;
}

/* Disable section-owned scrolling backgrounds */
.segment-section::before,
.segment-section::after {
    display: none !important;
}


/* =========================================================
   MAIN GLASS PANEL
   ========================================================= */

.segment-section > .container {
    position: relative;
    z-index: 2;
    max-width: 1180px;
    padding: 48px 50px;
    border: 1px solid rgba(255,255,255,.34);
    border-radius: 30px;
    background: rgba(255,255,255,.93);
    box-shadow:
        0 34px 90px rgba(4,14,26,.34),
        inset 0 1px 0 rgba(255,255,255,.80);
    backdrop-filter: blur(14px) saturate(118%);
    -webkit-backdrop-filter: blur(14px) saturate(118%);
}

.segment-section > .container::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: -1;
    border-radius: inherit;
    pointer-events: none;
    background:
        radial-gradient(
            circle at var(--mouse-x,50%) var(--mouse-y,50%),
            rgba(138,196,255,.14),
            transparent 34%
        );
}


/* =========================================================
   SEGMENT HEADER
   ========================================================= */

.segment-header {
    margin-bottom: 36px;
    text-align: center;
}

.segment-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100px;
    height: 100px;
    margin: 0 auto 22px;
    border: 1px solid rgba(32,54,108,.12);
    border-radius: 50%;
    background: linear-gradient(145deg,#10243d 0%,#20366C 58%,#2a4a8a 100%);
    box-shadow: 0 18px 36px rgba(7,21,37,.22);
}

.segment-icon img {
    width: 66px;
    height: 66px;
    object-fit: contain;
    filter: brightness(0) invert(1);
}

.segment-title {
    position: relative;
    display: inline-block;
    margin: 0;
    padding-bottom: 15px;
    color: #0a1a2b !important;
    font-size: clamp(2.65rem, 4vw, 3.8rem) !important;
    font-weight: 800 !important;
    line-height: 1.08 !important;
    letter-spacing: -1.4px !important;
    text-transform: none;
}

.segment-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 90px;
    height: 4px;
    border-radius: 5px;
    background: linear-gradient(90deg,#8ac4ff,#20366C);
    transform: translateX(-50%);
}

.segment-description {
    max-width: 820px;
    margin: 20px auto 0 !important;
    color: #4b5c6d !important;
    font-size: 1.2rem !important;
    line-height: 1.75 !important;
    font-weight: 400 !important;
}


/* =========================================================
   SERVICE CARDS
   ========================================================= */

.service-card {
    position: relative;
    overflow: hidden;
    height: 100%;
    margin: 0;
    padding: 30px;
    border: 1px solid rgba(32,54,108,.11);
    border-radius: 20px;
    background: rgba(255,255,255,.92);
    box-shadow: 0 14px 34px rgba(7,21,37,.10);
    transition:
        transform .5s var(--premium-ease),
        border-color .35s ease,
        box-shadow .45s ease,
        background .35s ease;
}

.service-card::before {
    content: '';
    position: absolute;
    inset: 0;
    pointer-events: none;
    opacity: 0;
    background:
        radial-gradient(
            circle at var(--mouse-x,50%) var(--mouse-y,50%),
            rgba(138,196,255,.18),
            transparent 36%
        );
    transition: opacity .35s ease;
}

.service-card:hover {
    border-color: rgba(32,54,108,.27);
    background: #fff;
    box-shadow: 0 24px 55px rgba(7,21,37,.16);
    transform: translateY(-7px) scale(1.01);
}

.service-card:hover::before {
    opacity: 1;
}

.service-card > * {
    position: relative;
    z-index: 1;
}

.service-card h1,
.service-card h2,
.service-card h3,
.service-card h4,
.service-card h5,
.service-card h6 {
    color: #20366C !important;
    font-family: 'EB Garamond', Georgia, serif !important;
    font-size: 1.35rem !important;
    font-weight: 700 !important;
    line-height: 1.4 !important;
    letter-spacing: 0 !important;
}

.service-card p,
.service-card li,
.foreign-service-description {
    color: #4b5563 !important;
    font-family: 'EB Garamond', Georgia, serif !important;
    font-size: 1.12rem !important;
    line-height: 1.8 !important;
}

.service-card ul {
    line-height: 1.8;
}

.service-card i.fa-check-circle {
    color: #20366C !important;
    font-size: 18px !important;
}

.icon-circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 76px;
    height: 76px;
    margin: 0 auto 18px;
    border-radius: 50%;
    background: var(--gmi-blue-gradient);
    box-shadow: 0 12px 24px rgba(32,54,108,.24);
}

.foreign-service-title-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 14px;
}

.foreign-service-icon {
    flex: 0 0 62px;
    width: 62px !important;
    height: 62px !important;
    margin: 0;
}

.foreign-service-description {
    margin: 0;
}


/* =========================================================
   LEARN MORE BUTTON
   ========================================================= */

.learn-more-btn {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    gap: 9px;
    min-height: 50px;
    padding: 13px 26px;
    border: 0;
    border-radius: 999px;
    color: #fff !important;
    background: var(--gmi-blue-gradient);
    box-shadow: 0 12px 28px rgba(32,54,108,.25);
    font-family: 'EB Garamond', Georgia, serif;
    font-size: 1rem !important;
    font-weight: 700;
    letter-spacing: .2px;
    text-decoration: none;
    transition:
        transform .4s var(--premium-ease),
        box-shadow .4s ease;
}

.learn-more-btn::before {
    content: '';
    position: absolute;
    top: -120%;
    left: -35%;
    width: 30%;
    height: 340%;
    background: linear-gradient(90deg,transparent,rgba(255,255,255,.34),transparent);
    transform: rotate(23deg);
    transition: left .7s var(--premium-ease);
}

.learn-more-btn:hover {
    color: #fff !important;
    box-shadow: 0 18px 38px rgba(32,54,108,.34);
    transform: translateY(-4px);
}

.learn-more-btn:hover::before {
    left: 120%;
}

.learn-more-btn i {
    transition: transform .25s ease;
}

.learn-more-btn:hover i {
    transform: translateX(4px);
}


/* =========================================================
   SEAFARER STATISTICS
   ========================================================= */

#seafarer .service-card h3 {
    font-size: clamp(2.6rem, 4vw, 3.4rem) !important;
    font-weight: 800 !important;
    line-height: 1.05 !important;
}

#seafarer .service-card p {
    font-size: 1.2rem !important;
    font-weight: 600 !important;
}


/* =========================================================
   REVEAL ANIMATION
   ========================================================= */

.premium-reveal {
    opacity: 0;
    filter: blur(2px);
    transform: translate3d(0,28px,0) scale(.985);
    transition:
        opacity .95s var(--premium-ease),
        transform 1.1s var(--premium-ease),
        filter .8s ease;
    transition-delay: var(--premium-delay,0ms);
}

.premium-reveal.premium-visible {
    opacity: 1;
    filter: blur(0);
    transform: translate3d(0,0,0) scale(1);
}


/* =========================================================
   FOOTER - SAME LARGE TYPOGRAPHY AS UPDATED INDEX
   ========================================================= */

.footer-inline {
    position: relative;
    z-index: 2;
    overflow: hidden;
    padding: 60px 30px 40px;
    color: #8aaccc;
    background: linear-gradient(145deg, #122437 0%, #1A2A3A 52%, #102337 100%);
}

.footer-inline::before {
    content: '';
    position: absolute;
    top: -220px;
    left: 50%;
    width: 720px;
    height: 420px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(63,120,189,.13), transparent 68%);
    transform: translateX(-50%);
    pointer-events: none;
}

.footer-inline > .container {
    position: relative;
    z-index: 1;
    max-width: none;
    width: 100%;
    margin: 0;
    padding: 0 30px;
}

.footer-grid-responsive {
    display: grid;
    grid-template-columns: 1.3fr 1fr 1fr 1.35fr 1.2fr;
    gap: 30px;
    padding-bottom: 30px;
}

.footer-offer-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
}

.footer-offer-logo-img {
    width: 100%;
    max-width: 300px;
    height: auto;
    margin-bottom: 20px;
    filter: brightness(0) invert(1);
}

.footer-social-responsive {
    display: flex;
    gap: 10px;
}

.footer-social-responsive a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border: 1px solid rgba(32,54,108,.2);
    border-radius: 50%;
    color: #b8d4f0;
    background: rgba(32,54,108,.15);
    font-size: 1.2rem;
    text-decoration: none;
    transition: .3s;
}

.footer-social-responsive a:hover {
    border-color: #1e90ff;
    color: #fff;
    background: #1e90ff;
    box-shadow: 0 6px 20px rgba(30,144,255,.3);
    transform: translateY(-3px);
}

.footer-heading-responsive {
    margin: 0 0 18px;
    color: #fff;
    font-size: 1.38rem;
    font-weight: 700;
    letter-spacing: .2px;
}

.footer-link-item {
    margin: 10px 0;
    list-style: none;
}

.footer-link-responsive {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #b8d4f0;
    font-size: 1.12rem;
    text-decoration: none;
    transition: .2s;
}

.footer-link-responsive:hover {
    padding-left: 8px;
    color: #fff;
}

.footer-link-responsive i {
    color: #6ab0ff;
    font-size: .7rem;
}

.footer-contact-responsive {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
    color: #b8d4f0;
    font-size: 1.12rem;
    line-height: 1.5;
    list-style: none;
}

.footer-contact-responsive i {
    flex-shrink: 0;
    width: 18px;
    margin-top: 5px;
    color: #6ab0ff;
    font-size: .9rem;
}

.footer-great-text {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.footer-great-logo-img {
    width: 100%;
    max-width: 100px;
    height: auto;
}

.footer-great-text p {
    margin-top: 12px;
    color: #b8d4f0;
    font-size: 1rem;
    opacity: .8;
}

.footer-bottom-responsive {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    padding-top: 22px;
    border-top: 1px solid rgba(32,54,108,.15);
    color: #6a8aaa;
    font-size: 1rem;
}

.footer-bottom-links-responsive {
    display: flex;
    align-items: center;
    gap: 15px;
}

.footer-bottom-links-responsive a {
    color: #6a8aaa;
    font-size: 1rem;
    text-decoration: none;
    transition: .2s;
}

.footer-bottom-links-responsive a:hover {
    color: #fff;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 1150px) {
    .gmi-nav-buttons {
        gap: 6px 8px;
    }

    .gmi-nav-buttons > a:not(.gmi-quote-btn) {
        padding: 10px 11px;
        font-size: 15px;
    }
}

@media (max-width: 992px) {

    body {
        font-size: 17px;
    }

    .gmi-custom-header {
        min-height: 72px;
        padding: 12px 20px;
    }

    .gmi-nav-buttons a.gmi-quote-btn {
        display: none;
    }

    .segment-section {
        min-height: auto;
        padding: 76px 0;
    }

    .segment-section > .container {
        margin: 0 24px;
        padding: 40px 34px;
    }

    .segment-nav {
        right: 16px;
    }

    .segment-title {
        font-size: clamp(2.3rem, 5vw, 3.25rem) !important;
    }

    .segment-description {
        font-size: 1.12rem !important;
    }

    .service-card h1,
    .service-card h2,
    .service-card h3,
    .service-card h4,
    .service-card h5,
    .service-card h6 {
        font-size: 1.28rem !important;
    }

    .service-card p,
    .service-card li,
    .foreign-service-description {
        font-size: 1.06rem !important;
    }

    .footer-grid-responsive {
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .footer-heading-responsive {
        font-size: 1.28rem;
    }

    .footer-link-responsive,
    .footer-contact-responsive {
        font-size: 1.06rem;
    }

    .footer-great-logo-img {
        max-width: 180px;
    }

    .footer-offer-logo-img {
        max-width: 160px;
    }
}

@media (max-width: 860px) {

    .gmi-nav-buttons {
        display: none;
    }

    .gmi-hamburger {
        display: flex;
    }

    .gmi-header-left .logo-img,
    .gmi-custom-header.gmi-header-scrolled .logo-img {
        max-height: 38px;
    }
}

@media (max-width: 768px) {

    body {
        font-size: 16.5px;
    }

    .container {
        padding: 0 18px;
    }

    .gmi-custom-header {
        min-height: 62px;
        padding: 10px 16px;
    }

    .gmi-nav-mobile a {
        font-size: 18px;
    }

    .segment-nav {
        display: none;
    }

    .segment-section {
        padding: 62px 0;
    }

    .segment-section:first-of-type {
        padding-top: 62px;
    }

    .segment-section > .container {
        margin: 0 16px;
        padding: 34px 24px;
        border-radius: 24px;
    }

    .segment-icon {
        width: 84px;
        height: 84px;
    }

    .segment-icon img {
        width: 55px;
        height: 55px;
    }

    .segment-title {
        font-size: clamp(2rem, 7.5vw, 2.8rem) !important;
    }

    .segment-description {
        font-size: 1.02rem !important;
        line-height: 1.7 !important;
    }

    .service-card {
        padding: 23px;
    }

    .service-card h1,
    .service-card h2,
    .service-card h3,
    .service-card h4,
    .service-card h5,
    .service-card h6 {
        font-size: 1.18rem !important;
    }

    .service-card p,
    .service-card li,
    .foreign-service-description {
        font-size: 1rem !important;
        line-height: 1.72 !important;
    }

    .learn-more-btn {
        min-height: 46px;
        padding: 11px 21px;
        font-size: .95rem !important;
    }

    .footer-grid-responsive {
        grid-template-columns: 1fr;
        gap: 24px;
        text-align: center;
    }

    .footer-social-responsive,
    .footer-contact-responsive {
        justify-content: center;
    }

    .footer-bottom-responsive {
        flex-direction: column;
        text-align: center;
    }

    .footer-bottom-links-responsive {
        flex-wrap: wrap;
        justify-content: center;
    }

    .footer-great-logo-img,
    .footer-offer-logo-img {
        max-width: 150px;
        margin-right: auto;
        margin-left: auto;
    }
}

@media (max-width: 480px) {

    body {
        font-size: 16px;
    }

    .gmi-custom-header {
        min-height: 52px;
        padding: 8px 12px;
    }

    .gmi-header-left {
        gap: 10px;
    }

    .gmi-header-left .logo-img,
    .gmi-custom-header.gmi-header-scrolled .logo-img {
        max-height: 30px;
    }

    .gmi-hamburger {
        width: 38px;
        height: 38px;
    }

    .gmi-hamburger span {
        width: 26px;
        height: 3px;
    }

    .segment-section {
        padding: 44px 0;
    }

    .segment-section > .container {
        margin: 0 10px;
        padding: 28px 16px;
        border-radius: 20px;
    }

    .segment-title {
        font-size: 2.15rem !important;
    }

    .segment-description {
        font-size: .98rem !important;
    }

    .row {
        margin: -7px;
    }

    .row > [class*="col-"] {
        padding: 7px;
    }

    .service-card {
        padding: 18px 15px;
        border-radius: 16px;
    }

    .service-card h1,
    .service-card h2,
    .service-card h3,
    .service-card h4,
    .service-card h5,
    .service-card h6 {
        font-size: 1.12rem !important;
    }

    .service-card p,
    .service-card li,
    .foreign-service-description {
        font-size: .98rem !important;
    }

    .foreign-service-title-row {
        flex-direction: column;
        text-align: center;
    }

    #seafarer .service-card h3 {
        font-size: 2.45rem !important;
    }

    .footer-inline {
        padding: 40px 16px 25px;
    }

    .footer-inline > .container {
        padding: 0;
    }

    .footer-heading-responsive {
        margin-bottom: 12px;
        font-size: 1.2rem;
    }

    .footer-link-responsive,
    .footer-contact-responsive {
        font-size: 1rem;
    }

    .footer-link-item {
        margin: 6px 0;
    }

    .footer-social-responsive a {
        width: 38px;
        height: 38px;
        font-size: 1rem;
    }

    .footer-bottom-responsive,
    .footer-bottom-links-responsive a,
    .footer-bottom-text {
        font-size: .92rem;
    }

    .footer-great-logo-img {
        max-width: 120px;
    }

    .footer-offer-logo-img {
        max-width: 110px;
    }
}

@media (hover:none), (pointer:coarse) {

    .service-card {
        box-shadow: 0 8px 24px rgba(7,21,37,.12);
    }
}

@media (prefers-reduced-motion: reduce) {

    html {
        scroll-behavior: auto;
    }

    .premium-reveal,
    .service-card,
    .learn-more-btn,
    .gmi-custom-header,
    .services-background-layer {
        animation: none !important;
        transition: none !important;
        transform: none !important;
        filter: none !important;
        opacity: 1 !important;
    }

    #loader img,
    #loader::before,
    #loader::after {
        animation: none !important;
    }
}

</style>

<style id="gmi-services-background-brightness-fix">
/* =========================================================
   SERVICES BACKGROUND BRIGHTNESS FIX
   Keeps fixed backgrounds + smooth cross-fade unchanged.
   Only reduces darkness and improves image visibility.
   ========================================================= */

/* Make the actual photos brighter and more natural */
.services-background-layer {
    filter:
        saturate(1.03)
        contrast(1.02)
        brightness(1.04) !important;
}

.services-background-layer.is-visible {
    filter:
        saturate(1.06)
        contrast(1.02)
        brightness(1.08) !important;
}

/* Reduce the previous heavy navy/black overlay */
.services-background-overlay {
    background:
        radial-gradient(
            circle at 18% 72%,
            rgba(63,120,189,.16),
            transparent 40%
        ),
        linear-gradient(
            90deg,
            rgba(4,14,26,.48) 0%,
            rgba(4,14,26,.24) 48%,
            rgba(4,14,26,.46) 100%
        ),
        linear-gradient(
            180deg,
            rgba(4,14,26,.08) 0%,
            rgba(4,14,26,.34) 100%
        ) !important;
}

/* Keep enough contrast on smaller screens without making images too dark */
@media (max-width: 768px) {
    .services-background-layer,
    .services-background-layer.is-visible {
        filter:
            saturate(1.04)
            contrast(1.02)
            brightness(1.06) !important;
    }

    .services-background-overlay {
        background:
            linear-gradient(
                180deg,
                rgba(4,14,26,.18) 0%,
                rgba(4,14,26,.38) 100%
            ),
            linear-gradient(
                90deg,
                rgba(4,14,26,.38) 0%,
                rgba(4,14,26,.20) 50%,
                rgba(4,14,26,.38) 100%
            ) !important;
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


<!-- ======================================================
     HEADER
     ====================================================== -->

<header class="gmi-custom-header">

    <div class="gmi-header-left">
        <a href="/" class="gmi-logo-link" aria-label="Global Marine Group home">
            <img
                class="logo-img"
                src="images/logo/GMG 3L.png"
                alt="Global Marine Group"
                decoding="async"
                loading="eager"
                fetchpriority="high"
            >
        </a>
    </div>

    <nav class="gmi-nav-buttons" aria-label="Primary navigation">
        <a href="/">HOME</a>
        <a href="about-us.php">ABOUT US</a>
        <a href="services.php" class="gmi-current">SERVICES</a>
        <a href="companies.php">COMPANIES</a>
        <a href="events.php">EVENTS</a>
        <a href="careers.php">CAREERS</a>
        <a href="contact-us.php">CONTACT US</a>
    </nav>

    <button
        type="button"
        class="gmi-hamburger"
        onclick="toggleMobileNav()"
        aria-label="Toggle navigation"
        aria-controls="gmiNavMobile"
        aria-expanded="false"
    >
        <span></span>
        <span></span>
        <span></span>
    </button>

    <nav id="gmiNavMobile" class="gmi-nav-mobile" aria-label="Mobile navigation">
        <a href="/">HOME</a>
        <a href="about-us.php">ABOUT US</a>
        <a href="services.php" class="gmi-current">SERVICES</a>
        <a href="companies.php">COMPANIES</a>
        <a href="events.php">EVENTS</a>
        <a href="careers.php">CAREERS</a>
        <a href="contact-us.php">CONTACT US</a>
    </nav>

</header>

<!-- ======================================================
     FIXED SERVICE BACKGROUND
     Background changes smoothly as each section becomes active
     ====================================================== -->

<div id="servicesBackgroundStage" class="services-background-stage" aria-hidden="true">

    <div
        id="servicesBackgroundLayerA"
        class="services-background-layer is-visible"
    ></div>

    <div
        id="servicesBackgroundLayerB"
        class="services-background-layer"
    ></div>

    <div class="services-background-overlay"></div>

</div>



<!-- ======================================================
     SERVICE NAVIGATION DOTS
     ====================================================== -->

<div class="segment-nav">

    <div class="segment-nav-dot" data-target="liner-shipping">
        <span class="dot-label">Liner Shipping</span>
    </div>

    <div class="segment-nav-dot" data-target="nvocc">
        <span class="dot-label">NVOCC</span>
    </div>

    <div class="segment-nav-dot" data-target="freight">
        <span class="dot-label">Freight &amp; Logistics</span>
    </div>

    <div class="segment-nav-dot" data-target="port-agency">
        <span class="dot-label">Port Agency</span>
    </div>

    <div class="segment-nav-dot" data-target="marine-technical">
        <span class="dot-label">Marine Technical</span>
    </div>

    <div class="segment-nav-dot" data-target="foreign-employment">
        <span class="dot-label">Foreign Employment</span>
    </div>

    <div class="segment-nav-dot" data-target="seafarer">
        <span class="dot-label">Seafarer Recruitment</span>
    </div>

    <div class="segment-nav-dot" data-target="education">
        <span class="dot-label">Education &amp; Training</span>
    </div>

</div>


<!-- ======================================================
     1. LINER SHIPPING
     ====================================================== -->

<section id="liner-shipping" class="segment-section">

    <div class="container">

        <div class="segment-header">

            <div class="segment-icon">
                <img src="images/segments/offer-round-one.png" alt="Liner Shipping">
            </div>

            <h2 class="segment-title">LINER SHIPPING</h2>

            <p class="segment-description">
                Comprehensive liner shipping agency services with global reach and local expertise.
            </p>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="service-card">

                    <h4>Services Include:</h4>

                    <div class="row" style="margin-top:20px;">

                        <div class="col-md-6">

                            <p style="margin-bottom:15px;">
                                <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                                Liner Shipping Agency Services
                            </p>

                            <p style="margin-bottom:15px;">
                                <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                                Feeder Shipping Agency Services
                            </p>

                            <p style="margin-bottom:15px;">
                                <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                                Container Management
                            </p>

                        </div>

                        <div class="col-md-6">

                            <p style="margin-bottom:15px;">
                                <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                                Documentation Services
                            </p>

                            <p style="margin-bottom:15px;">
                                <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                                Berth Planning
                            </p>

                            <p style="margin-bottom:15px;">
                                <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                                Cargo Monitoring
                            </p>

                        </div>

                    </div>

                    <div style="margin-top:30px;text-align:center;">
                        <a
                            href="https://www.samudera.id/"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="learn-more-btn"
                        >
                            Learn More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ======================================================
     2. NVOCC
     ====================================================== -->

<section id="nvocc" class="segment-section">

    <div class="container">

        <div class="segment-header">

            <div class="segment-icon">
                <img src="images/segments/offer-round-two.png" alt="NVOCC">
            </div>

            <h2 class="segment-title">NVOCC</h2>

            <p class="segment-description">
                Non-Vessel Operating Common Carrier services with comprehensive coverage.
            </p>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="service-card">

                    <h4>NVOCC Line Agency Services</h4>

                    <ul style="list-style:none;padding:0;margin-top:20px;">

                        <li style="margin-bottom:15px;">
                            <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                            Consolidation Services
                        </li>

                        <li style="margin-bottom:15px;">
                            <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                            Break-bulk Operations
                        </li>

                        <li style="margin-bottom:15px;">
                            <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                            LCL/FCL Consolidation
                        </li>

                    </ul>

                </div>

            </div>

            <div class="col-md-6">

                <div class="service-card">

                    <h4>Documentation &amp; Compliance</h4>

                    <ul style="list-style:none;padding:0;margin-top:20px;">

                        <li style="margin-bottom:15px;">
                            <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                            Bill of Lading Issuance
                        </li>

                        <li style="margin-bottom:15px;">
                            <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                            Customs Documentation
                        </li>

                        <li style="margin-bottom:15px;">
                            <i class="fas fa-check-circle" style="margin-right:12px;"></i>
                            Regulatory Compliance
                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <div style="margin-top:40px;text-align:center;">
            <a
                href="https://www.cordelialine.com/"
                target="_blank"
                rel="noopener noreferrer"
                class="learn-more-btn"
            >
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

    </div>

</section>


<!-- ======================================================
     3. FREIGHT FORWARDING & LOGISTICS
     ====================================================== -->

<section id="freight" class="segment-section">

    <div class="container">

        <div class="segment-header">

            <div class="segment-icon">
                <img
                    src="images/segments/offer-round-five.png"
                    alt="Freight Forwarding & Logistics"
                >
            </div>

            <h2 class="segment-title">FREIGHT FORWARDING &amp; LOGISTICS</h2>

            <p class="segment-description">
                End-to-end logistics solutions for all cargo types.
            </p>

        </div>

        <div class="row">

            <div class="col-md-4">

                <div class="service-card text-center">

                    <div class="icon-circle">
                        <i class="fas fa-plane" style="font-size:32px;color:white;"></i>
                    </div>

                    <h4>Air Freight</h4>

                    <p>Fast and reliable air cargo solutions</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="service-card text-center">

                    <div class="icon-circle">
                        <i class="fas fa-ship" style="font-size:32px;color:white;"></i>
                    </div>

                    <h4>Sea Freight</h4>

                    <p>Comprehensive ocean freight services</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="service-card text-center">

                    <div class="icon-circle">
                        <i class="fas fa-truck" style="font-size:32px;color:white;"></i>
                    </div>

                    <h4>Road Transport</h4>

                    <p>Efficient land transportation</p>

                </div>

            </div>

        </div>

        <div class="row" style="margin-top:30px;">

            <div class="col-md-12">

                <div class="service-card">

                    <h4 style="text-align:center;margin-bottom:25px;">
                        Specialized Services
                    </h4>

                    <div class="row">

                        <div class="col-md-4 text-center">
                            <p>
                                <i class="fas fa-check-circle" style="margin-right:8px;"></i>
                                Special Cargo Operations
                            </p>
                        </div>

                        <div class="col-md-4 text-center">
                            <p>
                                <i class="fas fa-check-circle" style="margin-right:8px;"></i>
                                Customs Clearing
                            </p>
                        </div>

                        <div class="col-md-4 text-center">
                            <p>
                                <i class="fas fa-check-circle" style="margin-right:8px;"></i>
                                Project Cargo
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ======================================================
     4. PORT AGENCY SERVICES
     ====================================================== -->

<section id="port-agency" class="segment-section">

    <div class="container">

        <div class="segment-header">

            <div class="segment-icon">
                <img
                    src="images/segments/offer-round-four.png"
                    alt="Port Agency Services"
                >
            </div>

            <h2 class="segment-title">PORT AGENCY SERVICES</h2>

            <p class="segment-description">
                Complete port agency solutions at any port in Sri Lanka.
            </p>

        </div>

        <div class="row">

            <div class="col-md-3 col-sm-6">

                <div class="service-card text-center">

                    <div class="icon-circle">
                        <i class="fas fa-ship" style="font-size:28px;color:white;"></i>
                    </div>

                    <h5>Port Agency</h5>

                </div>

            </div>

            <div class="col-md-3 col-sm-6">

                <div class="service-card text-center">

                    <div class="icon-circle">
                        <i class="fas fa-cogs" style="font-size:28px;color:white;"></i>
                    </div>

                    <h5>Ship Chandling</h5>

                </div>

            </div>

            <div class="col-md-3 col-sm-6">

                <div class="service-card text-center">

                    <div class="icon-circle">
                        <i class="fas fa-users" style="font-size:28px;color:white;"></i>
                    </div>

                    <h5>Crew Change</h5>

                </div>

            </div>

            <div class="col-md-3 col-sm-6">

                <div class="service-card text-center">

                    <div class="icon-circle">
                        <i class="fas fa-file-alt" style="font-size:28px;color:white;"></i>
                    </div>

                    <h5>Documentation</h5>

                </div>

            </div>

        </div>

        <div style="margin-top:50px;text-align:center;">
            <a href="port-agency-services.php" class="learn-more-btn">
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

    </div>

</section>


<!-- ======================================================
     5. MARINE TECHNICAL SERVICES
     ====================================================== -->

<section id="marine-technical" class="segment-section">

    <div class="container">

        <div class="segment-header">

            <div class="segment-icon">
                <img
                    src="images/segments/offer-round-three.png"
                    alt="Marine Technical Services"
                >
            </div>

            <h2 class="segment-title">MARINE TECHNICAL SERVICES</h2>

            <p class="segment-description">
                Expert technical solutions for all maritime requirements.
            </p>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="service-card">

                    <h4>Ship Surveys &amp; Inspections</h4>

                    <ul style="list-style:none;padding:0;margin-top:20px;">

                        <li style="margin-bottom:12px;">
                            <i class="fas fa-check-circle" style="margin-right:10px;"></i>
                            Condition Surveys
                        </li>

                        <li style="margin-bottom:12px;">
                            <i class="fas fa-check-circle" style="margin-right:10px;"></i>
                            Damage Surveys
                        </li>

                        <li style="margin-bottom:12px;">
                            <i class="fas fa-check-circle" style="margin-right:10px;"></i>
                            On-hire/Off-hire Surveys
                        </li>

                    </ul>

                </div>

            </div>

            <div class="col-md-6">

                <div class="service-card">

                    <h4>Technical Support</h4>

                    <ul style="list-style:none;padding:0;margin-top:20px;">

                        <li style="margin-bottom:12px;">
                            <i class="fas fa-check-circle" style="margin-right:10px;"></i>
                            Ship's Spares Clearance
                        </li>

                        <li style="margin-bottom:12px;">
                            <i class="fas fa-check-circle" style="margin-right:10px;"></i>
                            Technical Consultancy
                        </li>

                        <li style="margin-bottom:12px;">
                            <i class="fas fa-check-circle" style="margin-right:10px;"></i>
                            Repair Supervision
                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <div style="margin-top:40px;text-align:center;">
            <a href="marine-technical-services.php" class="learn-more-btn">
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

    </div>

</section>


<!-- ======================================================
     6. FOREIGN EMPLOYMENT
     ====================================================== -->

<section id="foreign-employment" class="segment-section">

    <div class="container">

        <div class="segment-header">

            <div class="segment-icon">
                <img
                    src="images/segments/offer-round-six.png"
                    alt="Foreign Employment Agency"
                >
            </div>

            <h2 class="segment-title">FOREIGN EMPLOYMENT AGENCY</h2>

            <p class="segment-description">
                Connecting talent with global maritime opportunities.
            </p>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="service-card">

                    <div class="foreign-service-title-row">

                        <div class="icon-circle foreign-service-icon">
                            <i class="fas fa-globe" style="color:white;font-size:24px;"></i>
                        </div>

                        <h4 style="margin:0;">Global Placements</h4>

                    </div>

                    <p class="foreign-service-description">
                        International job opportunities for maritime professionals in over 30 countries
                    </p>

                </div>

            </div>

            <div class="col-md-6">

                <div class="service-card">

                    <div class="foreign-service-title-row">

                        <div class="icon-circle foreign-service-icon">
                            <i class="fas fa-file-alt" style="color:white;font-size:24px;"></i>
                        </div>

                        <h4 style="margin:0;">Visa &amp; Documentation</h4>

                    </div>

                    <p class="foreign-service-description">
                        Complete assistance with employment documentation and visa processing
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ======================================================
     7. SEAFARER RECRUITMENT
     ====================================================== -->

<section id="seafarer" class="segment-section">

    <div class="container">

        <div class="segment-header">

            <div class="segment-icon">
                <img
                    src="images/segments/offer-round-7.png"
                    alt="Seafarer Recruitment"
                >
            </div>

            <h2 class="segment-title">SEAFARER RECRUITMENT &amp; PLACEMENT</h2>

            <p class="segment-description">
                Professional maritime recruitment services with global reach.
            </p>

        </div>

        <div class="row">

            <div class="col-md-6 col-sm-6">

                <div class="service-card text-center">

                    <h3>2000+</h3>

                    <p>Seafarers Placed</p>

                </div>

            </div>

            <div class="col-md-6 col-sm-6">

                <div class="service-card text-center">

                    <h3>100%</h3>

                    <p>Compliance</p>

                </div>

            </div>

        </div>

        <div style="margin-top:50px;text-align:center;">
            <a
                href="https://globalmarineservices.lk/"
                target="_blank"
                rel="noopener noreferrer"
                class="learn-more-btn"
            >
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

    </div>

</section>


<!-- ======================================================
     8. EDUCATION & TRAINING
     ====================================================== -->

<section id="education" class="segment-section">

    <div class="container">

        <div class="segment-header">

            <div class="segment-icon">
                <img
                    src="images/segments/offer-round-9.png"
                    alt="Education & Training"
                >
            </div>

            <h2 class="segment-title">EDUCATION &amp; TRAINING</h2>

            <p class="segment-description">
                Excellence in maritime education and professional development.
            </p>

        </div>

        <div class="row">

            <div class="col-md-4">

                <div class="service-card text-center">

                    <div class="icon-circle" style="width:85px;height:85px;">
                        <i
                            class="fas fa-graduation-cap"
                            style="font-size:38px;color:white;"
                        ></i>
                    </div>

                    <h4>Maritime Courses</h4>

                    <p>
                        Comprehensive maritime education programs with international certification
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="service-card text-center">

                    <div class="icon-circle" style="width:85px;height:85px;">
                        <i
                            class="fas fa-certificate"
                            style="font-size:38px;color:white;"
                        ></i>
                    </div>

                    <h4>Professional Certification</h4>

                    <p>
                        Internationally recognized certifications for maritime professionals
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="service-card text-center">

                    <div class="icon-circle" style="width:85px;height:85px;">
                        <i
                            class="fas fa-ship"
                            style="font-size:38px;color:white;"
                        ></i>
                    </div>

                    <h4>Practical Training</h4>

                    <p>
                        Hands-on maritime training programs with state-of-the-art simulators
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ======================================================
     FOOTER
     ====================================================== -->

<footer class="footer-inline">

    <div class="container">

        <div class="footer-grid-responsive">

            <div class="footer-offer-container">

                <img
                    src="images/logo/GMG 3L WHITE.png"
                    alt="Global Marine Group"
                    class="footer-offer-logo-img"
                    decoding="async"
                    loading="lazy"
                >

                <div class="footer-social-responsive">

                    <a id="footerLinkedIn" href="#" aria-label="LinkedIn" style="display:none;">
                        <i class="fab fa-linkedin-in"></i>
                    </a>

                    <a id="footerFacebook" href="#" aria-label="Facebook" style="display:none;">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a id="footerInstagram" href="#" aria-label="Instagram" style="display:none;">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a id="footerTikTok" href="#" aria-label="TikTok" style="display:none;">
                        <i class="fab fa-tiktok"></i>
                    </a>

                    <a id="footerYouTube" href="#" aria-label="YouTube" style="display:none;">
                        <i class="fab fa-youtube"></i>
                    </a>

                </div>

            </div>


            <div>

                <h5 class="footer-heading-responsive">Quick Links</h5>

                <ul style="list-style:none;padding:0;margin:0;">

                    <li class="footer-link-item">
                        <a href="about-us.php" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            About Us
                        </a>
                    </li>

                    <li class="footer-link-item">
                        <a href="services.php" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            Services
                        </a>
                    </li>

                    <li class="footer-link-item">
                        <a href="companies.php" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            Companies
                        </a>
                    </li>

                    <li class="footer-link-item">
                        <a href="careers.php" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            Careers
                        </a>
                    </li>

                    <li class="footer-link-item">
                        <a href="contact-us.php" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            Contact Us
                        </a>
                    </li>

                </ul>

            </div>


            <div>

                <h5 class="footer-heading-responsive">Our Services</h5>

                <ul style="list-style:none;padding:0;margin:0;">

                    <li class="footer-link-item">
                        <a href="services.php#liner-shipping" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            Liner Shipping
                        </a>
                    </li>

                    <li class="footer-link-item">
                        <a href="services.php#nvocc" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            NVOCC
                        </a>
                    </li>

                    <li class="footer-link-item">
                        <a href="services.php#freight" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            Freight &amp; Logistics
                        </a>
                    </li>

                    <li class="footer-link-item">
                        <a href="services.php#port-agency" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            Port Agency
                        </a>
                    </li>

                    <li class="footer-link-item">
                        <a href="services.php#marine-technical" class="footer-link-responsive">
                            <i class="fas fa-chevron-right"></i>
                            Marine Technical
                        </a>
                    </li>

                </ul>

            </div>


            <div>

                <h5 class="footer-heading-responsive">Contact Us</h5>

                <ul style="list-style:none;padding:0;margin:0;">

                    <li class="footer-contact-responsive">
                        <i class="fas fa-map-marker-alt"></i>
                        <span id="footerAddress">292 R. A. De Mel Mawatha, Colombo, Sri Lanka</span>
                    </li>

                    <li class="footer-contact-responsive">
                        <i class="fas fa-phone"></i>
                        <a id="footerPhone" href="tel:+94112345678" style="color:inherit;text-decoration:none;">+94 11 2 345 678</a>
                    </li>

                    <li class="footer-contact-responsive">
                        <i class="fas fa-envelope"></i>
                        <a id="footerEmail" href="mailto:info@gmigroup.lk" style="color:inherit;text-decoration:none;">info@gmigroup.lk</a>
                    </li>

                    <li class="footer-contact-responsive">
                        <i class="fas fa-clock"></i>
                        <span id="footerOfficeHours">Mon - Fri: 8:30 AM - 5:30 PM</span>
                    </li>

                </ul>

            </div>


            <div class="footer-great-text">

                <h5 class="footer-heading-responsive">Certified</h5>

                <img
                    src="images/logo/great-place-work-resized.png"
                    alt="Great Place to Work"
                    class="footer-great-logo-img"
                    decoding="async"
                    loading="lazy"
                >

                <p>Proudly certified as a Great Place to Work</p>

            </div>

        </div>


        <div class="footer-bottom-responsive">

            <span class="footer-bottom-text">
                &copy; 2026
                <a
                    href="https://gmigroup.lk/"
                    style="color:#b8d4f0;text-decoration:none;"
                >
                    Global Marine Group
                </a>.
                All rights reserved.
            </span>

            <div class="footer-bottom-links-responsive">

                <a href="#">Privacy Policy</a>

                <span style="color:#4a6a7a;">|</span>

                <a href="#">Terms of Service</a>

                <span style="color:#4a6a7a;">|</span>

                <a href="#">Cookie Policy</a>

            </div>

        </div>

    </div>

</footer>


<script>
(function () {
    'use strict';

    const header = document.querySelector('.gmi-custom-header');
    const mobileNav = document.getElementById('gmiNavMobile');
    const hamburger = document.querySelector('.gmi-hamburger');
    const progressBar = document.getElementById('gmiProgressBar');
    const loader = document.getElementById('loader-wrapper');

    const sections = Array.from(document.querySelectorAll('.segment-section'));
    const dots = Array.from(document.querySelectorAll('.segment-nav-dot'));

    const loaderStartedAt = performance.now();


    /* =====================================================
       HEADER OFFSET
       ===================================================== */

    function syncHeaderOffset() {
        if (header) {
            document.body.style.paddingTop = header.offsetHeight + 'px';
        }
    }


    /* =====================================================
       MOBILE NAV
       ===================================================== */

    window.toggleMobileNav = function () {

        if (!mobileNav) {
            return;
        }

        const isOpen = mobileNav.classList.toggle('open');

        if (hamburger) {
            hamburger.classList.toggle('is-open', isOpen);
            hamburger.setAttribute('aria-expanded', String(isOpen));
        }

        window.setTimeout(syncHeaderOffset, 20);
    };


    if (mobileNav) {

        mobileNav.querySelectorAll('a').forEach(function (link) {

            link.addEventListener('click', function () {

                mobileNav.classList.remove('open');

                if (hamburger) {
                    hamburger.classList.remove('is-open');
                    hamburger.setAttribute('aria-expanded', 'false');
                }

                window.setTimeout(syncHeaderOffset, 20);

            });

        });

    }


    /* =====================================================
       HEADER + PROGRESS BAR
       ===================================================== */

    function updatePageChrome() {

        const scrollTop =
            window.scrollY ||
            document.documentElement.scrollTop;

        const scrollable =
            Math.max(
                document.documentElement.scrollHeight - window.innerHeight,
                1
            );

        if (progressBar) {
            progressBar.style.transform =
                'scaleX(' +
                Math.min(scrollTop / scrollable, 1) +
                ')';
        }

        if (header) {
            header.classList.toggle(
                'gmi-header-scrolled',
                scrollTop > 24
            );
        }
    }


    /* =====================================================
       REVEAL
       ===================================================== */

    function initializeReveal() {

        const revealElements =
            document.querySelectorAll(
                '.segment-header, .service-card, .learn-more-btn'
            );

        revealElements.forEach(function (element, index) {

            element.classList.add('premium-reveal');

            element.style.setProperty(
                '--premium-delay',
                Math.min(index % 5, 4) * 70 + 'ms'
            );

        });


        if (!('IntersectionObserver' in window)) {

            revealElements.forEach(function (element) {
                element.classList.add('premium-visible');
            });

            return;
        }


        const observer =
            new IntersectionObserver(
                function (entries, currentObserver) {

                    entries.forEach(function (entry) {

                        if (entry.isIntersecting) {

                            entry.target.classList.add(
                                'premium-visible'
                            );

                            currentObserver.unobserve(
                                entry.target
                            );
                        }

                    });

                },
                {
                    threshold: 0.12,
                    rootMargin: '0px 0px -6% 0px'
                }
            );


        revealElements.forEach(function (element) {
            observer.observe(element);
        });
    }


    /* =====================================================
       POINTER GLOW
       ===================================================== */

    function initializePointerGlow() {

        if (
            !window.matchMedia(
                '(hover: hover) and (pointer: fine)'
            ).matches
        ) {
            return;
        }


        document
            .querySelectorAll(
                '.service-card, .segment-section > .container'
            )
            .forEach(function (card) {

                card.addEventListener(
                    'pointermove',
                    function (event) {

                        const rect =
                            card.getBoundingClientRect();

                        card.style.setProperty(
                            '--mouse-x',
                            (
                                (
                                    event.clientX -
                                    rect.left
                                ) /
                                rect.width *
                                100
                            ) + '%'
                        );

                        card.style.setProperty(
                            '--mouse-y',
                            (
                                (
                                    event.clientY -
                                    rect.top
                                ) /
                                rect.height *
                                100
                            ) + '%'
                        );

                    }
                );

            });
    }


    /* =====================================================
       FIXED BACKGROUND CROSS-FADE
       ===================================================== */

    function initializeServiceBackgrounds() {

        const stage = document.getElementById('servicesBackgroundStage');
        const layerA = document.getElementById('servicesBackgroundLayerA');
        const layerB = document.getElementById('servicesBackgroundLayerB');

        if (!stage || !layerA || !layerB || !sections.length) {
            return;
        }

        const backgrounds = {
            'liner-shipping':
                'https://images.unsplash.com/photo-1773952984178-f91248ce704f?auto=format&fit=crop&w=2000&q=82',

            'nvocc':
                'https://images.unsplash.com/photo-1774929104515-ac1b747a8c4c?auto=format&fit=crop&w=2000&q=82',

            'freight':
                'https://images.unsplash.com/photo-1773126379692-342ff516ea53?auto=format&fit=crop&w=2000&q=82',

            'port-agency':
                'https://images.unsplash.com/photo-1765206257996-9b4a5d886a2c?auto=format&fit=crop&w=2000&q=82',

            'marine-technical':
                'https://images.unsplash.com/photo-1685720543547-cc4873188c75?auto=format&fit=crop&w=2000&q=82',

            'foreign-employment':
                'https://images.unsplash.com/photo-1770838517425-1eb24d8b3d5c?auto=format&fit=crop&w=2000&q=82',

            'seafarer':
                'https://images.unsplash.com/photo-1776661616822-ba34fe4e5638?auto=format&fit=crop&w=2000&q=82',

            'education':
                'https://images.unsplash.com/photo-1768306662347-57d79c8e0d8f?auto=format&fit=crop&w=2000&q=82'
        };

        let activeId = sections[0].id;
        let visibleLayer = layerA;
        let hiddenLayer = layerB;

        layerA.style.backgroundImage =
            'url("' + backgrounds[activeId] + '")';

        /* Preload images to avoid flashing during transitions */
        Object.values(backgrounds).forEach(function (url) {
            const image = new Image();
            image.src = url;
        });


        window.gmiSetServiceBackground = function (id) {

            if (!backgrounds[id] || id === activeId) {
                return;
            }

            activeId = id;

            hiddenLayer.style.backgroundImage =
                'url("' + backgrounds[id] + '")';

            /* Force browser to register the new image before transition */
            void hiddenLayer.offsetWidth;

            hiddenLayer.classList.add('is-visible');
            visibleLayer.classList.remove('is-visible');

            const oldVisible = visibleLayer;
            visibleLayer = hiddenLayer;
            hiddenLayer = oldVisible;
        };
    }


    /* =====================================================
       SIDE NAV ACTIVE DOT
       ===================================================== */

    function setActiveDot(id) {

        dots.forEach(function (dot) {

            dot.classList.toggle(
                'active',
                dot.dataset.target === id
            );

        });
    }


    function updateActiveService() {

        if (!sections.length) {
            return;
        }

        const focus =
            window.innerHeight * 0.48;

        let selected = sections[0];
        let distance = Infinity;


        sections.forEach(function (section) {

            const rect =
                section.getBoundingClientRect();


            if (
                rect.top <= focus &&
                rect.bottom > focus
            ) {

                selected = section;
                distance = 0;
                return;
            }


            const currentDistance =
                Math.abs(
                    rect.top +
                    rect.height / 2 -
                    focus
                );


            if (currentDistance < distance) {

                distance = currentDistance;
                selected = section;
            }

        });


        if (selected) {
            setActiveDot(selected.id);

            if (typeof window.gmiSetServiceBackground === 'function') {
                window.gmiSetServiceBackground(selected.id);
            }
        }
    }


    let serviceTicking = false;

    function requestServiceUpdate() {

        if (!serviceTicking) {

            serviceTicking = true;

            window.requestAnimationFrame(
                function () {

                    serviceTicking = false;
                    updateActiveService();

                }
            );
        }
    }


    /* =====================================================
       DOT CLICK SCROLL
       ===================================================== */

    dots.forEach(function (dot) {

        dot.addEventListener(
            'click',
            function () {

                const target =
                    document.getElementById(
                        dot.dataset.target
                    );


                if (target) {

                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }

            }
        );

    });


    /* =====================================================
       INITIALIZE
       ===================================================== */

    function initialize() {

        syncHeaderOffset();
        updatePageChrome();
        initializeReveal();
        initializePointerGlow();
        initializeServiceBackgrounds();
        updateActiveService();

    }


    document.addEventListener(
        'DOMContentLoaded',
        initialize
    );


    window.addEventListener(
        'resize',
        function () {

            syncHeaderOffset();
            requestServiceUpdate();

        }
    );


    window.addEventListener(
        'scroll',
        function () {

            updatePageChrome();
            requestServiceUpdate();

        },
        { passive: true }
    );


    /* =====================================================
       LOADER COMPLETE
       ===================================================== */

    window.addEventListener(
        'load',
        function () {

            syncHeaderOffset();
            updatePageChrome();
            updateActiveService();

            const minimumLoaderTime = 900;

            const elapsed =
                performance.now() -
                loaderStartedAt;

            const remaining =
                Math.max(
                    0,
                    minimumLoaderTime - elapsed
                );


            window.setTimeout(
                function () {

                    if (loader) {
                        loader.classList.add(
                            'gmi-loaded'
                        );
                    }

                    document.body.classList.remove(
                        'gmi-loading'
                    );

                    document.documentElement.classList.remove(
                        'gmi-loading-root'
                    );

                },
                remaining
            );

        }
    );

})();
</script>


<script>
/* =========================================================
   FOOTER CONTACT ONLY
   Loads admin-managed footer details without bootstrapping
   this Services page, so existing backgrounds/loader remain
   exactly as in the original page.
   ========================================================= */
(function () {
    'use strict';

    function setText(id, value) {
        var element = document.getElementById(id);
        if (element && typeof value === 'string' && value.trim() !== '') {
            element.textContent = value;
        }
    }

    function setSocial(id, url) {
        var element = document.getElementById(id);
        if (!element) return;

        if (typeof url === 'string' && /^https?:\/\//i.test(url.trim())) {
            element.href = url.trim();
            element.target = '_blank';
            element.rel = 'noopener noreferrer';
            element.style.display = 'flex';
        } else {
            element.style.display = 'none';
        }
    }

    fetch('footer-contact-public.php', {
        method: 'GET',
        credentials: 'same-origin',
        cache: 'no-store',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Footer contact request failed');
        }
        return response.json();
    })
    .then(function (payload) {
        if (!payload || payload.success !== true || !payload.data) {
            return;
        }

        var data = payload.data;

        setText('footerAddress', data.address || '');
        setText('footerOfficeHours', data.office_hours || '');

        var phone = document.getElementById('footerPhone');
        if (phone && typeof data.phone === 'string' && data.phone.trim() !== '') {
            phone.textContent = data.phone;
            phone.href = 'tel:' + data.phone.replace(/[^0-9+]/g, '');
        }

        var email = document.getElementById('footerEmail');
        if (email && typeof data.email === 'string' && data.email.trim() !== '') {
            email.textContent = data.email;
            email.href = 'mailto:' + data.email.trim();
        }

        setSocial('footerLinkedIn', data.linkedin_url || '');
        setSocial('footerFacebook', data.facebook_url || '');
        setSocial('footerInstagram', data.instagram_url || '');
        setSocial('footerTikTok', data.tiktok_url || '');
        setSocial('footerYouTube', data.youtube_url || '');
    })
    .catch(function () {
        /* Keep the original footer fallback values if the API is unavailable. */
    });
})();
</script>

</body>
</html>