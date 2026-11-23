<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  class="{{ session('pt-theme', 'light') === 'dark' ? 'dark' : '' }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Kebijakan Privasi') }} – Testoplay</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any" />
  <meta name="description"
    content="{{ __('Kebijakan privasi Testoplay menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda.') }}">
  <script>
    (function () {
      var t = localStorage.getItem('pt-theme');
      if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      }
    })();
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'sans-serif'] },
          colors: {
            brand: {
              50: '#fefce8',
              100: '#fef9c3',
              200: '#fef08a',
              300: '#fde047',
              400: '#fed000',
              500: '#ffd900',
              600: '#e6c300',
              700: '#ca8a04',
              800: '#a16207',
              900: '#713f12',
              950: '#422006'
            }
          }
        }
      }
    };
  </script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    /* Prose */
    .prose h2 {
      font-size: 1.125rem;
      font-weight: 700;
      margin-top: 2rem;
      margin-bottom: 0.75rem;
      color: #1e293b;
    }

    .dark .prose h2 {
      color: #f1f5f9;
    }

    .prose h3 {
      font-size: 1rem;
      font-weight: 600;
      margin-top: 1.5rem;
      margin-bottom: 0.5rem;
      color: #334155;
    }

    .dark .prose h3 {
      color: #e2e8f0;
    }

    .prose p {
      margin-bottom: 1rem;
      line-height: 1.75;
      color: #64748b;
    }

    .dark .prose p {
      color: #94a3b8;
    }

    .prose ul {
      list-style: disc;
      padding-left: 1.5rem;
      margin-bottom: 1rem;
    }

    .prose ul li {
      margin-bottom: 0.4rem;
      line-height: 1.75;
      color: #64748b;
    }

    .dark .prose ul li {
      color: #94a3b8;
    }

    .prose a {
      color: #ffd900;
      text-decoration: underline;
    }

    .dark .prose a {
      color: #fed000;
    }

    /* Admin-style card */
    .page-card {
      background: #ffffff;
      border-radius: 1rem;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
      border: 1px solid #f1f5f9;
      border-top: 4px solid #ffd900;
      padding: 2rem;
    }

    .dark .page-card {
      background: #1e293b;
      border-color: #334155;
      border-top-color: #fed000;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    /* Theme toggle */
    .theme-toggle {
      position: relative;
      width: 48px;
      height: 26px;
      background: #e2e8f0;
      border-radius: 999px;
      border: none;
      cursor: pointer;
      transition: background .3s;
      flex-shrink: 0;
    }

    .dark .theme-toggle {
      background: #1e293b;
    }

    .theme-toggle-knob {
      position: absolute;
      top: 3px;
      left: 3px;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #fff;
      box-shadow: 0 1px 4px rgba(0, 0, 0, .2);
      transition: transform .3s cubic-bezier(.4, 0, .2, 1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
    }

    .dark .theme-toggle-knob {
      transform: translateX(22px);
      background: #1e293b;
    }

    .icon-sun {
      color: #f59e0b;
    }

    .icon-moon {
      color: #fed000;
      position: absolute;
      opacity: 0;
    }

    .dark .icon-sun {
      opacity: 0;
    }

    .dark .icon-moon {
      opacity: 1;
    }

    /* ====== Profile Card styling elements to match admin card ====== */
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
      position: relative;
      background: #1a1a18;
      background-size: 220% 220%;
      
      box-shadow: 0 20px 60px -15px rgba(255, 217, 0, .35), 0 0 0 1px rgba(255, 255, 255, .06) inset;
      isolation: isolate;
      overflow: hidden;
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
      animation: prof-conic 34s linear infinite;
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
  </style>
</head>

<body class="bg-slate-50 dark:bg-slate-950 antialiased">

  <!-- Navbar -->
  <header
    class="fixed top-0 inset-x-0 z-50 bg-white/95 dark:bg-slate-900/95 border-b border-slate-100 dark:border-slate-800 backdrop-blur-sm">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
      <a href="{{ url('/') }}" class="flex items-center">
        <img src="{{ asset('logo.png') }}" alt="Testoplay" class="h-10 w-auto dark:hidden" />
        <img src="{{ asset('logo-dark.png') }}" alt="Testoplay" class="h-10 w-auto hidden dark:block" />
      </a>
      <div class="flex items-center gap-3">
        <!-- Back link -->
        <a href="{{ url('/') }}"
          class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 transition flex items-center gap-1.5">
          <i class="fa-solid fa-arrow-left text-xs"></i>
          <span class="hidden sm:inline">{{ __('Kembali') }}</span>
        </a>
        <!-- Language Switcher -->
        <div class="flex items-center gap-1 pl-3 border-l border-slate-200 dark:border-slate-700">
          <a href="{{ route('kebijakan-privasi') }}?lang=en"
            onclick="event.preventDefault(); fetch('/language/switch/en').then(()=>window.location.reload())"
            class="w-8 h-8 flex items-center justify-center rounded-lg text-[10px] font-black transition {{ App::getLocale() == 'en' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700' }}">EN</a>
          <a href="{{ route('kebijakan-privasi') }}?lang=id"
            onclick="event.preventDefault(); fetch('/language/switch/id').then(()=>window.location.reload())"
            class="w-8 h-8 flex items-center justify-center rounded-lg text-[10px] font-black transition {{ App::getLocale() == 'id' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700' }}">ID</a>
        </div>
        <!-- Theme toggle -->
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle dark mode">
          <span class="theme-toggle-knob">
            <i class="fa-solid fa-sun icon-sun"></i>
            <i class="fa-solid fa-moon icon-moon"></i>
          </span>
        </button>
      </div>
    </nav>
  </header>

  <!-- Hero -->
  <div class="pt-24 max-w-3xl mx-auto px-4 sm:px-6">
    <div class="prof-hero rounded-3xl text-white py-14 px-4 relative overflow-hidden">
      <!-- Grid overlay -->
      <div class="prof-grid-bg absolute inset-0 opacity-35"></div>
      <!-- Aurora mesh -->
      <div class="prof-aurora"></div>
      <!-- Conic glow -->
      <div class="prof-conic"></div>
      <div class="prof-conic-2"></div>

      <!-- Twinkling stars -->
      <div class="prof-stars">
        @for($i = 0; $i < 18; $i++)
          <span style="top:{{ rand(2, 90) }}%; left:{{ rand(2, 98) }}%; animation-delay:-{{ ($i * 0.23) }}s;"></span>
        @endfor
      </div>

      <!-- Floating particles -->
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

      <!-- Shooting stars -->
      <div class="prof-shoot"></div>
      <div class="prof-shoot s2"></div>

      <!-- Floating decorative blobs -->
      <div class="prof-blob absolute -right-12 -top-12 w-48 h-48 rounded-full opacity-20"
        style="background: none;
if (html.classList.contains('dark')) { html.classList.remove('dark'); localStorage.setItem('pt-theme', 'light'); }
      else { html.classList.add('dark'); localStorage.setItem('pt-theme', 'dark'); }
    }
  </script>
</body>

</html>
