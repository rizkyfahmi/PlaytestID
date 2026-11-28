<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Testoplay – Closed Testing Partner')</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any" />

  <!-- ─── Google Fonts: Inter ─── -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet" />

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
              '0%': { opacity: '0', transform: 'translateY(24px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            floatY: {
              '0%,100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-10px)' }
            },
            pulseDot: {
              '0%,100%': { opacity: '1' },
              '50%': { opacity: '0.4' }
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
      (function () {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        localStorage.setItem('pt-theme', 'dark');
      })();
  </script>

  <!-- ─── Custom CSS ─── -->
  <style>
    * {
      font-family: 'Inter', sans-serif;
    }

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
    html.dark #legal-dropdown-menu {
      background: #111111 !important;
      border-color: #222222 !important;
    }
    html.dark #mobile-menu {
      background: #111111 !important;
      border-color: #222222 !important;
    }

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
      background: #fde047;
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

    #mobile-menu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    #mobile-menu.open {
      max-height: 500px;
    }

    body,
    #navbar,
    .pricing-card>div,
    .glass-card {
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    /* ── Helden Inc Button Contrast ── */
    .bg-brand-600.text-white,
    .bg-brand-500.text-white {
      color: #111111 !important;
      font-weight: 800 !important;
    }

    /* ── Language Dropdown (Helden Inc style) ── */
    .lang-dropdown-wrapper {
      position: relative;
      display: inline-block;
      vertical-align: middle;
      z-index: 60;
      font-family: inherit;
    }

    .lang-dropdown-trigger {
      height: 32px !important;
      padding: 0 10px !important;
      background: #18181b !important;
      border: 1px solid #2e2e34 !important;
      border-radius: 6px !important;
      color: #f4f4f5 !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      cursor: pointer !important;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
      transition: all 0.15s ease !important;
      user-select: none !important;
      outline: none !important;
      width: auto !important;
      line-height: normal !important;
    }

    .lang-dropdown-trigger:hover {
      background: #222226 !important;
      border-color: #ffd900 !important;
      color: #ffffff !important;
    }

    .lang-dropdown-wrapper.open .lang-dropdown-trigger {
      border-color: #ffd900 !important;
    }

    .lang-dropdown-label {
      font-size: 13px !important;
      font-weight: 500 !important;
      color: #f4f4f5 !important;
      letter-spacing: -0.01em !important;
    }

    .lang-dropdown-arrow {
      width: 8px;
      height: 5px;
      color: #a1a1aa;
      transition: transform 0.15s ease, color 0.15s ease;
      flex-shrink: 0;
    }

    .lang-dropdown-trigger:hover .lang-dropdown-arrow,
    .lang-dropdown-wrapper.open .lang-dropdown-arrow {
      color: #ffd900;
      transform: rotate(180deg);
    }

    .lang-dropdown-menu {
      position: absolute;
      top: calc(100% + 4px);
      left: 0;
      min-width: 100%;
      width: max-content;
      min-width: 140px;
      background: #18181b !important;
      border: 1px solid #2e2e34 !important;
      border-radius: 6px !important;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.7), 0 8px 10px -6px rgba(0, 0, 0, 0.6) !important;
      padding: 4px !important;
      z-index: 100;
    }

    .lang-dropdown-item {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      padding: 6px 10px !important;
      border-radius: 4px !important;
      color: #d4d4d8 !important;
      font-size: 13px !important;
      font-weight: 500 !important;
      text-decoration: none !important;
      transition: all 0.12s ease !important;
      cursor: pointer !important;
      white-space: nowrap !important;
    }

    .lang-dropdown-item:hover {
      background: #27272a !important;
      color: #ffffff !important;
    }

    .lang-dropdown-item.active {
      background: rgba(255, 217, 0, 0.12) !important;
      font-weight: 600 !important;
      color: #ffd900 !important;
    }
  </style>
  @yield('styles')
