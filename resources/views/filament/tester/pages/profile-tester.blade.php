<x-filament-panels::page>

  @push('styles')
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap"
      rel="stylesheet">
    <style>
      .prof-page,
      .prof-page * {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
      }

      .font-mono-num {
        font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
        font-variant-numeric: tabular-nums;
      }

      .fi-main {
        background-color: #f1f5f9 !important;
      }

      .fi-page {
        padding: 0 !important;
      }

      .fi-page-header-heading {
        display: none !important;
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
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        isolation: isolate;
      }

      html.dark .prof-hero,
      .dark .prof-hero {
        background: #1a1a18 !important;
        border: 1px solid #2e2e2e !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4) !important;
      }

      /* Disable glowing animations */
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
        box-shadow: 0 0 6px #fff, 0 0 12px #fff !important;
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
        pointer-events: none;
        opacity: 0;
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

      .prof-avatar {
        background: #ffd900;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .25), 0 0 0 4px rgba(255, 255, 255, .15);
      }

      .prof-status-dot {
        animation: prof-pulse-ring 2s infinite;
      }

      .prof-stat-pill {
        background: rgba(255, 255, 255, .08);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, .15);
        transition: all .3s cubic-bezier(.4, 0, .2, 1);
        position: relative;
        overflow: hidden;
      }

      .prof-stat-pill:hover {
        background: rgba(255, 255, 255, .15);
        transform: translateY(-3px);
        border-color: rgba(255, 255, 255, .3);
      }

      .prof-stat-pill::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 40%;
        height: 100%;
        background: #ffd900;
        transform: translateX(-100%);
      }

      .prof-stat-pill:hover::after {
        animation: prof-shimmer 1.2s ease forwards;
      }

      .prof-mini {
        transition: transform .25s ease;
        cursor: default;
      }

      .prof-mini:hover {
        transform: translateY(-2px);
      }

      .prof-mini:hover .prof-mini-dot {
        animation: prof-bounce-soft .6s ease;
      }

      .prof-card {
        animation: prof-fade-up .6s ease both;
        transition: box-shadow .3s ease, transform .3s ease;
      }

      .prof-card:hover {
        box-shadow: 0 12px 40px -12px rgba(255, 217, 0, .18);
      }

      .prof-fade-1 {
        animation: prof-fade-up .6s .05s ease both;
      }

      .prof-fade-2 {
        animation: prof-fade-up .6s .15s ease both;
      }

      .prof-fade-3 {
        animation: prof-fade-up .6s .25s ease both;
      }

      .prof-btn-save {
        background: #ffd900;
        color: #000000 !important;
        background-size: 200% 200%;
        box-shadow: 0 6px 20px rgba(255, 217, 0, .4), 0 0 0 1px rgba(255, 255, 255, .1) inset;
        transition: all .3s ease;
        position: relative;
        overflow: hidden;
      }

      .prof-btn-save * {
        color: #000000 !important;
      }

      .prof-btn-save:hover {
        background-position: 100% 50%;
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(255, 217, 0, .5);
      }

      .prof-btn-save::before {
        content: '';
        position: absolute;
        inset: 0;
        background: transparent;
        transform: translateX(-100%);
      }

      .prof-btn-save:hover::before {
        animation: prof-shimmer .8s ease;
      }

      .prof-icon-wrap {
        transition: transform .4s ease;
      }

      .prof-icon-wrap:hover {
        transform: rotate(-8deg) scale(1.1);
      }

      .prof-divider-anim {
        background: transparent;
        background-size: 100% 200%;
        
      }

      /* Counter target (animated by JS) */
      .prof-counter {
        display: inline-block;
      }

      @media (prefers-reduced-motion: reduce) {

        .prof-hero,
        .prof-blob,
        .prof-blob-rev,
        .prof-status-dot,
        .prof-btn-save,
        .prof-divider-anim,
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
    $stats = $this->getStats();
    $badgeCount = $stats['badge'] ?? 0;
    if ($badgeCount <= 5) {
      $tierName = __('Tester Pemula');
    } elseif ($badgeCount <= 50) {
      $tierName = __('Tester Menengah');
    } else {
      $tierName = __('Tester Ahli');
    }
  @endphp

  <div class="prof-page">
    <div class="px-6 py-6">

      {{-- ═══════════ HERO BANNER ═══════════ --}}
      <div class="prof-hero prof-fade-1 w-full rounded-3xl p-6 sm:p-8 mb-6 relative overflow-hidden">

        {{-- Aurora mesh gradient --}}
        <div class="prof-aurora"></div>

        {{-- Rotating conic glows --}}
        <div class="prof-conic"></div>
        <div class="prof-conic-2"></div>

        {{-- Grid texture --}}
        <div class="absolute inset-0 prof-grid-bg pointer-events-none"></div>

        {{-- Scanline sweep --}}
        <div class="prof-scan"></div>

        {{-- Twinkling stars --}}
        <div class="prof-stars">
          @for($i = 0; $i < 18; $i++)
            <span style="top:{{ rand(2, 90) }}%; left:{{ rand(2, 98) }}%; animation-delay:-{{ ($i * 0.23) }}s;"></span>
          @endfor
        </div>

        {{-- Floating particles --}}
        <div class="prof-particles">
          @for($i = 0; $i < 14; $i++)
            @php $dur = rand(7, 14);
              $delay = $i * 0.7;
              $left = rand(2, 98);
              $size = rand(3, 7);
            $drift = rand(-40, 40); @endphp
            <span
              style="left:{{ $left }}%; width:{{ $size }}px; height:{{ $size }}px; animation-duration:{{ $dur }}s; animation-delay:{{ $delay }}s; --drift:{{ $drift }}px;"></span>
          @endfor
        </div>

        {{-- Shooting stars --}}
        <div class="prof-shoot"></div>
        <div class="prof-shoot s2"></div>

        {{-- Floating decorative blobs --}}
        <div class="prof-blob absolute -right-12 -top-12 w-48 h-48 rounded-full opacity-20"
          style="background: none;
animation-delay:-3s;"></div>

        {{-- Konten utama --}}
        <div class="relative z-10 flex flex-col lg:flex-row items-center lg:items-end lg:justify-between gap-6">
          <div class="flex flex-col sm:flex-row items-center text-center sm:text-left gap-5 w-full lg:w-auto">
            {{-- Avatar with initial --}}
            <div class="relative flex-shrink-0">
              <div
                class="prof-avatar w-20 h-20 sm:w-24 sm:h-24 rounded-2xl flex items-center justify-center text-white text-3xl sm:text-4xl font-extrabold select-none">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
              </div>
              </div>

            <div class="flex-1">
              <p class="text-[11px] font-bold uppercase mb-1.5 flex items-center justify-center sm:justify-start gap-2"
                style="color:#fef08a;letter-spacing:0.18em;">
                <span class="w-6 h-px hidden sm:inline-block" style="background:#fef08a;"></span>
                {{ __('TESTER PANEL') }}
              </p>
              <h1 class="font-bold text-white mb-2.5 text-2xl sm:text-[34px]"
                style="line-height:1.1;letter-spacing:-0.02em;">
                {{ Auth::user()->name }}
              </h1>
              <div class="flex items-center justify-center sm:justify-start gap-2 flex-wrap">
                <span class="inline-flex items-center text-xs font-bold px-3 py-1.5 rounded-full"
                  style="background:#ffd900;color:#fef3c7;border:1px solid rgba(251,191,36,.3);">
                  {{ $tierName }}
                </span>
                <span class="inline-flex items-center text-xs font-medium px-3 py-1.5 rounded-full"
                  style="background:rgba(255,255,255,0.12);color:#fef9c3;border:1px solid rgba(255,255,255,.15);">
                  {{ __('Bergabung') }} {{ Auth::user()->created_at?->translatedFormat('M Y') ?? '-' }}
                </span>
                <span class="inline-flex items-center text-xs font-medium px-3 py-1.5 rounded-full"
                  style="background:rgba(255,255,255,0.12);color:#fef9c3;border:1px solid rgba(255,255,255,.15);">
                  {{ Auth::user()->email }}
                </span>
              </div>
            </div>
          </div>

          {{-- Top stat pills --}}
          <div class="flex items-center justify-center sm:justify-start gap-3 flex-wrap w-full lg:w-auto">
            <div class="prof-stat-pill rounded-2xl px-5 py-3 text-center min-w-[120px] flex-1 sm:flex-none">
              <p class="font-mono-num text-xl sm:text-2xl font-bold text-white">Rp {{ number_format($stats['saldo_rupiah'] ?? 0, 0, ',', '.') }}</p>
              <p class="text-[10px] font-semibold uppercase tracking-wider mt-0.5"
                style="color:#fef9c3;letter-spacing:0.12em;">{{ __('Saldo Dompet') }}</p>
            </div>
            <div class="prof-stat-pill rounded-2xl px-5 py-3 text-center min-w-[100px] flex-1 sm:flex-none">
              <p class="font-mono-num text-2xl font-bold text-white prof-counter"
                data-target="{{ $stats['misi_selesai'] ?? 0 }}">
                {{ number_format($stats['misi_selesai'] ?? 0, 0, ',', '.') }}
              </p>
              <p class="text-[10px] font-semibold uppercase tracking-wider mt-0.5"
                style="color:#fef9c3;letter-spacing:0.12em;">{{ __('Misi Selesai') }}</p>
            </div>
            <div class="prof-stat-pill rounded-2xl px-5 py-3 text-center min-w-[100px] flex-1 sm:flex-none">
              <p class="font-mono-num text-2xl font-bold text-white prof-counter" data-target="{{ $badgeCount }}">
                {{ number_format($badgeCount, 0, ',', '.') }}
              </p>
              <p class="text-[10px] font-semibold uppercase tracking-wider mt-0.5"
                style="color:#fef9c3;letter-spacing:0.12em;">{{ __('Lencana') }}</p>
            </div>
          </div>
        </div>

        {{-- Mini stats footer --}}
        <div class="relative z-10 grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6 pt-5"
          style="border-top:1px solid rgba(255,255,255,0.15);">
          @php
            $mini = [
              ['label' => __('Total Misi'), 'val' => $stats['total_misi'] ?? 0, 'color' => '#fed000'],
              ['label' => __('Misi Aktif'), 'val' => $stats['total_misi'] ?? 0, 'color' => '#34d399'],
              ['label' => __('Member Sejak'), 'val' => 0, 'color' => '#a78bfa', 'isText' => true, 'textVal' => $stats['member_since'] ?? '-'],
              ['label' => __('Tier'), 'val' => 0, 'color' => '#fbbf24', 'isText' => true, 'textVal' => $tierName],
            ];
          @endphp
          @foreach($mini as $m)
            <div class="prof-mini flex items-center gap-3">
              <div>
                @if(isset($m['isText']) && $m['isText'])
                  <p class="font-mono-num text-lg font-bold text-white">{{ $m['textVal'] }}</p>
                @else
                  <p class="font-mono-num text-lg font-bold text-white prof-counter" data-target="{{ $m['val'] }}">
                    {{ number_format($m['val'], 0, ',', '.') }}
                  </p>
                @endif
                <p class="text-[10px] font-semibold uppercase tracking-wider"
                  style="color:#fef9c3;letter-spacing:0.12em;">{{ $m['label'] }}</p>
              </div>
            </div>
          @endforeach
        </div>

        {{-- Animated waves --}}
        <div class="prof-waves">
          <svg viewBox="0 0 2400 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M0,40 C150,80 350,0 600,40 C850,80 1050,0 1200,40 C1350,80 1550,0 1800,40 C2050,80 2250,0 2400,40 L2400,80 L0,80 Z"
              fill="rgba(255,255,255,0.18)" />
          </svg>
        </div>
        <div class="prof-waves w2">
          <svg viewBox="0 0 2400 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M0,50 C200,20 400,70 600,50 C800,30 1000,70 1200,50 C1400,20 1600,70 1800,50 C2000,30 2200,70 2400,50 L2400,80 L0,80 Z"
              fill="rgba(147,197,253,0.22)" />
          </svg>
        </div>
      </div>

      {{-- ═══════════ EDIT FORM ═══════════ --}}
      <div class="prof-card prof-fade-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3 relative overflow-hidden">
          <div class="absolute inset-0 opacity-50"
            style="background:#ffd900;"></div>
          <div class="prof-icon-wrap relative w-10 h-10 rounded-xl flex items-center justify-center"
            style="background:#ffd900;box-shadow:0 4px 12px rgba(255, 217, 0, .15);">
            <svg class="w-5 h-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
            </svg>
          </div>
          <div class="relative">
            <h2 class="font-bold text-slate-800 text-base">{{ __('Edit Profil') }}</h2>
            <p class="text-slate-400 text-xs">{{ __('Perbarui informasi akun & keamanan Anda') }}</p>
          </div>
        </div>

        <div class="p-6 prof-fade-3">
          <form wire:submit="save">
            {{ $this->form }}
            <div class="mt-6 flex flex-col sm:flex-row justify-end">
              <button type="submit"
                class="prof-btn-save inline-flex justify-center items-center gap-2 px-6 py-3 rounded-2xl text-sm font-bold text-black w-full sm:w-auto" style="color: #000000 !important;">
                <svg class="w-4 h-4 text-black" style="color: #000000 !important;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                {{ __('Simpan Perubahan') }}
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

  @push('scripts')
    <script>
      // Animated count-up for all .prof-counter on load
      (function () {
        const animate = (el) => {
          const target = parseInt(el.dataset.target || '0', 10);
          if (!target) { el.textContent = '0'; return; }
          const dur = 1200;
          const start = performance.now();
          const tick = (now) => {
            const p = Math.min((now - start) / dur, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.floor(eased * target).toLocaleString('id-ID');
            if (p < 1) requestAnimationFrame(tick);
            else el.textContent = target.toLocaleString('id-ID');
          };
          requestAnimationFrame(tick);
        };
        const run = () => document.querySelectorAll('.prof-counter').forEach(animate);
        if (document.readyState !== 'loading') run(); else document.addEventListener('DOMContentLoaded', run);
        // Re-run after Livewire updates (e.g. after save)
        document.addEventListener('livewire:navigated', run);
        if (window.Livewire) window.Livewire.hook('message.processed', run);
      })();
    </script>
  @endpush

  <x-filament-actions::modals />
</x-filament-panels::page>