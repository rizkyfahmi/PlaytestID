{{--
Tester Dashboard — Testoplay
Panel : Tester (path /tester)
Page : TesterDashboard.php
Fonts : Plus Jakarta Sans (heading), JetBrains Mono (angka), Inter (body)
--}}

<x-filament-panels::page>

    @push('styles')
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link
                href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
                rel="stylesheet">
            <link rel="stylesheet"
                href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

            <style>
                /* ══════════════════════════════════════  
           FONTS  
        ══════════════════════════════════════ */
                .tsr-page,
                .tsr-page * {
                    font-family: 'Inter', sans-serif;
                }

                .font-heading {
                    font-family: 'Plus Jakarta Sans', sans-serif !important;
                }

                .font-mono-num {
                    font-family: 'Inter', sans-serif !important;
                    font-variant-numeric: tabular-nums;
                }

                /* ══════════════════════════════════════  
           PROGRESS BAR  
        ══════════════════════════════════════ */
                .tsr-progress-track {
                    height: 6px;
                    background: #e2e8f0;
                    border-radius: 9999px;
                    overflow: hidden;
                }

                .tsr-progress-fill {
                    height: 100%;
                    border-radius: 9999px;
                    transition: width 1s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                /* ══════════════════════════════════════  
           MISSION CARDS  
        ══════════════════════════════════════ */
                .tsr-mission-card {
                    background: #ffffff;
                    border-radius: 1rem;
                    padding: 1rem;
                    border: 1px solid #e2e8f0;
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                    transition: box-shadow 0.2s ease, transform 0.2s ease;
                }

                .tsr-mission-card:hover {
                    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
                    transform: translateY(-2px);
                }

                /* ══════════════════════════════════════  
           APP LIST ITEMS  
        ══════════════════════════════════════ */
                .tsr-app-item {
                    padding: 1rem 1.25rem;
                    border-bottom: 1px solid #f1f5f9;
                    transition: background 0.15s ease;
                }

                .tsr-app-item:hover {
                    background: #fafafa;
                }

                .tsr-app-item:last-child {
                    border-bottom: none;
                }

                /* ══════════════════════════════════════  
           BUTTONS  
        ══════════════════════════════════════ */
                .tsr-btn-apply {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 8px 16px;
                    border-radius: 0.75rem;
                    font-size: 0.8125rem;
                    font-weight: 600;
                    color: #ffffff;
                    background: #ffd900;
                    cursor: pointer;
                    box-shadow: 0 4px 12px rgba(255, 217, 0, 0.25);
                    transition: all 0.15s ease;
                    border: none;
                    white-space: nowrap;
                }

                .tsr-btn-apply:hover {
                    background: #ca8a04;
                    box-shadow: 0 6px 16px rgba(255, 217, 0, 0.35);
                }

                .tsr-btn-apply:disabled {
                    background: #94a3b8 !important;
                    box-shadow: none !important;
                    cursor: not-allowed !important;
                    opacity: 0.7;
                }

                .tsr-btn-submit {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 6px 12px;
                    border-radius: 0.75rem;
                    font-size: 0.75rem;
                    font-weight: 600;
                    color: #475569;
                    background: #f8fafc;
                    cursor: pointer;
                    border: 1px solid #e2e8f0;
                    transition: all 0.15s ease;
                }

                .tsr-btn-submit:hover {
                    background: #f1f5f9;
                }

                .tsr-btn-laporkan {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 6px 12px;
                    border-radius: 0.75rem;
                    font-size: 0.75rem;
                    font-weight: 600;
                    color: #ffd900;
                    background: rgba(255, 217, 0, 0.08);
                    cursor: pointer;
                    border: 1px solid rgba(255, 217, 0, 0.25);
                    transition: all 0.15s ease;
                }

                .tsr-btn-laporkan:hover {
                    background: rgba(255, 217, 0, 0.15);
                }

                /* ══════════════════════════════════════  
           FILTER TABS  
        ══════════════════════════════════════ */
                .tsr-filter-active {
                    background: #fefce8;
                    color: #ffd900;
                    border: 1px solid #fef08a;
                    font-weight: 600;
                    font-size: 0.75rem;
                    padding: 6px 12px;
                    border-radius: 0.75rem;
                    cursor: pointer;
                    transition: all 0.15s ease;
                }

                .tsr-filter-inactive {
                    background: #f8fafc;
                    color: #64748b;
                    border: 1px solid #e2e8f0;
                    font-weight: 600;
                    font-size: 0.75rem;
                    padding: 6px 12px;
                    border-radius: 0.75rem;
                    cursor: pointer;
                    transition: all 0.15s ease;
                }

                .tsr-filter-inactive:hover {
                    background: #f1f5f9;
                    color: #1e293b;
                }

                /* ====== Animations ====== */
                @keyframes prof-float {

                    0%,
                    100% {
                        transform: translate(0, 0) scale(1)
                    }

                    50% {
                        transform: translate(20px, -15px) scale(1.08)
                    }
                }

                @keyframes prof-float-rev {

                    0%,
                    100% {
                        transform: translate(0, 0) scale(1)
                    }

                    50% {
                        transform: translate(-25px, 20px) scale(0.92)
                    }
                }

                

                    50% {
                        background-position: 100% 50%
                    }
                }

                @keyframes prof-shimmer {
                    0% {
                        transform: translateX(-100%)
                    }

                    100% {
                        transform: translateX(200%)
                    }
                }

                @keyframes prof-pulse-ring {
                    0% {
                        box-shadow: 0 0 0 0 rgba(52, 211, 153, .6)
                    }

                    70% {
                        box-shadow: 0 0 0 10px rgba(52, 211, 153, 0)
                    }

                    100% {
                        box-shadow: 0 0 0 0 rgba(52, 211, 153, 0)
                    }
                }

                @keyframes prof-fade-up {
                    from {
                        opacity: 0;
                        transform: translateY(20px)
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0)
                    }
                }

                @keyframes prof-scale-in {
                    from {
                        opacity: 0;
                        transform: scale(.95)
                    }

                    to {
                        opacity: 1;
                        transform: scale(1)
                    }
                }

                @keyframes prof-spin-slow {
                    from {
                        transform: rotate(0)
                    }

                    to {
                        transform: rotate(360deg)
                    }
                }

                @keyframes prof-spin-rev {
                    from {
                        transform: rotate(360deg)
                    }

                    to {
                        transform: rotate(0)
                    }
                }

                @keyframes prof-bounce-soft {

                    0%,
                    100% {
                        transform: translateY(0)
                    }

                    50% {
                        transform: translateY(-4px)
                    }
                }

                /* ====== Live background animations ====== */
                @keyframes prof-aurora {
                    0% {
                        transform: translate(-10%, -10%) rotate(0deg) scale(1.1);
                    }

                    33% {
                        transform: translate(8%, -6%) rotate(120deg) scale(1.25);
                    }

                    66% {
                        transform: translate(-6%, 10%) rotate(240deg) scale(1.15);
                    }

                    100% {
                        transform: translate(-10%, -10%) rotate(360deg) scale(1.1);
                    }
                }

                @keyframes prof-conic {
                    to {
                        transform: rotate(360deg);
                    }
                }

                @keyframes prof-grid-pan {
                    0% {
                        background-position: 0 0, 0 0;
                    }

                    100% {
                        background-position: 56px 56px, 56px 56px;
                    }
                }

                @keyframes prof-particle {
                    0% {
                        transform: translateY(0) translateX(0);
                        opacity: 0;
                    }

                    10% {
                        opacity: .9;
                    }

                    90% {
                        opacity: .9;
                    }

                    100% {
                        transform: translateY(-220px) translateX(var(--drift, 20px));
                        opacity: 0;
                    }
                }

                @keyframes prof-shoot {
                    0% {
                        transform: translate3d(0, 0, 0) rotate(18deg);
                        opacity: 0;
                    }

                    8% {
                        opacity: 1;
                    }

                    100% {
                        transform: translate3d(620px, 200px, 0) rotate(18deg);
                        opacity: 0;
                    }
                }

                @keyframes prof-wave {
                    0% {
                        transform: translateX(0);
                    }

                    100% {
                        transform: translateX(-50%);
                    }
                }

                @keyframes prof-scan {
                    0% {
                        transform: translateY(-100%);
                        opacity: 0;
                    }

                    20% {
                        opacity: .55;
                    }

                    80% {
                        opacity: .55;
                    }

                    100% {
                        transform: translateY(420%);
                        opacity: 0;
                    }
                }

                @keyframes prof-twinkle {

                    0%,
                    100% {
                        opacity: .2;
                        transform: scale(1);
                    }

                    50% {
                        opacity: 1;
                        transform: scale(1.6);
                    }
                }

                .prof-hero {
                    background: #ffd900 !important;
                    border: 1px solid #e6c400 !important;
                    color: #111111 !important;
                    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
                    isolation: isolate;
                }

                html.dark .prof-hero,
                .dark .prof-hero {
                    background: #1a1a18 !important;
                    border: 1px solid #2e2e2e !important;
                    color: #ffffff !important;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4) !important;
                }

                /* Light Mode element styles */
                .prof-hero .hero-label {
                    color: #111111 !important;
                    opacity: 0.75;
                    font-weight: 700;
                }
                .prof-hero .hero-value {
                    color: #111111 !important;
                    font-weight: 900;
                }
                .prof-hero .hero-unit {
                    color: #111111 !important;
                    font-weight: 800;
                    opacity: 0.85;
                }
                .prof-hero .hero-pill {
                    background: rgba(0, 0, 0, 0.08) !important;
                    color: #111111 !important;
                    border: 1px solid rgba(0, 0, 0, 0.14) !important;
                    font-weight: 600;
                }
                .prof-hero .hero-pill-dark {
                    background: #111111 !important;
                    color: #ffd900 !important;
                    font-weight: 800;
                    border: none !important;
                }
                .prof-hero .hero-btn-secondary {
                    background: rgba(0, 0, 0, 0.08) !important;
                    color: #111111 !important;
                    border: 1px solid rgba(0, 0, 0, 0.16) !important;
                    font-weight: 700;
                }
                .prof-hero .hero-btn-secondary:hover {
                    background: rgba(0, 0, 0, 0.16) !important;
                }
                .prof-hero .hero-btn-primary {
                    background: #111111 !important;
                    color: #ffffff !important;
                    border: 1px solid #111111 !important;
                    font-weight: 800;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
                }
                .prof-hero .hero-btn-primary:hover {
                    background: #262626 !important;
                    color: #ffffff !important;
                }
                .prof-hero .hero-stat-value {
                    color: #111111 !important;
                    font-weight: 800;
                }
                .prof-hero .hero-stat-label {
                    color: #111111 !important;
                    opacity: 0.75;
                    font-weight: 600;
                }
                .prof-hero .hero-divider {
                    background: rgba(0, 0, 0, 0.15) !important;
                }
                .prof-hero .hero-border-divider {
                    border-color: rgba(0, 0, 0, 0.15) !important;
                }
                .prof-hero .hero-badge-box {
                    background: rgba(0, 0, 0, 0.08) !important;
                    border: 1px solid rgba(0, 0, 0, 0.16) !important;
                    color: #111111 !important;
                }

                /* Dark Mode element styles */
                html.dark .prof-hero .hero-label,
                .dark .prof-hero .hero-label {
                    color: #94a3b8 !important;
                    opacity: 1;
                    font-weight: 700;
                }
                html.dark .prof-hero .hero-value,
                .dark .prof-hero .hero-value {
                    color: #ffffff !important;
                    font-weight: 900;
                }
                html.dark .prof-hero .hero-unit,
                .dark .prof-hero .hero-unit {
                    color: #ffd900 !important;
                    font-weight: 800;
                    opacity: 1;
                }
                html.dark .prof-hero .hero-pill,
                .dark .prof-hero .hero-pill {
                    background: #242424 !important;
                    color: #cbd5e1 !important;
                    border: 1px solid #333333 !important;
                    font-weight: 600;
                }
                html.dark .prof-hero .hero-pill-dark,
                .dark .prof-hero .hero-pill-dark {
                    background: #ffd900 !important;
                    color: #111111 !important;
                    font-weight: 800;
                    border: none !important;
                }
                html.dark .prof-hero .hero-btn-secondary,
                .dark .prof-hero .hero-btn-secondary {
                    background: #242424 !important;
                    color: #ffffff !important;
                    border: 1px solid #333333 !important;
                    font-weight: 700;
                }
                html.dark .prof-hero .hero-btn-secondary:hover,
                .dark .prof-hero .hero-btn-secondary:hover {
                    background: #2e2e2e !important;
                }
                html.dark .prof-hero .hero-btn-primary,
                .dark .prof-hero .hero-btn-primary {
                    background: #ffd900 !important;
                    color: #111111 !important;
                    border: 1px solid #ffd900 !important;
                    font-weight: 800;
                }
                html.dark .prof-hero .hero-btn-primary:hover,
                .dark .prof-hero .hero-btn-primary:hover {
                    background: #e6c400 !important;
                }
                html.dark .prof-hero .hero-stat-value,
                .dark .prof-hero .hero-stat-value {
                    color: #ffffff !important;
                    font-weight: 800;
                }
                html.dark .prof-hero .hero-stat-label,
                .dark .prof-hero .hero-stat-label {
                    color: #94a3b8 !important;
                    opacity: 1;
                    font-weight: 600;
                }
                html.dark .prof-hero .hero-divider,
                .dark .prof-hero .hero-divider {
                    background: #2e2e2e !important;
                }
                html.dark .prof-hero .hero-border-divider,
                .dark .prof-hero .hero-border-divider {
                    border-color: #2e2e2e !important;
                }
                html.dark .prof-hero .hero-badge-box,
                .dark .prof-hero .hero-badge-box {
                    background: #242424 !important;
                    border: 1px solid #333333 !important;
                    color: #ffd900 !important;
                }
                html.dark .prof-hero .hero-badge-box .hero-stat-value,
                .dark .prof-hero .hero-badge-box .hero-stat-value {
                    color: #ffd900 !important;
                }
                html.dark .prof-hero .hero-badge-box svg,
                .dark .prof-hero .hero-badge-box svg {
                    color: #ffd900 !important;
                }
                html.dark .prof-hero .hero-badge-box .hero-stat-label,
                .dark .prof-hero .hero-badge-box .hero-stat-label {
                    color: #94a3b8 !important;
                }

                /* Disable all glowing/aurora/shining animations permanently */
                .prof-aurora,
                .prof-conic,
                .prof-conic-2,
                .prof-stars,
                .prof-particles,
                .prof-shoot,
                .prof-waves,
                .prof-scan,
                .prof-blob,
                .prof-blob-rev {
                    display: none !important;
                }

                .prof-blob {
                    animation: prof-float 9s ease-in-out infinite;
                    will-change: transform;
                    filter: blur(2px);
                }

                .prof-blob-rev {
                    animation: prof-float-rev 11s ease-in-out infinite;
                    will-change: transform;
                    filter: blur(2px);
                }

                /* Aurora mesh */
                .prof-aurora {
                    position: absolute;
                    inset: -30%;
                    background: none;
filter: blur(40px);
                    animation: prof-aurora 22s ease-in-out infinite;
                    mix-blend-mode: screen;
                    pointer-events: none;
                }

                /* Slow rotating conic glow */
                .prof-conic {
                    position: absolute;
                    width: 520px;
                    height: 520px;
                    left: -160px;
                    bottom: -200px;
                    background: none;
border-radius: 50%;
                    filter: blur(30px);
                    animation: prof-conic 28s linear infinite;
                    opacity: .7;
                    pointer-events: none;
                }

                .prof-conic-2 {
                    position: absolute;
                    width: 380px;
                    height: 380px;
                    right: -120px;
                    top: -140px;
                    background: none;
border-radius: 50%;
                    filter: blur(30px);
                    animation: prof-spin-rev 34s linear infinite;
                    opacity: .6;
                    pointer-events: none;
                }

                .prof-grid-bg {
                    background-image:
                        #ffd900,
                        #ffd900;
                    background-size: 28px 28px;
                    mask-image: none;
                    animation: prof-grid-pan 18s linear infinite;
                }

                /* Floating particles */
                .prof-particles {
                    position: absolute;
                    inset: 0;
                    overflow: hidden;
                    pointer-events: none;
                }

                .prof-particles span {
                    position: absolute;
                    bottom: -10px;
                    width: 6px;
                    height: 6px;
                    border-radius: 50%;
                    background: none;
box-shadow: 0 0 12px rgba(255, 255, 255, .7);
                    animation: prof-particle linear infinite;
                    opacity: 0;
                }

                /* Twinkling stars */
                .prof-stars {
                    position: absolute;
                    inset: 0;
                    pointer-events: none;
                }

                .prof-stars span {
                    position: absolute;
                    width: 2px;
                    height: 2px;
                    border-radius: 50%;
                    background: #fff !important;
                    box-shadow: 0 0 6px #fff !important;
                    animation: prof-twinkle 3s ease-in-out infinite;
                }

                /* Shooting star */
                .prof-shoot {
                    position: absolute;
                    top: 18%;
                    left: -20%;
                    width: 120px;
                    height: 2px;
                    background: transparent;
                    filter: drop-shadow(0 0 6px rgba(147, 197, 253, .9));
                    border-radius: 2px;
                    animation: prof-shoot 7s ease-in infinite;
                    animation-delay: -2s;
                    opacity: 0;
                    pointer-events: none;
                }

                .prof-shoot.s2 {
                    top: 55%;
                    animation-duration: 9s;
                    animation-delay: -5s;
                    opacity: 0;
                }

                /* Wave bottom */
                .prof-waves {
                    position: absolute;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    height: 80px;
                    overflow: hidden;
                    pointer-events: none;
                    opacity: .35;
                    mask-image: #ffd900;
                }

                .prof-waves svg {
                    width: 200%;
                    height: 100%;
                    display: block;
                    animation: prof-wave 14s linear infinite;
                }

                .prof-waves.w2 svg {
                    animation-duration: 22s;
                    opacity: .6;
                }

                /* Scanline sweep */
                .prof-scan {
                    position: absolute;
                    left: 0;
                    right: 0;
                    top: 0;
                    height: 25%;
                    background: #ffd900;
                    animation: prof-scan 9s ease-in-out infinite;
                    pointer-events: none;
                }

                @media (prefers-reduced-motion: reduce) {

                    .prof-hero,
                    .prof-blob,
                    .prof-blob-rev,
                    .prof-aurora,
                    .prof-conic,
                    .prof-conic-2,
                    .prof-grid-bg,
                    .prof-particles span,
                    .prof-shoot,
                    .prof-waves svg,
                    .prof-scan,
                    .prof-stars span {
                        animation: none !important;
                    }
                }
            </style>
    @endpush

    @php
        if ($userBadgeCount <= 5) {
            $tierName = __('Tester Beginner');
        } elseif ($userBadgeCount <= 50) {
            $tierName = __('Tester Intermediate');
        } else {
            $tierName = __('Tester Master');
        }
    @endphp

    <div class="tsr-page" x-data="testerDashboard(@js($aplikasiList))" x-init="animateBars()">

        <div class="px-6 py-6">

            {{-- ══════════════════════════════════════
            HERO — KARTU SALDO KOMISI
            ══════════════════════════════════════ --}}
            <div data-design-id="points-card"
                class="prof-hero w-full rounded-3xl p-6 sm:p-8 mb-6 relative overflow-hidden">

                {{-- Konten utama --}}
                <div class="relative z-10 flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <p class="hero-label text-xs uppercase tracking-widest mb-1"
                            style="letter-spacing:0.12em;">{{ __('Saldo Komisi') }}</p>
                        <div class="flex items-baseline gap-1.5 mb-2">
                            <span class="hero-unit text-2xl font-black">Rp</span>
                            <span class="hero-value font-mono-num"
                                style="font-size:44px;line-height:1;">{{ number_format($totalSaldo, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="hero-pill-dark inline-flex items-center gap-1.5 text-xs px-3 py-1.5 rounded-full">
                                ⭐ {{ $tierName }}
                            </span>
                            <span class="hero-pill inline-flex items-center gap-1 text-xs px-2.5 py-1.5 rounded-full">
                                {{ $userBadgeCount }} {{ __('lencana diraih') }}
                            </span>
                            <span class="hero-pill inline-flex items-center gap-1 text-xs px-2.5 py-1.5 rounded-full">
                                +Rp {{ number_format($komisiPending, 0, ',', '.') }} {{ __('pending') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 flex-wrap">
                        <a href="{{ \App\Filament\Tester\Pages\HistoryMisi::getUrl() }}"
                            class="hero-btn-secondary flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm transition"
                            style="text-decoration:none !important;">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ __('Riwayat') }}
                        </a>
                        <a href="{{ \App\Filament\Tester\Pages\Dompet::getUrl() }}"
                            class="hero-btn-primary flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm transition"
                            style="text-decoration:none !important;">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            {{ __('Tarik Komisi') }}
                        </a>
                    </div>
                </div>

                {{-- Mini stats --}}
                <div class="relative z-10 grid grid-cols-2 sm:flex sm:items-center gap-4 sm:gap-6 mt-5 pt-4 border-t hero-border-divider">
                    <div>
                        <p class="hero-stat-value font-mono-num text-lg">{{ $misiSelesai }}</p>
                        <p class="hero-stat-label text-xs">{{ __('Misi Selesai') }}</p>
                    </div>
                    <div class="hidden sm:block w-px h-8 hero-divider"></div>
                    <div>
                        <p class="hero-stat-value font-mono-num text-lg">{{ $rating }}</p>
                        <p class="hero-stat-label text-xs">{{ __('Rating') }}</p>
                    </div>
                    <div class="hidden sm:block w-px h-8 hero-divider"></div>

                    {{-- HIGHTLIGHT BADGE COLUMN --}}
                    <div class="hero-badge-box col-span-2 sm:col-span-1 px-4 py-2 rounded-2xl sm:scale-105 shadow-sm">
                        <p class="hero-stat-value font-mono-num text-xl flex items-center gap-1.5 leading-none">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5"
                                style="display: inline-block; vertical-align: middle;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.643 12.984l-1.18 2.044a2.5 2.5 0 01-2.222 1.344H7.759a2.5 2.5 0 01-2.222-1.344l-1.18-2.044a2.5 2.5 0 010-2.5l1.18-2.044A2.5 2.5 0 017.759 7.07h8.482a2.5 2.5 0 012.222 1.344l1.18 2.044a2.5 2.5 0 010 2.5z" />
                            </svg>
                            <span>{{ $userBadgeCount }}</span>
                        </p>
                        <p class="hero-stat-label text-[9px] uppercase tracking-wider mt-0.5">{{ __('Lencana') }}</p>
                    </div>

                    <div class="hidden sm:block w-px h-8 hero-divider"></div>
                    <div>
                        <p class="hero-stat-value font-mono-num text-lg">{{ $misiAktif }}</p>
                        <p class="hero-stat-label text-xs">{{ __('Aktif Sekarang') }}</p>
                    </div>
                    <div class="hidden sm:block w-px h-8 hero-divider"></div>
                    <div>
                        <p class="hero-stat-value font-mono-num text-lg">{{ $totalMisi }}</p>
                        <p class="hero-stat-label text-xs">{{ __('Total Misi') }}</p>
                    </div>
                </div>
            </div>{{-- end points card --}}


            {{-- ══════════════════════════════════════
            MISI AKTIF
            ══════════════════════════════════════ --}}
            <div data-design-id="missions-section" class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-base font-bold font-heading" style="color:#1e293b;">{{ __('Misi Aktif Saya') }}
                        </h2>
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">
                            {{ __(':count misi sedang berjalan', ['count' => count($misiAktifList)]) }}</p>
                    </div>
                    <a href="/tester/misi-saya" class="text-sm font-semibold flex items-center gap-1" style="color:#ffd900;">
                        {{ __('Lihat Semua') }}
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($misiAktifList as $misi)
                        <div data-design-id="mission-card-{{ $loop->iteration }}" class="tsr-mission-card">

                            {{-- Header: icon + nama + status --}}
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    @if($misi['logo'])
                                        <img src="/storage/{{ $misi['logo'] }}" alt="Logo"
                                            class="w-11 h-11 rounded-xl object-cover shadow-sm flex-shrink-0">
                                    @else
                                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                                            style="background:{{ $misi['gradient'] }};">
                                            <span class="text-white font-bold text-sm">{{ $misi['inisial'] }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <a href="/tester/misi-detail?misi_id={{ $misi['id'] }}"
                                            class="text-sm font-bold font-heading hover:underline"
                                            style="color:#1e293b;">{{ $misi['nama'] }}</a>
                                        <p class="text-xs" style="color:#64748b;">{{ $misi['penyelenggara'] }}</p>
                                    </div>
                                </div>
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-lg"
                                    style="background:#f0fdf4;color:#16a34a;">{{ __($misi['status']) }}</span>
                            </div>

                            {{-- Jadwal & Lokasi Pengujian Fisik yang Ditentukan Dev --}}
                            <div class="mb-3 p-2.5 rounded-xl bg-slate-50 dark:bg-[#141413] border border-slate-100 dark:border-[#2a2a26]">
                                <div class="flex items-center gap-2 text-xs font-bold text-slate-800 dark:text-neutral-200">
                                    <svg class="w-4 h-4 text-[#ffd900] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $misi['jadwalTanggal'] }} &bull; {{ $misi['jadwalWaktu'] }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-[11px] text-slate-500 dark:text-neutral-400 mt-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="truncate">{{ $misi['lokasi'] }}</span>
                                </div>
                            </div>

                            {{-- Footer: reward + aksi --}}
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" style="color:#10b981;">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-xs font-semibold" style="color:#10b981;">+Rp {{ number_format($misi['komisi'], 0, ',', '.') }}</span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="/tester/misi-detail?misi_id={{ $misi['id'] }}"
                                        class="px-3 py-1.5 rounded-xl text-xs font-bold text-slate-600 dark:text-neutral-300 bg-slate-100 hover:bg-slate-200 dark:bg-[#242424] dark:hover:bg-[#2e2e2e] transition-colors flex items-center gap-1.5"
                                        style="text-decoration:none;">
                                        {{ __('Detail') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>{{-- end misi aktif --}}


            {{-- ══════════════════════════════════════
            APLIKASI TERSEDIA
            ══════════════════════════════════════ --}}
            <div data-design-id="available-section" class="mb-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                    <div class="w-full md:w-auto">
                        <h2 class="text-base font-bold font-heading" style="color:#1e293b;">
                            {{ __('Aplikasi Tersedia untuk Diuji') }}</h2>
                        <p class="text-xs mt-0.5" style="color:#94a3b8;">
                            <span x-text="filteredApps.length"></span> {{ __('slot terbuka • Lamar sekarang') }}</p>
                    </div>

                    {{-- Search & 1 Dropdown Filter dengan Icon Corong --}}
                    <div class="flex items-center gap-2.5 flex-wrap w-full md:w-auto mt-1 md:mt-0">
                        {{-- Search Input (Pencarian Bebas) --}}
                        <div class="relative min-w-[190px] sm:w-60">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </span>
                            <input type="text" x-model="searchQuery" placeholder="{{ __('Cari aplikasi...') }}"
                                style="padding-left: 2.25rem !important; padding-right: 2rem !important;"
                                class="w-full h-9 py-1.5 text-xs rounded-xl border border-slate-200 dark:border-[#2a2a26] bg-white dark:bg-[#1a1a18] text-slate-800 dark:text-neutral-100 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-[#ffd900] shadow-xs transition-colors">
                            <button type="button" x-show="searchQuery" @click="searchQuery = ''" class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-neutral-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        {{-- 1 Dropdown Filter dengan Icon/Logo Filter Corong --}}
                        <div class="relative inline-block text-left" x-data="{ openDropdown: false }">
                            <button type="button" 
                                @click="openDropdown = !openDropdown" 
                                @click.outside="openDropdown = false"
                                class="inline-flex items-center gap-2 h-9 px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white dark:bg-[#1a1a18] text-slate-700 dark:text-neutral-200 border border-slate-200 dark:border-[#2a2a26] hover:bg-slate-50 dark:hover:bg-[#252522] transition-all shadow-xs">
                                <!-- Icon Filter Umum (Corong) -->
                                <svg class="w-4 h-4 text-slate-500 dark:text-[#ffd900]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                <span>Filter:</span>
                                <span class="font-bold text-[#ffd900]" x-text="activeFilterLabel"></span>
                                <!-- Chevron -->
                                <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="openDropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu List -->
                            <div x-show="openDropdown" 
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-56 rounded-2xl bg-white dark:bg-[#1a1a18] border border-slate-200 dark:border-[#2a2a26] shadow-xl py-1.5 z-50 divide-y divide-slate-100 dark:divide-[#2a2a26]"
                                style="display: none;">
                                
                                {{-- Semua --}}
                                <div class="px-1 py-1">
                                    <button type="button" @click="setFilter('semua'); openDropdown = false"
                                        class="w-full flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-left transition-colors"
                                        :class="filter === 'semua' ? 'bg-[#ffd900]/15 text-[#ffd900] font-bold' : 'text-slate-700 dark:text-neutral-300 hover:bg-slate-50 dark:hover:bg-[#252522]'">
                                        <span>{{ __('Semua Misi') }}</span>
                                        <span x-show="filter === 'semua'">✓</span>
                                    </button>
                                </div>

                                {{-- Kategori Pengujian --}}
                                <div class="px-1 py-1">
                                    <div class="px-3 py-1 text-[10px] font-bold tracking-wider uppercase text-slate-400 dark:text-neutral-500">
                                        {{ __('Kategori Pengujian') }}
                                    </div>
                                    <button type="button" @click="setFilter('functional'); openDropdown = false"
                                        class="w-full flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-left transition-colors"
                                        :class="filter === 'functional' ? 'bg-[#ffd900]/15 text-[#ffd900] font-bold' : 'text-slate-700 dark:text-neutral-300 hover:bg-slate-50 dark:hover:bg-[#252522]'">
                                        <span>Functional Testing</span>
                                        <span x-show="filter === 'functional'">✓</span>
                                    </button>
                                    <button type="button" @click="setFilter('ux'); openDropdown = false"
                                        class="w-full flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-left transition-colors"
                                        :class="filter === 'ux' ? 'bg-[#ffd900]/15 text-[#ffd900] font-bold' : 'text-slate-700 dark:text-neutral-300 hover:bg-slate-50 dark:hover:bg-[#252522]'">
                                        <span>UX Research</span>
                                        <span x-show="filter === 'ux'">✓</span>
                                    </button>
                                    <button type="button" @click="setFilter('bug'); openDropdown = false"
                                        class="w-full flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-left transition-colors"
                                        :class="filter === 'bug' ? 'bg-[#ffd900]/15 text-[#ffd900] font-bold' : 'text-slate-700 dark:text-neutral-300 hover:bg-slate-50 dark:hover:bg-[#252522]'">
                                        <span>Bug Reporting</span>
                                        <span x-show="filter === 'bug'">✓</span>
                                    </button>
                                </div>

                                {{-- Jadwal Pengujian --}}
                                <div class="px-1 py-1">
                                    <div class="px-3 py-1 text-[10px] font-bold tracking-wider uppercase text-slate-400 dark:text-neutral-500">
                                        {{ __('Jadwal Pengujian') }}
                                    </div>
                                    <button type="button" @click="setFilter('hari_ini'); openDropdown = false"
                                        class="w-full flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-left transition-colors"
                                        :class="filter === 'hari_ini' ? 'bg-[#ffd900]/15 text-[#ffd900] font-bold' : 'text-slate-700 dark:text-neutral-300 hover:bg-slate-50 dark:hover:bg-[#252522]'">
                                        <span>{{ __('Hari Ini') }}</span>
                                        <span x-show="filter === 'hari_ini'">✓</span>
                                    </button>
                                    <button type="button" @click="setFilter('minggu_ini'); openDropdown = false"
                                        class="w-full flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-left transition-colors"
                                        :class="filter === 'minggu_ini' ? 'bg-[#ffd900]/15 text-[#ffd900] font-bold' : 'text-slate-700 dark:text-neutral-300 hover:bg-slate-50 dark:hover:bg-[#252522]'">
                                        <span>{{ __('Minggu Ini') }}</span>
                                        <span x-show="filter === 'minggu_ini'">✓</span>
                                    </button>
                                    <button type="button" @click="setFilter('mendatang'); openDropdown = false"
                                        class="w-full flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-left transition-colors"
                                        :class="filter === 'mendatang' ? 'bg-[#ffd900]/15 text-[#ffd900] font-bold' : 'text-slate-700 dark:text-neutral-300 hover:bg-slate-50 dark:hover:bg-[#252522]'">
                                        <span>{{ __('Mendatang') }}</span>
                                        <span x-show="filter === 'mendatang'">✓</span>
                                    </button>
                                </div>

                                {{-- Urutkan --}}
                                <div class="px-1 py-1">
                                    <div class="px-3 py-1 text-[10px] font-bold tracking-wider uppercase text-slate-400 dark:text-neutral-500">
                                        {{ __('Urutkan') }}
                                    </div>
                                    <button type="button" @click="setFilter('komisi'); openDropdown = false"
                                        class="w-full flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-left transition-colors"
                                        :class="filter === 'komisi' ? 'bg-[#ffd900]/15 text-[#ffd900] font-bold' : 'text-slate-700 dark:text-neutral-300 hover:bg-slate-50 dark:hover:bg-[#252522]'">
                                        <span>{{ __('Komisi Tertinggi') }}</span>
                                        <span x-show="filter === 'komisi'">✓</span>
                                    </button>
                                    <button type="button" @click="setFilter('slot'); openDropdown = false"
                                        class="w-full flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-left transition-colors"
                                        :class="filter === 'slot' ? 'bg-[#ffd900]/15 text-[#ffd900] font-bold' : 'text-slate-700 dark:text-neutral-300 hover:bg-slate-50 dark:hover:bg-[#252522]'">
                                        <span>{{ __('Slot Terbanyak') }}</span>
                                        <span x-show="filter === 'slot'">✓</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- List card (Desain Asli) --}}
                <div class="bg-white rounded-2xl shadow-sm" style="border:1px solid #e2e8f0;">
                    <template x-for="app in filteredApps" :key="app.id">
                        <div class="tsr-app-item flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 border-b border-slate-100 last:border-none hover:bg-slate-50 transition-colors">

                            <div class="flex items-center gap-4 w-full md:w-auto">
                                {{-- Icon / Logo --}}
                                <template x-if="app.logo">
                                    <img :src="app.logo.startsWith('/') ? app.logo : '/storage/' + app.logo" alt="Logo"
                                        class="w-12 h-12 rounded-2xl object-cover shadow-sm flex-shrink-0">
                                </template>
                                <template x-if="!app.logo">
                                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0"
                                        :style="`background:${app.gradient};`">
                                        <span class="text-white font-bold text-base" x-text="app.inisial"></span>
                                    </div>
                                </template>

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-0.5 flex-wrap">
                                        <p class="text-sm font-bold font-heading truncate max-w-[150px] sm:max-w-none"
                                            style="color:#1e293b;" x-text="app.nama"></p>
                                        <span class="text-[10px] font-medium px-2 py-0.5 rounded-md flex-shrink-0"
                                            :style="`background:${app.tipeBg};color:${app.tipeColor};`"
                                            x-text="app.tipe">
                                        </span>
                                    </div>
                                    <p class="text-xs truncate text-slate-500"
                                        style="color:#64748b; max-width: 280px; overflow: hidden; text-overflow: ellipsis;"
                                        x-text="app.deskripsi"></p>
                                </div>
                            </div>

                            {{-- Meta & Actions (Sejajar ke samping di mobile) --}}
                            <div
                                class="flex flex-row items-center justify-between md:justify-end gap-2 sm:gap-4 w-full md:w-auto mt-2 md:mt-0 pt-3 md:pt-0 border-t md:border-none border-slate-100">

                                {{-- Durasi --}}
                                <div class="text-center hidden lg:block min-w-[70px]">
                                    <p class="text-xs font-bold font-mono-num" style="color:#1e293b;" x-text="app.durasi"></p>
                                    <p class="text-xs" style="color:#94a3b8;">{{ __('Durasi') }}</p>
                                </div>

                                {{-- Tester --}}
                                <div class="text-center flex-shrink-0 min-w-[60px]">
                                    <p class="text-xs font-bold font-mono-num" style="color:#1e293b;" x-text="`${app.testerCur}/${app.testerMax}`"></p>
                                    <p class="text-xs" style="color:#94a3b8;">{{ __('Tester') }}</p>
                                </div>

                                {{-- Points --}}
                                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl flex-shrink-0"
                                    style="background:#f0fdf4;">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" style="color:#10b981;">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-xs font-bold font-mono-num text-emerald-600"
                                        style="color:#16a34a;" x-text="'+Rp ' + Number(app.komisi || 0).toLocaleString('id-ID')"></span>
                                </div>

                                {{-- Actions (Detail & Apply) --}}
                                <div class="flex items-center gap-2 flex-shrink-0 ml-auto md:ml-0">
                                    <a :href="'/tester/misi-detail?misi_id=' + app.id"
                                        class="px-3 py-1.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors flex items-center gap-1.5"
                                        style="text-decoration:none;">
                                        {{ __('Detail') }}
                                    </a>
                                    
                                    <template x-if="!app.isRestricted">
                                        <button type="button" @click="handleApply(app.id)"
                                            :disabled="applyingId === app.id"
                                            class="tsr-btn-apply !px-3 !py-1.5 text-xs font-bold">
                                            <span x-show="applyingId !== app.id">{{ __('Ambil Misi') }}</span>
                                            <span x-show="applyingId === app.id">...</span>
                                        </button>
                                    </template>
                                    <template x-if="app.isRestricted">
                                        <button type="button" disabled
                                            class="tsr-btn-apply !px-3 !py-1.5 text-xs font-bold opacity-60 cursor-not-allowed"
                                            title="{{ __('Misi ini membutuhkan minimal 6 badge') }}">
                                            {{ __('Terkunci') }}
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Empty state when filtered out --}}
                    <div x-show="filteredApps.length === 0" class="p-8 text-center" style="display:none;">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-600">{{ __('Tidak ada aplikasi yang cocok dengan pencarian / filter ini') }}</p>
                        <button type="button" @click="searchQuery = ''; setFilter('semua')" class="mt-3 px-3 py-1.5 text-xs font-bold rounded-xl bg-[#ffd900] hover:bg-[#e6c400] text-slate-900 transition-colors">
                            {{ __('Reset Pencarian & Filter') }}
                        </button>
                    </div>
                </div>
            </div>{{-- end available apps --}}

        </div>
    </div>{{-- end Alpine root --}}


    @push('scripts')
        <script>
            function testerDashboard(initialApps = []) {
                return {
                    apps: initialApps || [],
                    searchQuery: '',
                    filter: 'semua',
                    applyingId: null,

                    get activeFilterLabel() {
                        const labels = {
                            'semua': 'Semua',
                            'functional': 'Functional Testing',
                            'ux': 'UX Research',
                            'bug': 'Bug Reporting',
                            'hari_ini': 'Hari Ini',
                            'minggu_ini': 'Minggu Ini',
                            'mendatang': 'Mendatang',
                            'komisi': 'Komisi Tertinggi',
                            'slot': 'Slot Terbanyak',
                        };
                        return labels[this.filter] || 'Semua';
                    },

                    setFilter(val) {
                        this.filter = val;
                    },

                    get filteredApps() {
                        let result = this.apps || [];

                        // 1. Search Query
                        if (this.searchQuery && this.searchQuery.trim() !== '') {
                            const q = this.searchQuery.toLowerCase().trim();
                            result = result.filter(a => 
                                (a.nama && a.nama.toLowerCase().includes(q)) ||
                                (a.tipe && a.tipe.toLowerCase().includes(q)) ||
                                (a.deskripsi && a.deskripsi.toLowerCase().includes(q)) ||
                                (a.penyelenggara && a.penyelenggara.toLowerCase().includes(q)) ||
                                (a.lokasi && a.lokasi.toLowerCase().includes(q))
                            );
                        }

                        // 2. Filter Category / Schedule / Sorting
                        if (this.filter === 'functional') {
                            result = result.filter(a => (a.tipe || '').toLowerCase().includes('functional'));
                        } else if (this.filter === 'ux') {
                            result = result.filter(a => (a.tipe || '').toLowerCase().includes('ux'));
                        } else if (this.filter === 'bug') {
                            result = result.filter(a => (a.tipe || '').toLowerCase().includes('bug'));
                        } else if (this.filter === 'hari_ini') {
                            const today = new Date().toISOString().slice(0, 10);
                            result = result.filter(a => a.jadwalTanggalRaw === today);
                        } else if (this.filter === 'minggu_ini') {
                            const today = new Date().toISOString().slice(0, 10);
                            const nextWeek = new Date();
                            nextWeek.setDate(nextWeek.getDate() + 7);
                            const nextWeekStr = nextWeek.toISOString().slice(0, 10);
                            result = result.filter(a => a.jadwalTanggalRaw && a.jadwalTanggalRaw >= today && a.jadwalTanggalRaw <= nextWeekStr);
                        } else if (this.filter === 'mendatang') {
                            const today = new Date().toISOString().slice(0, 10);
                            result = result.filter(a => !a.jadwalTanggalRaw || a.jadwalTanggalRaw >= today);
                        } else if (this.filter === 'komisi') {
                            result = [...result].sort((a, b) => (Number(b.komisi) || 0) - (Number(a.komisi) || 0));
                        } else if (this.filter === 'slot') {
                            result = [...result].sort((a, b) => (Number(b.sisaSlot) || 0) - (Number(a.sisaSlot) || 0));
                        }

                        return result;
                    },

                    async handleApply(id) {
                        this.applyingId = id;
                        try {
                            if (this.$wire) {
                                await this.$wire.applyMisi(id);
                                this.apps = this.apps.filter(a => a.id !== id);
                            }
                        } catch (e) {
                            console.error(e);
                        } finally {
                            this.applyingId = null;
                        }
                    },

                    animateBars() {
                        this.$nextTick(() => {
                            document.querySelectorAll('.tsr-progress-fill').forEach(el => {
                                const target = el.dataset.target || '0%';
                                el.style.width = '0%';
                                setTimeout(() => {
                                    el.style.transition = 'width 1s cubic-bezier(0.34, 1.56, 0.64, 1)';
                                    el.style.width = target;
                                }, 400);
                            });
                        });
                    }
                };
            }  
        </script>
    @endpush


</x-filament-panels::page>