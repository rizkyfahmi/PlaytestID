<!DOCTYPE html>
<html lang="en" class="scroll-smooth dark">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Testoplay – Closed Testing Partner for Indonesian Developers & Testers</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any" />

  <!-- ─── Google Fonts: Inter ─── -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- ─── Tailwind CSS CDN ─── -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- ─── Font Awesome 6 CDN ─── -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

  <!-- ─── jQuery 3.7.1 CDN ─── -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- ─── Tailwind Config Extension ─── -->
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif']
          },
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
          },
          keyframes: {
            fadeUp: {
              '0%': {
                opacity: '0',
                transform: 'translateY(24px)'
              },
              '100%': {
                opacity: '1',
                transform: 'translateY(0)'
              }
            },
            floatY: {
              '0%,100%': {
                transform: 'translateY(0px)'
              },
              '50%': {
                transform: 'translateY(-10px)'
              }
            },
            pulseDot: {
              '0%,100%': {
                opacity: '1'
              },
              '50%': {
                opacity: '0.4'
              }
            },
          },
          animation: {
            fadeUp: 'fadeUp 0.7s ease forwards',
            floatY: 'floatY 4s ease-in-out infinite',
            pulseDot: 'pulseDot 1.5s ease-in-out infinite',
          }
        }
      }
    }
  </script>

  <!-- ─── Permanent Dark Mode (Helden Inc Black & Yellow Theme) ─── -->
  <script>
    (function() {
      document.documentElement.classList.add('dark');
      localStorage.setItem('theme', 'dark');
      localStorage.setItem('pt-theme', 'dark');
    })();
  </script>

  <!-- ─── Custom CSS ─── -->
  <style>
    /* Base font */
    * {
      font-family: 'Inter', sans-serif;
    }

    /* Smooth scroll */
    html {
      scroll-behavior: smooth;
    }
    html.dark {
      background-color: #111111 !important;
      color-scheme: dark;
    }
    html.dark body {
      background-color: #111111 !important;
      color: #e2e8f0 !important;
    }

    /* ── Navbar Helden Inc solid styling ── */
    #navbar {
      background: #ffffff !important;
      border-bottom: 1px solid #f1f5f9 !important;
      transition: background-color 0.25s ease, border-color 0.25s ease;
    }
    html.dark #navbar {
      background: #111111 !important;
      border-bottom: 1px solid #222222 !important;
    }
    #navbar.scrolled {
      background: #ffffff !important;
      box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05) !important;
    }
    html.dark #navbar.scrolled {
      background: #111111 !important;
      box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.5) !important;
      border-bottom: 1px solid #222222 !important;
    }
    html.dark #navDropdownMenu {
      background: #111111 !important;
      border-color: #222222 !important;
    }
    html.dark #mobile-menu {
      background: #111111 !important;
      border-color: #222222 !important;
    }

    /* ── Hamburger animated icon ── */
    .ham-line {
      display: block;
      width: 24px;
      height: 2px;
      background: #ffd900;
      border-radius: 2px;
      transition: all 0.3s ease;
      transform-origin: center;
    }
    .dark .ham-line {
      background: #ffd900;
    }

    #hamburger.open .ham-line:nth-child(1) {
      transform: translateY(8px) rotate(45deg);
    }

    #hamburger.open .ham-line:nth-child(2) {
      opacity: 0;
      transform: scaleX(0);
    }

    #hamburger.open .ham-line:nth-child(3) {
      transform: translateY(-8px) rotate(-45deg);
    }

    /* ── Mobile menu slide ── */
    #mobile-menu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    #mobile-menu.open {
      max-height: 420px;
    }

    /* ── Hero & CTA backgrounds ── */
    .hero-bg {
      background: #ffffff;
    }
    html.dark .hero-bg {
      background: #111111 !important;
    }
    .cta-bg {
      background: #f8fafc;
    }
    html.dark .cta-bg {
      background: #111111 !important;
    }

    /* ── Tab underline indicator ── */
    .tab-btn {
      position: relative;
      transition: color 0.2s;
    }

    .tab-btn::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      right: 0;
      height: 3px;
      border-radius: 2px;
      background: #ffd900;
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .tab-btn.active {
      color: #ca8a04;
      font-weight: 700;
    }
    .dark .tab-btn.active {
      color: #fed000;
    }

    .tab-btn.active::after {
      transform: scaleX(1);
    }

    /* ── Tab content ── */
    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    /* ── Benefit icon bubble ── */
    .icon-bubble {
      width: 56px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 16px;
      flex-shrink: 0;
    }

    /* ── Pricing card hover lift ── */
    .pricing-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pricing-card:hover {
      transform: translateY(-6px);
    }

    /* ── Progress bar animation ── */
    .progress-fill {
      animation: fillBar 2s ease-in-out forwards;
      width: 0;
    }

    @keyframes fillBar {
      to {
        width: var(--fill);
      }
    }

    /* ── CTA section gradient ── */
    .cta-bg {
      background: #1a1a18;
    }
    .dark .cta-bg {
      background: #111111;
    }

    /* ── Scroll-reveal helper ── */
    .reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* ── Checkmark list ── */
    .check-list li {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-bottom: 10px;
    }

    .check-list li i {
      margin-top: 3px;
      flex-shrink: 0;
    }

    /* ── Badge ── */
    .badge-popular {
      background: #ffd900;
      color: #111111;
      font-size: 0.72rem;
      font-weight: 800;
      letter-spacing: 0.07em;
      padding: 4px 14px;
      border-radius: 999px;
      box-shadow: 0 2px 10px rgba(255, 217, 0, 0.35);
    }

    /* ── Helden Inc Button Contrast ── */
    .bg-brand-600.text-white,
    .bg-brand-500.text-white {
      color: #111111 !important;
      font-weight: 800 !important;
    }

    /* ── Smooth body transition ── */
    body, #navbar, .pricing-card > div, .glass-card {
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
  </style>