</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased">

  <!-- ════════════════════════════════════════════
     NAVBAR
     ════════════════════════════════════════════ -->
  <header id="navbar"
    class="fixed top-0 inset-x-0 z-50 bg-white/95 dark:bg-[#111111] border-b border-slate-100 dark:border-[#222222] transition-all duration-300">
    <nav class="w-full px-4 sm:px-8 lg:px-12">
      <div class="flex items-center justify-between h-16">

        <!-- Logo -->
        <a href="/" class="flex items-center select-none animate-fadeUp">
          <img src="{{ asset('logo.png') }}" alt="Testoplay" class="h-8 min-[375px]:h-9 sm:h-12 w-auto object-contain dark:hidden" />
          <img src="{{ asset('logo-dark.png') }}" alt="Testoplay"
            class="h-8 min-[375px]:h-9 sm:h-12 w-auto object-contain hidden dark:block" />
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-slate-400">
          <li><a href="/{{ App::getLocale() }}#how-it-works"
              class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Cara Kerja') }}</a>
          </li>
          <li><a href="/{{ App::getLocale() }}#benefits"
              class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Manfaat') }}</a>
          </li>
          <li><a href="/{{ App::getLocale() }}#pricing"
              class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Harga') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#hero"
              class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Dasbor') }}</a></li>
          <li><a href="/{{ App::getLocale() }}#testi"
              class="hover:text-brand-600 dark:hover:text-brand-400 transition duration-200">{{ __('Blog') }}</a></li>

          <!-- Dropdown Legal & Support -->
          <li class="relative">
            <button id="legal-dropdown-btn"
              class="flex items-center gap-1.5 hover:text-brand-600 dark:hover:text-brand-400 transition duration-200 focus:outline-none">
              {{ __('Legal & Dukungan') }}
              <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"
                id="legal-dropdown-arrow"></i>
            </button>
            <!-- Dropdown Menu -->
            <ul id="legal-dropdown-menu"
              class="absolute left-0 mt-3 w-52 bg-white dark:bg-[#1a1a18] border border-slate-100 dark:border-[#2e2e2e] rounded-2xl shadow-xl py-2 hidden z-50 transform scale-95 opacity-0 transition-all duration-200 origin-top-left">
              <li><a href="{{ route('privacy-policy', ['locale' => App::getLocale()]) }}"
                  class="block px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Kebijakan Privasi') }}</a>
              </li>
              <li><a href="{{ route('terms-conditions', ['locale' => App::getLocale()]) }}"
                  class="block px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Syarat & Ketentuan') }}</a>
              </li>
              <li><a href="{{ route('faq', ['locale' => App::getLocale()]) }}"
                  class="block px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('FAQ') }}</a>
              </li>
              <li><a href="{{ route('contact-us', ['locale' => App::getLocale()]) }}"
                  class="block px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Hubungi Kami') }}</a>
              </li>
            </ul>
          </li>
        </ul>

        <!-- Desktop CTA -->
        <div class="hidden md:flex items-center gap-3">
          <button onclick="openAuthModal('login')"
            class="px-4 py-2 text-sm font-semibold text-brand-600 dark:text-brand-400 border-2 border-brand-600 dark:border-brand-500 rounded-xl hover:bg-brand-50 dark:hover:bg-brand-950 transition duration-200">
            {{ __('Masuk') }}
          </button>
          <button onclick="openAuthModal('register')"
            class="px-4 py-2 text-sm font-semibold text-white bg-brand-600 rounded-xl shadow-md hover:bg-brand-700 transition duration-200">
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
          <button id="hamburger" aria-label="Toggle menu"
            class="flex flex-col gap-[6px] p-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 transition">
            <span class="ham-line"></span>
            <span class="ham-line"></span>
            <span class="ham-line"></span>
          </button>
        </div>
      </div>

      <!-- Mobile Menu (collapsible, jQuery controlled) -->
      <div id="mobile-menu" class="md:hidden border-t border-slate-100 dark:border-[#2e2e2e]">
        <ul class="flex flex-col py-4 gap-1 text-sm font-medium text-slate-700 dark:text-slate-300">
          <li><a href="/{{ App::getLocale() }}#how-it-works"
              class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Cara Kerja') }}</a>
          </li>
          <li><a href="/{{ App::getLocale() }}#benefits"
              class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Manfaat') }}</a>
          </li>
          <li><a href="/{{ App::getLocale() }}#pricing"
              class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Harga') }}</a>
          </li>
          <li><a href="/{{ App::getLocale() }}#hero"
              class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Dasbor') }}</a>
          </li>
          <li><a href="/{{ App::getLocale() }}#testi"
              class="block px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition">{{ __('Blog') }}</a>
          </li>

          <!-- Mobile Accordion Legal & Support -->
          <li class="border-b border-slate-100 dark:border-slate-800 pb-1">
            <button id="legal-mobile-btn"
              class="flex w-full items-center justify-between px-3 py-2 rounded-lg hover:bg-brand-50 dark:hover:bg-slate-800 hover:text-brand-600 dark:hover:text-brand-400 transition focus:outline-none">
              <span>{{ __('Legal & Dukungan') }}</span>
              <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" id="legal-mobile-arrow"></i>
            </button>
            <ul id="legal-mobile-menu" class="hidden pl-4 pr-3 py-1.5 flex-col gap-1 text-sm">
              <li><a href="{{ route('privacy-policy', ['locale' => App::getLocale()]) }}"
                  class="block py-2 text-slate-500 dark:text-slate-400 hover:text-brand-600 transition">{{ __('Kebijakan Privasi') }}</a>
              </li>
              <li><a href="{{ route('terms-conditions', ['locale' => App::getLocale()]) }}"
                  class="block py-2 text-slate-500 dark:text-slate-400 hover:text-brand-600 transition">{{ __('Syarat & Ketentuan') }}</a>
              </li>
              <li><a href="{{ route('faq', ['locale' => App::getLocale()]) }}"
                  class="block py-2 text-slate-500 dark:text-slate-400 hover:text-brand-600 transition">{{ __('FAQ') }}</a>
              </li>
              <li><a href="{{ route('contact-us', ['locale' => App::getLocale()]) }}"
                  class="block py-2 text-slate-500 dark:text-slate-400 hover:text-brand-600 transition">{{ __('Hubungi Kami') }}</a>
              </li>
            </ul>
          </li>

          <li class="border-t border-slate-100 dark:border-slate-800 mt-2 pt-3 flex gap-2">
            <button onclick="openAuthModal('login')"
              class="flex-1 text-center px-4 py-2 font-semibold text-brand-600 dark:text-brand-400 border-2 border-brand-600 dark:border-brand-500 rounded-xl hover:bg-brand-50 dark:hover:bg-brand-950 transition">{{ __('Masuk') }}</button>
            <button onclick="openAuthModal('register')"
              class="flex-1 text-center px-4 py-2 font-semibold text-white bg-brand-600 rounded-xl shadow hover:bg-brand-700 transition">{{ __('Daftar') }}</button>
          </li>
          <li class="mt-2 flex justify-center gap-4">
            <a href="{{ $enUrl }}"
              class="text-xs font-bold {{ App::getLocale() == 'en' ? 'text-brand-600 underline' : 'text-slate-400' }}">English
              (EN)</a>
            <a href="{{ $idUrl }}"
              class="text-xs font-bold {{ App::getLocale() == 'id' ? 'text-brand-600 underline' : 'text-slate-400' }}">Bahasa
              Indonesia (ID)</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- ════════════════════════════════════════════
     MAIN CONTENT
     ════════════════════════════════════════════ -->
  <main class="min-h-screen">
    @yield('content')
  </main>

  <!-- ════════════════════════════════════════════
     FOOTER
     ════════════════════════════════════════════ -->
  <footer
    class="bg-white dark:bg-[#111111] text-slate-500 dark:text-slate-400 py-12 px-4 sm:px-6 lg:px-8 border-t border-slate-100 dark:border-[#222222] transition-colors duration-200">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-10 border-b border-slate-100 dark:border-[#222222]">

        <!-- Brand -->
        <div class="md:col-span-2">
          <div class="flex items-center mb-4">
            <img src="{{ asset('logo.png') }}" alt="Testoplay" class="h-12 w-auto object-contain dark:hidden" />
            <img src="{{ asset('logo-dark.png') }}" alt="Testoplay"
              class="h-12 w-auto object-contain hidden dark:block" />
          </div>
          <p class="text-sm leading-relaxed max-w-xs text-slate-500 dark:text-slate-400">
            {{ __('Platform kolaborasi untuk Developer dan Tester Indonesia berbasis Project Based Learning untuk memenuhi persyaratan Google Play Closed Testing.') }}
          </p>
          <div class="flex gap-3 mt-5">
            <a href="#"
              class="w-9 h-9 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-300 rounded-xl flex items-center justify-center hover:bg-brand-600 hover:text-white dark:hover:bg-brand-600 dark:hover:text-white transition duration-200"
              aria-label="Instagram">
              <i class="fa-brands fa-instagram text-sm"></i>
            </a>
            <a href="#"
              class="w-9 h-9 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-300 rounded-xl flex items-center justify-center hover:bg-brand-600 hover:text-white dark:hover:bg-brand-600 dark:hover:text-white transition duration-200"
              aria-label="Twitter/X">
              <i class="fa-brands fa-x-twitter text-sm"></i>
            </a>
            <a href="#"
              class="w-9 h-9 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-300 rounded-xl flex items-center justify-center hover:bg-brand-600 hover:text-white dark:hover:bg-brand-600 dark:hover:text-white transition duration-200"
              aria-label="LinkedIn">
              <i class="fa-brands fa-linkedin-in text-sm"></i>
            </a>
            <a href="#"
              class="w-9 h-9 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-300 rounded-xl flex items-center justify-center hover:bg-brand-600 hover:text-white dark:hover:bg-brand-600 dark:hover:text-white transition duration-200"
              aria-label="Telegram">
              <i class="fa-brands fa-telegram text-sm"></i>
            </a>
          </div>
        </div>

        <!-- Platform links -->
        <div>
          <h5 class="text-slate-900 dark:text-white font-bold text-sm mb-4">{{ __('Platform') }}</h5>
          <ul class="space-y-2.5 text-sm">
            <li><a href="/{{ App::getLocale() }}#how-it-works"
                class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Cara Kerja') }}</a></li>
            <li><a href="/{{ App::getLocale() }}#benefits"
                class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Manfaat') }}</a></li>
            <li><a href="/{{ App::getLocale() }}#pricing"
                class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Harga') }}</a></li>
            <li><a href="/{{ App::getLocale() }}#hero"
                class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Dasbor') }}</a></li>
            <li><a href="/{{ App::getLocale() }}#testi"
                class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Blog') }}</a></li>
          </ul>
        </div>

        <!-- Legal links -->
        <div>
          <h5 class="text-slate-900 dark:text-white font-bold text-sm mb-4">{{ __('Legal & Dukungan') }}</h5>
          <ul class="space-y-2.5 text-sm">
            <li><a href="{{ route('privacy-policy', ['locale' => App::getLocale()]) }}"
                class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Kebijakan Privasi') }}</a></li>
            <li><a href="{{ route('terms-conditions', ['locale' => App::getLocale()]) }}"
                class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Syarat & Ketentuan') }}</a></li>
            <li><a href="{{ route('faq', ['locale' => App::getLocale()]) }}"
                class="hover:text-brand-600 dark:hover:text-white transition">{{ __('FAQ') }}</a></li>
            <li><a href="{{ route('contact-us', ['locale' => App::getLocale()]) }}"
                class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Hubungi Kami') }}</a></li>
          </ul>
        </div>

      </div>

      <!-- Bottom bar -->
      <div
        class="pt-6 text-center text-xs text-slate-500 dark:text-slate-400">
        <p>© 2026 <span class="text-slate-700 dark:text-slate-400 font-semibold">Testoplay</span>.
          {{ __('Hak cipta dilindungi undang-undang.') }}</p>
      </div>
    </div>
  </footer>

  <!-- ════════════════════════════════════════════
     AUTH MODAL
     ════════════════════════════════════════════ -->
  <div id="authModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm transition-opacity"
      onclick="closeAuthModal()"></div>
    <div
      class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md relative z-10 shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 border border-transparent dark:border-slate-800"
      id="authModalContent">
      <button onclick="closeAuthModal()"
        class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 hover:text-slate-800 dark:hover:text-white transition">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <div class="p-8">
        <div class="text-center mb-6 mt-1">
          <h3 id="authModalTitle" class="text-2xl font-black text-slate-800 dark:text-white">{{ __('Pilih Akun') }}</h3>
          <p id="authModalDesc" class="text-slate-500 dark:text-slate-400 text-sm mt-2">
            {{ __('Silakan pilih peran Anda untuk melanjutkan.') }}</p>
        </div>
        <div class="space-y-4">
          <a id="btnAuthDeveloper" href="#"
            class="group flex items-center p-4 border-2 border-slate-100 dark:border-slate-800 rounded-2xl hover:border-brand-500 hover:bg-brand-50 dark:hover:bg-brand-950 transition duration-300">
            <div
              class="w-12 h-12 bg-slate-100 dark:bg-slate-800 group-hover:bg-brand-100 dark:group-hover:bg-brand-900/30 rounded-xl flex items-center justify-center transition duration-300">
              <i
                class="fa-solid fa-code text-slate-500 dark:text-slate-400 group-hover:text-brand-600 dark:group-hover:text-brand-400"></i>
            </div>
            <div class="ml-4 flex-1">
              <h4
                class="font-bold text-slate-800 dark:text-white group-hover:text-brand-700 dark:group-hover:text-brand-400 transition">
                {{ __('Developer') }}</h4>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                {{ __('Pemilik aplikasi yang butuh tester') }}</p>
            </div>
            <i
              class="fa-solid fa-chevron-right text-slate-300 dark:text-slate-600 group-hover:text-brand-500 transition"></i>
          </a>
          <a id="btnAuthTester" href="#"
            class="group flex items-center p-4 border-2 border-slate-100 dark:border-slate-800 rounded-2xl hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-950 transition duration-300">
            <div
              class="w-12 h-12 bg-slate-100 dark:bg-slate-800 group-hover:bg-green-100 dark:group-hover:bg-green-900/30 rounded-xl flex items-center justify-center transition duration-300">
              <i
                class="fa-solid fa-mobile-screen-button text-slate-500 dark:text-slate-400 group-hover:text-green-600 dark:group-hover:text-green-400"></i>
            </div>
            <div class="ml-4 flex-1">
              <h4
                class="font-bold text-slate-800 dark:text-white group-hover:text-green-700 dark:group-hover:text-green-400 transition">
                {{ __('Tester') }}</h4>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                {{ __('Penguji aplikasi untuk Google Play') }}</p>
            </div>
            <i
              class="fa-solid fa-chevron-right text-slate-300 dark:text-slate-600 group-hover:text-green-500 transition"></i>
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
    function toggleLangMenu(btn, e) {
      if (e) {
        e.preventDefault();
        e.stopPropagation();
      }
      const wrap = btn.closest('.lang-dropdown-wrapper');
      if (!wrap) return;
      const menu = wrap.querySelector('.lang-dropdown-menu');
      if (!menu) return;
      const isVisible = menu.style.display === 'flex';
      closeAllLangMenus();
      menu.style.display = isVisible ? 'none' : 'flex';
    }

    function closeAllLangMenus() {
      document.querySelectorAll('.lang-dropdown-menu').forEach(function(m) {
        m.style.display = 'none';
      });
    }

    document.addEventListener('click', function(e) {
      if (!e.target.closest('.lang-dropdown-wrapper')) {
        closeAllLangMenus();
      }
    });
  </script>

  <!-- ─── Core Scripts ─── -->
  <script>
    $(function () {
      // Sticky scroll shadow
      $(window).on('scroll', function () {
        if ($(this).scrollTop() > 10) {
          $('#navbar').addClass('scrolled');
        } else {
          $('#navbar').removeClass('scrolled');
        }
      });

      // Hamburger menu toggle
      $('#hamburger').on('click', function () {
        $(this).toggleClass('open');
        $('#mobile-menu').toggleClass('open');
      });

      $('#mobile-menu a').on('click', function () {
        $('#hamburger').removeClass('open');
        $('#mobile-menu').removeClass('open');
      });

      // Smooth scroll for anchor links
      $('a[href^="#"], a[href^="/id#"], a[href^="/en#"]').on('click', function (e) {
        var href = this.getAttribute('href');
        var hash = href.substring(href.indexOf('#'));
        var target = $(hash);
        if (target.length) {
          e.preventDefault();
          $('html, body').stop().animate({
            scrollTop: target.offset().top - 64
          }, 600, 'swing');
        }
      });

      /* ── 8. LEGAL DROPDOWN (Navbar) ── */
      $('#legal-dropdown-btn').on('click', function (e) {
        e.stopPropagation();
        var menu = $('#legal-dropdown-menu');
        var arrow = $('#legal-dropdown-arrow');

        if (menu.hasClass('hidden')) {
          menu.removeClass('hidden');
          setTimeout(function () {
            menu.removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
          }, 10);
          arrow.addClass('rotate-180');
        } else {
          menu.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
          setTimeout(function () {
            menu.addClass('hidden');
          }, 200);
          arrow.removeClass('rotate-180');
        }
      });

      $(document).on('click', function () {
        var menu = $('#legal-dropdown-menu');
        if (!menu.hasClass('hidden')) {
          menu.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
          setTimeout(function () {
            menu.addClass('hidden');
          }, 200);
          $('#legal-dropdown-arrow').removeClass('rotate-180');
        }
      });

      /* ── 9. LEGAL MOBILE ACCORDION ── */
      $('#legal-mobile-btn').on('click', function () {
        var menu = $('#legal-mobile-menu');
        var arrow = $('#legal-mobile-arrow');

        if (menu.hasClass('hidden')) {
          menu.removeClass('hidden').addClass('flex');
          arrow.addClass('rotate-180');
        } else {
          menu.removeClass('flex').addClass('hidden');
          arrow.removeClass('rotate-180');
        }
      });
    });
  </script>
  @yield('scripts')
</body>

</html>