</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased">

  <!-- ════════════════════════════════════════════
     1. NAVBAR – Sticky, responsive with hamburger menu (jQuery)
     ════════════════════════════════════════════ -->
  <header id="navbar" class="fixed top-0 inset-x-0 z-50 bg-white/95 dark:bg-[#111111] border-b border-slate-100 dark:border-[#222222] transition-all duration-300">
    <nav class="w-full px-4 sm:px-8 lg:px-12">
      <div class="flex items-center justify-between h-16">

        <!-- Logo -->
        <a href="/" class="flex items-center select-none animate-fadeUp">
          <img src="{{ asset('logo.png') }}" alt="Testoplay" class="h-8 min-[375px]:h-9 sm:h-12 w-auto object-contain dark:hidden" />
          <img src="{{ asset('logo-dark.png') }}" alt="Testoplay" class="h-8 min-[375px]:h-9 sm:h-12 w-auto object-contain hidden dark:block" />
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-slate-400">
          <li><a href="#how-it-works" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Cara Kerja') }}</a></li>
          <li><a href="#benefits" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Manfaat') }}</a></li>
          <li><a href="#pricing" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Harga') }}</a></li>
          <li><a href="#hero" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Dasbor') }}</a></li>
          <li><a href="#testi" class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Blog') }}</a></li>
          <!-- Dropdown: Lainnya -->
          <li class="relative" id="navDropdownWrapper">
            <button id="navDropdownBtn" onclick="toggleNavDropdown()" class="flex items-center gap-1 hover:text-brand-600 dark:hover:text-brand-400 transition duration-200 focus:outline-none">
              {{ __('Lainnya') }}
              <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" id="navDropdownChevron"></i>
            </button>
            <div id="navDropdownMenu" class="hidden absolute top-full right-0 mt-2 w-52 bg-white dark:bg-[#1a1a18] border border-slate-100 dark:border-[#2e2e2e] rounded-2xl shadow-xl py-2 z-50">
              <a href="{{ route('kebijakan-privasi') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">
                <i class="fa-solid fa-shield-halved text-xs w-4 text-center"></i> {{ __('Kebijakan Privasi') }}
              </a>
              <a href="{{ route('syarat-ketentuan') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">
                <i class="fa-solid fa-file-contract text-xs w-4 text-center"></i> {{ __('Syarat & Ketentuan') }}
              </a>
              <div class="border-t border-slate-100 dark:border-slate-800 my-1"></div>
              <a href="{{ route('faq') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">
                <i class="fa-solid fa-circle-question text-xs w-4 text-center"></i> FAQ
              </a>
              <a href="{{ route('hubungi-kami') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700 dark:text-slate-300 hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">
                <i class="fa-solid fa-headset text-xs w-4 text-center"></i> {{ __('Hubungi Kami') }}
              </a>
            </div>
          </li>
        </ul>

        <!-- Desktop CTA -->
        <div class="hidden md:flex items-center gap-3">
          <button onclick="openAuthModal('login')" class="px-4 py-2 text-sm font-bold text-slate-800 dark:text-white border border-slate-300 dark:border-[#333333] rounded-xl hover:bg-slate-100 dark:hover:bg-[#242424] transition duration-200">
            {{ __('Masuk') }}
          </button>
          <button onclick="openAuthModal('register')" class="px-4 py-2 text-sm font-bold text-[#111111] bg-[#ffd900] rounded-xl shadow-md hover:bg-[#e6c400] transition duration-200">
            {{ __('Daftar') }}
          </button>

          <!-- Language Switcher (Compact Dropdown) -->
          <div class="ml-2 pl-3 border-l border-slate-200 dark:border-slate-800 flex items-center">
            <x-language-dropdown />
          </div>
        </div>

        <!-- Hamburger (Mobile) -->
        <div class="md:hidden flex items-center gap-2">
          <!-- Mobile Language Switcher -->
          <x-language-dropdown />
          <button id="hamburger" aria-label="Toggle menu" class="flex flex-col gap-[6px] p-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 transition">
            <span class="ham-line"></span>
            <span class="ham-line"></span>
            <span class="ham-line"></span>
          </button>
        </div>
      </div>

      <!-- Mobile Menu (collapsible, jQuery controlled) -->
      <div id="mobile-menu" class="md:hidden border-t border-slate-100 dark:border-slate-800">
        <ul class="flex flex-col py-4 gap-1 text-sm font-medium text-slate-700 dark:text-slate-300">
          <li><a href="#how-it-works" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Cara Kerja') }}</a></li>
          <li><a href="#benefits" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Manfaat') }}</a></li>
          <li><a href="#pricing" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Harga') }}</a></li>
          <li><a href="#hero" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Dasbor') }}</a></li>
          <li><a href="#testi" class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Blog') }}</a></li>
          <!-- Mobile: Lainnya submenu -->
          <li class="border-t border-slate-100 dark:border-slate-700 mt-1 pt-2">
            <span class="block px-3 py-1 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">{{ __('Lainnya') }}</span>
          </li>
          <li><a href="{{ route('kebijakan-privasi') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition text-sm">
            <i class="fa-solid fa-shield-halved text-xs text-slate-400"></i> {{ __('Kebijakan Privasi') }}
          </a></li>
          <li><a href="{{ route('syarat-ketentuan') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition text-sm">
            <i class="fa-solid fa-file-contract text-xs text-slate-400"></i> {{ __('Syarat & Ketentuan') }}
          </a></li>
          <li><a href="{{ route('faq') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition text-sm">
            <i class="fa-solid fa-circle-question text-xs text-slate-400"></i> FAQ
          </a></li>
          <li><a href="{{ route('hubungi-kami') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition text-sm">
            <i class="fa-solid fa-headset text-xs text-slate-400"></i> {{ __('Hubungi Kami') }}
          </a></li>
          <li class="border-t border-slate-100 dark:border-slate-800 mt-2 pt-3 flex gap-2">
            <button onclick="openAuthModal('login')" class="flex-1 text-center px-4 py-2 font-semibold text-brand-600 dark:text-brand-400 border-2 border-brand-600 dark:border-brand-500 rounded-xl hover:bg-brand-50 dark:hover:bg-brand-950 transition">{{ __('Masuk') }}</button>
            <button onclick="openAuthModal('register')" class="flex-1 text-center px-4 py-2 font-semibold text-white bg-brand-600 rounded-xl shadow hover:bg-brand-700 transition">{{ __('Daftar') }}</button>
          </li>
          <li class="mt-2 flex justify-center items-center gap-2">
            <span class="text-xs text-slate-400 font-semibold">{{ __('Pilih Bahasa:') }}</span>
            <x-language-dropdown />
          </li>
        </ul>
      </div>
    </nav>
  </header>


  <!-- ════════════════════════════════════════════
     2. HERO SECTION – Full-page centered hero layout
     ════════════════════════════════════════════ -->
  <section id="hero" class="hero-bg min-h-[90vh] lg:min-h-screen flex items-center justify-center pt-28 pb-20 px-4 sm:px-8 lg:px-12 overflow-hidden relative w-full">

    <!-- Subtle ambient lighting (CSS only, no icons/emojis) -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[450px] bg-[#ffd900]/[0.04] rounded-full blur-3xl pointer-events-none -z-0"></div>

    <div class="w-full max-w-6xl mx-auto text-center space-y-8 relative z-10 px-2 sm:px-4" style="animation: fadeUp 0.8s ease forwards;">

      <!-- Headline -->
      <h1 class="text-3xl min-[375px]:text-4xl min-[425px]:text-5xl sm:text-7xl lg:text-8xl font-black leading-[1.12] sm:leading-[1.08] tracking-tight text-white max-w-5xl mx-auto break-words">
        {{ __('Uji Aplikasi Secara Langsung') }}<br class="hidden sm:inline" />
        <span class="text-[#ffd900]">{{ __('Face to Face Testing') }}</span>
      </h1>

      <!-- Sub-headline -->
      <p class="text-sm min-[375px]:text-base sm:text-xl text-zinc-400 leading-relaxed max-w-3xl mx-auto font-normal">
        {{ __('Testoplay menghubungkan Developer dengan tester yang bersedia hadir langsung di lokasi pengujian. Seleksi pelamar berkualitas, atur jadwal & lokasi fleksibel, dan bayar komisi tunai per tester tanpa sistem poin atau batasan 14 hari.') }}
      </p>

      <!-- Dual CTA -->
      <div class="flex flex-col sm:flex-row justify-center items-center gap-3 sm:gap-4 pt-2 w-full max-w-md sm:max-w-none mx-auto">
        <button onclick="window.location.href='{{ route('filament.developer.auth.login') }}'" 
          class="w-full sm:w-auto inline-flex items-center justify-center px-6 sm:px-9 py-3.5 sm:py-4 bg-[#ffd900] text-[#111111] font-bold text-base sm:text-lg rounded-xl shadow-lg shadow-yellow-500/10 hover:bg-[#ffe033] hover:shadow-yellow-500/25 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
          {{ __('Saya Butuh Tester') }}
        </button>
        <button onclick="window.location.href='{{ route('filament.tester.auth.login') }}'" 
          class="w-full sm:w-auto inline-flex items-center justify-center px-6 sm:px-9 py-3.5 sm:py-4 bg-zinc-900/90 border border-zinc-700/80 text-zinc-200 hover:text-white hover:border-zinc-500 hover:bg-zinc-800 font-semibold text-base sm:text-lg rounded-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
          {{ __('Saya Ingin Jadi Tester') }}
        </button>
      </div>

      <!-- Social proof metrics card -->
      <div class="pt-6 w-full max-w-3xl mx-auto">
        <div class="grid grid-cols-1 min-[425px]:grid-cols-3 gap-3 min-[425px]:gap-0 py-4 sm:py-5 px-4 sm:px-8 rounded-2xl bg-zinc-900/60 border border-zinc-800/90 backdrop-blur-md divide-y min-[425px]:divide-y-0 min-[425px]:divide-x divide-zinc-800/80 shadow-xl shadow-black/20">
          <div class="text-center px-2 sm:px-4 py-2 min-[425px]:py-0">
            <p class="text-2xl min-[375px]:text-3xl sm:text-4xl font-black text-white tracking-tight">500+</p>
            <p class="text-zinc-400 text-xs sm:text-sm font-medium mt-1">{{ __('Pengujian Selesai') }}</p>
          </div>
          <div class="text-center px-2 sm:px-4 py-2 min-[425px]:py-0">
            <p class="text-2xl min-[375px]:text-3xl sm:text-4xl font-black text-white tracking-tight">1,200+</p>
            <p class="text-zinc-400 text-xs sm:text-sm font-medium mt-1">{{ __('Tester Aktif') }}</p>
          </div>
          <div class="text-center px-2 sm:px-4 py-2 min-[425px]:py-0">
            <p class="text-2xl min-[375px]:text-3xl sm:text-4xl font-black text-[#ffd900] tracking-tight">100%</p>
            <p class="text-zinc-400 text-xs sm:text-sm font-medium mt-1">{{ __('Komisi Tunai') }}</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Wave divider -->
    <div class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
      <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-14 fill-[#111111]">
        <path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" />
      </svg>
    </div>
  </section>


  <!-- ════════════════════════════════════════════
     3. HOW IT WORKS – Steps
     ════════════════════════════════════════════ -->
  <section id="how-it-works" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 dark:bg-[#111111]">
    <div class="max-w-7xl mx-auto">

      <div class="text-center mb-14 reveal">
        <span class="text-[#ca8a04] dark:text-[#ffd900] font-bold text-sm uppercase tracking-widest">{{ __('Cara Kerja') }}</span>
        <h2 class="text-3xl sm:text-4xl font-black text-slate-800 dark:text-white mt-2">{{ __('Tiga Langkah Alur Pengujian Langsung') }}</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-3 max-w-xl mx-auto">{{ __('Alur kerja sederhana dan transparan untuk penyelenggaraan pengujian aplikasi tatap muka (face to face).') }}</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Step 1 -->
        <div class="reveal bg-white dark:bg-[#1a1a18] rounded-2xl pt-9 pb-8 px-8 shadow-sm transition duration-300 relative text-center border border-slate-200 dark:border-[#2e2e2e]">
          <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-9 h-9 bg-[#ffd900] text-[#111111] rounded-full flex items-center justify-center font-black text-sm shadow-md ring-4 ring-slate-50 dark:ring-[#111111]">1</div>
          <h3 class="font-bold text-lg text-slate-800 dark:text-white mb-2.5">{{ __('Developer Buat Pengujian') }}</h3>
          <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Developer menentukan lokasi fisik, jadwal tanggal & waktu, jumlah tester, persyaratan khusus, serta nominal komisi (min. Rp 20.000).') }}</p>
        </div>

        <!-- Step 2 -->
        <div class="reveal bg-white dark:bg-[#1a1a18] rounded-2xl pt-9 pb-8 px-8 shadow-sm transition duration-300 relative text-center border border-slate-200 dark:border-[#2e2e2e]" style="transition-delay: 0.15s;">
          <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-9 h-9 bg-[#ffd900] text-[#111111] rounded-full flex items-center justify-center font-black text-sm shadow-md ring-4 ring-slate-50 dark:ring-[#111111]">2</div>
          <h3 class="font-bold text-lg text-slate-800 dark:text-white mb-2.5">{{ __('Tester Melamar & Seleksi') }}</h3>
          <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Tester membaca syarat, menyetujui komitmen kehadiran, dan melamar (Apply). Developer menyeleksi pendaftar sesuai kuota.') }}</p>
        </div>

        <!-- Step 3 -->
        <div class="reveal bg-white dark:bg-[#1a1a18] rounded-2xl pt-9 pb-8 px-8 shadow-sm transition duration-300 relative text-center border border-slate-200 dark:border-[#2e2e2e]" style="transition-delay: 0.3s;">
          <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-9 h-9 bg-[#ffd900] text-[#111111] rounded-full flex items-center justify-center font-black text-sm shadow-md ring-4 ring-slate-50 dark:ring-[#111111]">3</div>
          <h3 class="font-bold text-lg text-slate-800 dark:text-white mb-2.5">{{ __('Testing di Lokasi & Komisi Cair') }}</h3>
          <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Tester hadir langsung di lokasi sesuai jadwal. Setelah selesai, developer mengonfirmasi kehadiran dan komisi otomatis cair ke dompet tester.') }}</p>
        </div>

      </div>
    </div>
  </section>


  <!-- ════════════════════════════════════════════
     4. DUAL INFO SECTION – Tabbed layout (jQuery)
     ════════════════════════════════════════════ -->
  <section id="benefits" class="py-20 px-4 sm:px-6 lg:px-8 bg-white dark:bg-[#111111]">
    <div class="max-w-5xl mx-auto">

      <div class="text-center mb-10 reveal">
        <span class="text-[#ca8a04] dark:text-[#ffd900] font-bold text-sm uppercase tracking-widest">{{ __('Manfaat') }}</span>
        <h2 class="text-3xl sm:text-4xl font-black text-slate-800 dark:text-white mt-2">{{ __('Platform untuk Semua Orang') }}</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-3 max-w-xl mx-auto">{{ __('Pilih perspektif Anda dan temukan bagaimana Testoplay memberikan nilai nyata.') }}</p>
      </div>

      <!-- ── Tab Switcher ── -->
      <div class="flex justify-center mb-10 reveal">
        <div class="inline-flex bg-slate-100 dark:bg-[#1a1a18] p-1.5 rounded-2xl gap-1 border border-slate-200 dark:border-[#2e2e2e]">
          <button class="tab-btn active px-6 py-2.5 rounded-xl text-sm font-semibold transition duration-200 hover:bg-white dark:hover:bg-[#242424] focus:outline-none" data-tab="developer">
            <i class="fa-solid fa-code mr-2 text-[#ffd900]"></i>{{ __('Untuk Developer') }}
          </button>
          <button class="tab-btn px-6 py-2.5 rounded-xl text-sm font-semibold text-slate-500 dark:text-slate-400 transition duration-200 hover:bg-white dark:hover:bg-[#242424] focus:outline-none" data-tab="tester">
            <i class="fa-solid fa-mobile-screen-button mr-2 text-slate-400"></i>{{ __('Untuk Tester') }}
          </button>
        </div>
      </div>

      <!-- ── Tab Contents ── -->
      <div id="tab-developer" class="tab-content active reveal">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

          <!-- Benefit 1 -->
          <div class="bg-slate-50 dark:bg-[#1a1a18] rounded-2xl p-7 border border-slate-200 dark:border-[#2e2e2e] transition duration-300">
            <h4 class="font-bold text-lg text-slate-800 dark:text-white mb-2.5">{{ __('Lokasi & Jadwal Fleksibel') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Tentukan sendiri tanggal, jam, dan lokasi fisik yang paling sesuai untuk mengadakan sesi pengujian langsung.') }}</p>
          </div>

          <!-- Benefit 2 -->
          <div class="bg-slate-50 dark:bg-[#1a1a18] rounded-2xl p-7 border border-slate-200 dark:border-[#2e2e2e] transition duration-300">
            <h4 class="font-bold text-lg text-slate-800 dark:text-white mb-2.5">{{ __('Kendali Penuh Seleksi Tester') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Tinjau profil dan data kontak pendaftar di daftar antrean. Terima hanya tester yang memenuhi kriteria pengujian Anda.') }}</p>
          </div>

          <!-- Benefit 3 -->
          <div class="bg-slate-50 dark:bg-[#1a1a18] rounded-2xl p-7 border border-slate-200 dark:border-[#2e2e2e] transition duration-300">
            <h4 class="font-bold text-lg text-slate-800 dark:text-white mb-2.5">{{ __('Feedback Nyata Tatap Muka') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Saksikan interaksi langsung tester dengan aplikasi Anda secara real-time untuk menemukan kendala teknis dan UX seketika.') }}</p>
          </div>

        </div>
      </div>

      <div id="tab-tester" class="tab-content reveal">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

          <!-- Benefit 1 -->
          <div class="bg-slate-50 dark:bg-[#1a1a18] rounded-2xl p-7 border border-slate-200 dark:border-[#2e2e2e] transition duration-300">
            <h4 class="font-bold text-lg text-slate-800 dark:text-white mb-2.5">{{ __('Komisi Tunai IDR Pasti') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Dapatkan pembayaran komisi langsung ke Bank, DANA, GoPay, OVO, atau ShopeePay tanpa sistem poin.') }}</p>
          </div>

          <!-- Benefit 2 -->
          <div class="bg-slate-50 dark:bg-[#1a1a18] rounded-2xl p-7 border border-slate-200 dark:border-[#2e2e2e] transition duration-300">
            <h4 class="font-bold text-lg text-slate-800 dark:text-white mb-2.5">{{ __('Pilih Sesi yang Cocok') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Cari pengujian di lokasi terdekat dan waktu luang yang Anda inginkan. Daftarkan diri hanya pada sesi yang siap Anda hadiri.') }}</p>
          </div>

          <!-- Benefit 3 -->
          <div class="bg-slate-50 dark:bg-[#1a1a18] rounded-2xl p-7 border border-slate-200 dark:border-[#2e2e2e] transition duration-300">
            <h4 class="font-bold text-lg text-slate-800 dark:text-white mb-2.5">{{ __('Pengalaman Nyata QA') }}</h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">{{ __('Berinteraksi langsung dengan developer, uji fitur-fitur baru, dan bangun portofolio pengujian perangkat lunak Anda.') }}</p>
          </div>

        </div>
      </div>

    </div>
  </section>


  <!-- ════════════════════════════════════════════
     5. PRICING TABLE – Two cards side by side
     ════════════════════════════════════════════ -->
  <section id="pricing" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 dark:bg-[#111111] relative overflow-hidden">

    <div class="max-w-5xl mx-auto relative">

      <div class="text-center mb-14 reveal">
        <span class="text-[#ca8a04] dark:text-[#ffd900] font-bold text-sm uppercase tracking-widest">{{ __('Skema Komisi') }}</span>
        <h2 class="text-3xl sm:text-4xl font-black text-slate-800 dark:text-white mt-2">{{ __('Biaya Transparan Sesuai Kebutuhan') }}</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-3 max-w-xl mx-auto">{{ __('Tanpa paket langganan kaku. Anda bebas menentukan jumlah tester dan nominal komisi yang ingin diberikan.') }}</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">

        <!-- ── Card 1: Ketentuan Komisi ── -->
        <div class="pricing-card reveal bg-white dark:bg-[#1a1a18] rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-[#2e2e2e] flex flex-col justify-between">

          <div>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-6">{{ __('Aturan standar sistem pengujian tatap muka yang adil untuk developer dan tester.') }}</p>

            <div class="mb-6 pb-6 border-b border-slate-100 dark:border-[#2e2e2e]">
              <div class="flex items-baseline gap-1">
                <span class="text-slate-400 text-sm font-medium">Mulai</span>
                <span class="text-slate-400 text-sm font-medium ml-1">Rp</span>
                <span class="text-5xl font-black text-slate-800 dark:text-white">20</span>
                <span class="text-slate-400 text-lg font-medium">.000</span>
                <span class="text-slate-400 text-xs font-normal">/ tester</span>
              </div>
              <p class="text-slate-400 text-xs mt-1">{{ __('Batas minimum komisi per tester · Bebas biaya admin (Rp 0)') }}</p>
            </div>

            <ul class="check-list text-sm text-slate-600 dark:text-slate-300 mb-8 space-y-0">
              <li><i class="fa-solid fa-circle-check text-green-500"></i><span>{{ __('Bebas Tentukan Jumlah Tester (Mulai dari 1 Orang)') }}</span></li>
              <li><i class="fa-solid fa-circle-check text-green-500"></i><span>{{ __('Bebas Tentukan Lokasi & Jadwal Tatap Muka') }}</span></li>
              <li><i class="fa-solid fa-circle-check text-green-500"></i><span>{{ __('Hak Penuh Menyeleksi Calon Tester') }}</span></li>
              <li><i class="fa-solid fa-circle-check text-green-500"></i><span>{{ __('Komisi Baru Masuk Dompet Setelah Tester Selesai') }}</span></li>
            </ul>
          </div>

          <a href="{{ route('filament.developer.auth.login') }}" class="block w-full text-center py-3.5 rounded-xl font-bold text-slate-800 dark:text-white border border-slate-300 dark:border-[#333333] hover:bg-slate-100 dark:hover:bg-[#242424] transition duration-300 text-sm">
            {{ __('Mulai Sebagai Developer') }}
          </a>
        </div>

        <!-- ── Card 2: Simulasi Perhitungan Biaya ── -->
        <div class="pricing-card reveal relative" style="transition-delay: 0.15s;">

          <div class="bg-white dark:bg-[#1a1a18] rounded-2xl p-8 shadow-xl border-2 border-[#ffd900] relative overflow-hidden flex flex-col justify-between h-full">

            <div>
              <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-6">{{ __('Total Biaya = (Jumlah Tester × Komisi per Tester) + Biaya Admin (Rp 0)') }}</p>

              <!-- Example Simulation Table -->
              <div class="space-y-3 mb-8">
                <div class="flex items-center justify-between p-3.5 bg-slate-50 dark:bg-[#242424] rounded-xl border border-slate-200 dark:border-[#333333] text-xs">
                  <div>
                    <span class="font-bold text-slate-900 dark:text-white">3 Tester</span>
                    <span class="text-slate-400"> × Rp 20.000</span>
                  </div>
                  <span class="font-black text-[#ca8a04] dark:text-[#ffd900] text-sm">Rp 60.000</span>
                </div>

                <div class="flex items-center justify-between p-3.5 bg-slate-50 dark:bg-[#242424] rounded-xl border border-slate-200 dark:border-[#333333] text-xs">
                  <div>
                    <span class="font-bold text-slate-900 dark:text-white">5 Tester</span>
                    <span class="text-slate-400"> × Rp 25.000</span>
                  </div>
                  <span class="font-black text-[#ca8a04] dark:text-[#ffd900] text-sm">Rp 125.000</span>
                </div>

                <div class="flex items-center justify-between p-3.5 bg-slate-50 dark:bg-[#242424] rounded-xl border border-slate-200 dark:border-[#333333] text-xs">
                  <div>
                    <span class="font-bold text-slate-900 dark:text-white">10 Tester</span>
                    <span class="text-slate-400"> × Rp 30.000</span>
                  </div>
                  <span class="font-black text-[#ca8a04] dark:text-[#ffd900] text-sm">Rp 300.000</span>
                </div>
              </div>
            </div>

            <div>
              <a href="{{ route('filament.developer.auth.login') }}" class="relative block w-full text-center py-3.5 rounded-xl font-bold text-[#111111] bg-[#ffd900] shadow-md hover:bg-[#e6c400] transition duration-300 text-sm">
                <i class="fa-solid fa-plus-circle mr-1"></i> {{ __('Buat Sesi Pengujian Sekarang') }}
              </a>
            </div>

          </div>
        </div>

      </div>

      <!-- Comparison note -->
      <div class="mt-10 text-center reveal">
        <p class="text-slate-400 text-sm">
          <i class="fa-solid fa-circle-info text-brand-400 mr-1"></i>
          {{ __('Seluruh pembayaran komisi tester dicairkan langsung ke Bank Transfer, DANA, GoPay, OVO, atau ShopeePay.') }}
        </p>
      </div>

    </div>
  </section>


  <!-- ════════════════════════════════════════════
     6. TESTIMONIAL (bonus) – Social proof
     ════════════════════════════════════════════ -->
  <section id="testi" class="py-16 px-4 sm:px-6 lg:px-8 bg-white dark:bg-[#111111]">
    <div class="max-w-6xl mx-auto">

      <div class="text-center mb-10 reveal">
        <span class="text-[#ca8a04] dark:text-[#ffd900] font-bold text-sm uppercase tracking-widest">{{ __('Testimoni') }}</span>
        <h2 class="text-2xl sm:text-3xl font-black text-slate-800 dark:text-white mt-2">{{ __('Dipercaya oleh Developer & Tester Indonesia') }}</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="reveal bg-slate-50 dark:bg-[#1a1a18] border border-slate-200 dark:border-[#2e2e2e] rounded-2xl p-6 shadow-sm transition duration-300">
          <div class="flex gap-1 text-[#ffd900] mb-3 text-sm">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">"{{ __('Saya pernah mencoba platform lain dan gagal. Dengan Testoplay, aplikasi saya lulus dalam 14 hari dan sekarang sudah live di Play Store!') }}"</p>
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-slate-200 dark:bg-[#242424] rounded-full flex items-center justify-center font-bold text-slate-700 dark:text-white text-sm">RD</div>
            <div>
              <p class="font-semibold text-slate-800 dark:text-white text-sm">Rizky D.</p>
              <p class="text-slate-400 text-xs">Developer – Jakarta</p>
            </div>
          </div>
        </div>

        <div class="reveal bg-slate-50 dark:bg-[#1a1a18] border border-slate-200 dark:border-[#2e2e2e] rounded-2xl p-6 shadow-sm transition duration-300" style="transition-delay:0.1s;">
          <div class="flex gap-1 text-[#ffd900] mb-3 text-sm">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">"{{ __('Sebagai tester, saya mendapatkan pengalaman QA nyata dan bisa menambahkannya ke CV saya. Komunitas Testoplay sangat mendukung!') }}"</p>
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-slate-200 dark:bg-[#242424] rounded-full flex items-center justify-center font-bold text-slate-700 dark:text-white text-sm">AN</div>
            <div>
              <p class="font-semibold text-slate-800 dark:text-white text-sm">Ari N.</p>
              <p class="text-slate-400 text-xs">Tester – Surabaya</p>
            </div>
          </div>
        </div>

        <div class="reveal bg-slate-50 dark:bg-[#1a1a18] border border-slate-200 dark:border-[#2e2e2e] rounded-2xl p-6 shadow-sm transition duration-300" style="transition-delay:0.2s;">
          <div class="flex gap-1 text-[#ffd900] mb-3 text-sm">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">"{{ __('Dasbor pemantauannya sangat membantu. Saya bisa melacak progres 14 hari secara real-time. Paket Pro sangat layak!') }}"</p>
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-slate-200 dark:bg-[#242424] rounded-full flex items-center justify-center font-bold text-slate-700 dark:text-white text-sm">FH</div>
            <div>
              <p class="font-semibold text-slate-800 dark:text-white text-sm">Fajar H.</p>
              <p class="text-slate-400 text-xs">Developer – Bandung</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ════════════════════════════════════════════
     7. CTA BANNER – Bottom call to action
     ════════════════════════════════════════════ -->
  <section class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-100 dark:bg-[#111111] relative overflow-hidden border-t border-slate-200 dark:border-[#2e2e2e]">

    <div class="max-w-3xl mx-auto text-center relative reveal">

      <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white leading-tight mb-4">
        {{ __('Siap Meluncurkan Aplikasi Anda di Play Store?') }}
      </h2>

      <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed mb-8 max-w-2xl mx-auto">
        {{ __('Atau Anda ingin mulai membantu developer lain sambil membangun pengalaman QA Anda? Bergabunglah dengan') }} <strong class="text-slate-900 dark:text-white">Testoplay</strong> {{ __('sekarang dan jadilah bagian dari ekosistem pengujian terbaik.') }}
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <button onclick="window.location.href='{{ route('filament.developer.auth.register') }}'" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-[#ffd900] text-[#111111] font-bold rounded-2xl shadow-xl hover:bg-[#e6c400] transition duration-300">
          {{ __('Mulai sebagai Developer') }}
        </button>
        <button onclick="window.location.href='{{ route('filament.tester.auth.register') }}'" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white dark:bg-[#242424] border border-slate-300 dark:border-[#333333] text-slate-800 dark:text-white font-semibold rounded-2xl hover:bg-slate-50 dark:hover:bg-[#2e2e2e] transition duration-300">
          {{ __('Daftar sebagai Tester') }}
        </button>
      </div>

    </div>
  </section>


  <!-- ════════════════════════════════════════════
     8. FOOTER
     ════════════════════════════════════════════ -->
  <footer class="bg-white dark:bg-[#111111] text-slate-500 dark:text-slate-400 py-12 px-4 sm:px-6 lg:px-8 border-t border-slate-200 dark:border-[#2e2e2e] transition-colors duration-200">
    <div class="max-w-7xl mx-auto">

      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-10 border-b border-slate-100 dark:border-slate-800">

        <!-- Brand -->
        <div class="md:col-span-2">
          <div class="flex items-center mb-4">
            <img src="{{ asset('logo.png') }}" alt="Testoplay" class="h-12 w-auto object-contain dark:hidden" />
            <img src="{{ asset('logo-dark.png') }}" alt="Testoplay" class="h-12 w-auto object-contain hidden dark:block" />
          </div>
          <p class="text-sm leading-relaxed max-w-xs text-slate-500 dark:text-slate-400">{{ __('Platform kolaborasi untuk Developer dan Tester Indonesia berbasis Project Based Learning untuk memenuhi persyaratan Google Play Closed Testing.') }}</p>
          <div class="flex gap-3 mt-5">
            <a href="#" class="w-9 h-9 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-300 rounded-xl flex items-center justify-center hover:bg-brand-600 hover:text-white dark:hover:bg-brand-600 dark:hover:text-white transition duration-200" aria-label="Instagram">
              <i class="fa-brands fa-instagram text-sm"></i>
            </a>
            <a href="#" class="w-9 h-9 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-300 rounded-xl flex items-center justify-center hover:bg-brand-600 hover:text-white dark:hover:bg-brand-600 dark:hover:text-white transition duration-200" aria-label="Twitter/X">
              <i class="fa-brands fa-x-twitter text-sm"></i>
            </a>
            <a href="#" class="w-9 h-9 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-300 rounded-xl flex items-center justify-center hover:bg-brand-600 hover:text-white dark:hover:bg-brand-600 dark:hover:text-white transition duration-200" aria-label="LinkedIn">
              <i class="fa-brands fa-linkedin-in text-sm"></i>
            </a>
            <a href="#" class="w-9 h-9 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-300 rounded-xl flex items-center justify-center hover:bg-brand-600 hover:text-white dark:hover:bg-brand-600 dark:hover:text-white transition duration-200" aria-label="Telegram">
              <i class="fa-brands fa-telegram text-sm"></i>
            </a>
          </div>
        </div>

        <!-- Platform links -->
        <div>
          <h5 class="text-slate-900 dark:text-white font-bold text-sm mb-4">{{ __('Platform') }}</h5>
          <ul class="space-y-2.5 text-sm">
            <li><a href="#how-it-works" class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Cara Kerja') }}</a></li>
            <li><a href="#benefits" class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Manfaat') }}</a></li>
            <li><a href="#pricing" class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Harga') }}</a></li>
            <li><a href="#hero" class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Dasbor') }}</a></li>
            <li><a href="#testi" class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Blog') }}</a></li>
          </ul>
        </div>

        <!-- Legal links -->
        <div>
          <h5 class="text-slate-900 dark:text-white font-bold text-sm mb-4">{{ __('Legal & Dukungan') }}</h5>
          <ul class="space-y-2.5 text-sm">
            <li><a href="{{ route('kebijakan-privasi') }}" class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Kebijakan Privasi') }}</a></li>
            <li><a href="{{ route('syarat-ketentuan') }}" class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Syarat & Ketentuan') }}</a></li>
            <li><a href="{{ route('faq') }}" class="hover:text-brand-600 dark:hover:text-white transition">{{ __('FAQ') }}</a></li>
            <li><a href="{{ route('hubungi-kami') }}" class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Hubungi Kami') }}</a></li>
          </ul>
        </div>

      </div>

      <!-- Bottom bar -->
      <div class="pt-6 text-center text-xs text-slate-500 dark:text-slate-400">
        <p>© 2026 <span class="text-slate-700 dark:text-slate-400 font-semibold">Testoplay</span>. {{ __('Hak cipta dilindungi undang-undang.') }}</p>
      </div>

    </div>
  </footer>


  <!-- ════════════════════════════════════════════
     9. AUTH MODAL (Login/Register Selection)
     ════════════════════════════════════════════ -->
  <div id="authModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeAuthModal()"></div>

    <!-- Modal Content -->
    <div class="bg-white dark:bg-[#1a1a18] rounded-3xl w-full max-w-md relative z-10 shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 border border-slate-200 dark:border-[#2e2e2e]" id="authModalContent">
      <button onclick="closeAuthModal()" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-[#242424] text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-[#2e2e2e] hover:text-slate-800 dark:hover:text-white transition">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <div class="p-8">
        <div class="text-center mb-6 mt-1">
          <h3 id="authModalTitle" class="text-2xl font-black text-slate-800 dark:text-white">{{ __('Pilih Akun') }}</h3>
          <p id="authModalDesc" class="text-slate-500 dark:text-slate-400 text-sm mt-2">{{ __('Silakan pilih peran Anda untuk melanjutkan.') }}</p>
        </div>
        <div class="space-y-4">
          <!-- Developer -->
          <a id="btnAuthDeveloper" href="#" class="group flex items-center p-4 border-2 border-slate-200 dark:border-[#2e2e2e] bg-slate-50 dark:bg-[#242424] rounded-2xl hover:border-[#ffd900] transition duration-300">
            <div class="w-12 h-12 bg-slate-200 dark:bg-[#1a1a18] group-hover:bg-[#ffd900]/20 rounded-xl flex items-center justify-center transition duration-300">
              <i class="fa-solid fa-code text-slate-600 dark:text-slate-300 group-hover:text-[#ca8a04] dark:group-hover:text-[#ffd900]"></i>
            </div>
            <div class="ml-4 flex-1">
              <h4 class="font-bold text-slate-800 dark:text-white group-hover:text-[#ca8a04] dark:group-hover:text-[#ffd900] transition">{{ __('Developer') }}</h4>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ __('Pemilik aplikasi yang butuh tester') }}</p>
            </div>
            <i class="fa-solid fa-chevron-right text-slate-400 dark:text-slate-500 group-hover:text-[#ffd900] transition"></i>
          </a>
          <!-- Tester -->
          <a id="btnAuthTester" href="#" class="group flex items-center p-4 border-2 border-slate-200 dark:border-[#2e2e2e] bg-slate-50 dark:bg-[#242424] rounded-2xl hover:border-[#ffd900] transition duration-300">
            <div class="w-12 h-12 bg-slate-200 dark:bg-[#1a1a18] group-hover:bg-[#ffd900]/20 rounded-xl flex items-center justify-center transition duration-300">
              <i class="fa-solid fa-mobile-screen-button text-slate-600 dark:text-slate-300 group-hover:text-[#ca8a04] dark:group-hover:text-[#ffd900]"></i>
            </div>
            <div class="ml-4 flex-1">
              <h4 class="font-bold text-slate-800 dark:text-white group-hover:text-[#ca8a04] dark:group-hover:text-[#ffd900] transition">{{ __('Tester') }}</h4>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ __('Penguji aplikasi untuk Google Play') }}</p>
            </div>
            <i class="fa-solid fa-chevron-right text-slate-400 dark:text-slate-500 group-hover:text-[#ffd900] transition"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    const authRoutes = {
      login: {
        developer: "{{ route('filament.developer.auth.login') }}",
        tester: "{{ route('filament.tester.auth.login') }}"
      },
      register: {
        developer: "{{ route('filament.developer.auth.register') }}",
        tester: "{{ route('filament.tester.auth.register') }}"
      }
    };

    function openAuthModal(type) {
      const modal = document.getElementById('authModal');
      const content = document.getElementById('authModalContent');
      const title = document.getElementById('authModalTitle');
      const desc = document.getElementById('authModalDesc');
      const icon = document.getElementById('authModalIcon');
      const btnDev = document.getElementById('btnAuthDeveloper');
      const btnTester = document.getElementById('btnAuthTester');

      // Close mobile menu if open
      document.getElementById('hamburger').classList.remove('open');
      document.getElementById('mobile-menu').classList.remove('open');

      if (type === 'login') {
        title.innerText = '{{ __("Masuk Sebagai") }}';
        desc.innerText = '{{ __("Pilih akun untuk mengakses dasbor Anda.") }}';
        if (icon) icon.className = 'fa-solid fa-right- text-brand-600 text-xl';
        btnDev.href = authRoutes.login.developer;
        btnTester.href = authRoutes.login.tester;
      } else {
        title.innerText = '{{ __("Daftar Sebagai") }}';
        desc.innerText = '{{ __("Pilih peran yang sesuai dengan tujuan Anda.") }}';
        if (icon) icon.className = 'fa-solid fa-user-plus text-brand-600 text-xl';
        btnDev.href = authRoutes.register.developer;
        btnTester.href = authRoutes.register.tester;
      }

      modal.classList.remove('hidden');
      modal.classList.add('flex');
      setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
      }, 10);
    }

    function closeAuthModal() {
      const modal = document.getElementById('authModal');
      const content = document.getElementById('authModalContent');
      content.classList.remove('scale-100', 'opacity-100');
      content.classList.add('scale-95', 'opacity-0');
      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }, 300);
    }
  </script>

  <script>
    function toggleNavDropdown() {
      var menu = document.getElementById('navDropdownMenu');
      var chevron = document.getElementById('navDropdownChevron');
      if (!menu) return;
      var isHidden = menu.classList.contains('hidden');
      menu.classList.toggle('hidden', !isHidden);
      chevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
    }
  </script>


  <!-- ════════════════════════════════════════════
     SCRIPTS – jQuery 3.7.1 Interactions
     ════════════════════════════════════════════ -->
  <script>
    $(function() {

      /* ── 0. NAVBAR DROPDOWN: Lainnya ── */
      // Close dropdown when clicking outside
      document.addEventListener('click', function(e) {
        var wrapper = document.getElementById('navDropdownWrapper');
        if (wrapper && !wrapper.contains(e.target)) {
          var menu = document.getElementById('navDropdownMenu');
          var chevron = document.getElementById('navDropdownChevron');
          if (menu) menu.classList.add('hidden');
          if (chevron) chevron.style.transform = 'rotate(0deg)';
        }
      });

      /* ── 1. NAVBAR: Sticky scroll shadow ── */

      $(window).on('scroll', function() {
        if ($(this).scrollTop() > 10) {
          $('#navbar').addClass('scrolled');
        } else {
          $('#navbar').removeClass('scrolled');
        }
      });

      /* ── 2. HAMBURGER MENU: Toggle mobile menu ── */
      $('#hamburger').on('click', function() {
        $(this).toggleClass('open');
        $('#mobile-menu').toggleClass('open');
      });

      /* Close mobile menu when a link is clicked */
      $('#mobile-menu a').on('click', function() {
        $('#hamburger').removeClass('open');
        $('#mobile-menu').removeClass('open');
      });

      /* ── 3. SMOOTH SCROLLING: All anchor links ── */
      $('a[href^="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
          e.preventDefault();
          $('html, body').stop().animate({
            scrollTop: target.offset().top - 64 // 64px navbar offset
          }, 600, 'swing');
        }
      });

      /* ── 4. TAB SWITCHING: Developer / Tester ── */
      $('.tab-btn').on('click', function() {
        var tabId = $(this).data('tab');

        // Update button styles
        $('.tab-btn').removeClass('active bg-white shadow-sm text-slate-800').addClass('text-slate-500');
        $(this).addClass('active bg-white shadow-sm text-slate-800').removeClass('text-slate-500');

        // Switch tab content with fade
        $('.tab-content').removeClass('active').hide();
        $('#tab-' + tabId).addClass('active').hide().fadeIn(300);
      });

      /* ── 5. SCROLL REVEAL: Animate elements on scroll ── */
      function revealOnScroll() {
        var scrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();

        $('.reveal').each(function() {
          var elemTop = $(this).offset().top;
          if (elemTop < scrollTop + windowHeight - 60) {
            $(this).addClass('visible');
          }
        });
      }

      $(window).on('scroll', revealOnScroll);
      revealOnScroll(); // run once on load

      /* ── 6. PROGRESS BAR: Animate on first scroll into view ── */
      var progressAnimated = false;
      $(window).on('scroll', function() {
        if (progressAnimated) return;
        var bar = $('.progress-fill');
        if (bar.length) {
          var barTop = bar.offset().top;
          if (barTop < $(window).scrollTop() + $(window).height() - 40) {
            progressAnimated = true;
            bar.css('width', bar.css('--fill') || '64%');
          }
        }
      });

      /* ── 7. NAVBAR LINK ACTIVE STATE on scroll ── */
      var sections = ['how-it-works', 'benefits', 'pricing', 'hero', 'testi'];
      $(window).on('scroll', function() {
        var scrollPos = $(this).scrollTop() + 80;
        sections.forEach(function(id) {
          var section = $('#' + id);
          if (section.length) {
            if (scrollPos >= section.offset().top && scrollPos < section.offset().top + section.outerHeight()) {
              $('nav a[href="#' + id + '"]').addClass('text-brand-600 font-semibold');
            } else {
              $('nav a[href="#' + id + '"]').removeClass('text-brand-600 font-semibold');
            }
          }
        });
      });

    });
  </script>

</body>

</html>
