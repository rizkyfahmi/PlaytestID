<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Kebijakan Privasi') }} – Testoplay</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any" />
  <meta name="description"
    content="{{ __('Kebijakan privasi Testoplay menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda.') }}">
  <script>
    (function () {
      localStorage.setItem('theme', 'dark');
      localStorage.setItem('pt-theme', 'dark');
      document.documentElement.classList.add('dark');
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

    html.dark {
      background-color: #111111 !important;
      color-scheme: dark;
    }
    html.dark body {
      background-color: #111111 !important;
      color: #e2e8f0 !important;
    }

    .dark .page-card {
      background: #1a1a18;
      border-color: #2e2e2e;
      border-top-color: #ffd900;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
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

    @keyframes prof-gradient {

      0%,
      100% {
        background-position: 0% 50%
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
      border: 1px solid #2e2e2e;
      border-radius: 1.5rem;
      isolation: isolate;
      overflow: hidden;
    }

    .prof-blob, .prof-blob-rev, .prof-aurora, .prof-conic, .prof-conic-2, .prof-grid-bg, .prof-shoot, .prof-particles {
      display: none !important;
    }
      position: absolute;
      inset: 0;
      overflow: hidden;
      pointer-events: none;
    }

    .prof-particles span {
      display: none !important;
    }

    /* Twinkling stars */
    .prof-stars {
      display: none !important;
    }

    /* Shooting star */
    .prof-shoot {
      display: none !important;
    }

    .prof-shoot.s2 {
      top: 55%;
      animation-duration: 9s;
      animation-delay: -5s;
      opacity: 0;
    }
  </style>
</head>

<body class="bg-slate-50 dark:bg-[#111111] antialiased">

  <!-- Navbar -->
  <header
    class="fixed top-0 inset-x-0 z-50 bg-white/95 dark:bg-[#1a1a18] border-b border-slate-100 dark:border-[#2e2e2e]">
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
        <!-- Language Switcher (Compact Dropdown) -->
        <!-- Language Switcher (Compact Dropdown) -->
        <div class="pl-3 border-l border-slate-200 dark:border-slate-700">
          <x-language-dropdown />
        </div>
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



      <!-- Main Content -->
      <div class="relative z-10 max-w-3xl mx-auto text-center">
        <div
          class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-xs font-semibold px-4 py-2 rounded-full mb-4 backdrop-blur-sm">
          <i class="fa-solid fa-shield-halved"></i> {{ __('Privasi & Keamanan') }}
        </div>
        <h1 class="text-3xl sm:text-4xl font-black mb-2">{{ __('Kebijakan Privasi') }}</h1>
        <p class="text-brand-100 text-sm">{{ __('Terakhir diperbarui: 1 Juni 2026') }}</p>
      </div>
    </div>
  </div>

  <!-- Content -->
  <main class="max-w-3xl mx-auto px-4 sm:px-6 py-10">
    <div class="page-card">
      <div class="prose">
        <p>
          {{ __('Testoplay ("kami", "kita") menghargai privasi Anda. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi Anda saat menggunakan platform kami.') }}
        </p>

        <h2>1. {{ __('Informasi yang Kami Kumpulkan') }}</h2>
        <p>{{ __('Kami mengumpulkan berbagai jenis informasi sehubungan dengan layanan yang kami sediakan:') }}</p>
        <ul>
          <li>{{ __('Informasi akun: nama lengkap, alamat email, kata sandi (terenkripsi)') }}</li>
          <li>{{ __('Informasi profil: foto profil, bio, tautan media sosial') }}</li>
          <li>{{ __('Data transaksi: riwayat pembayaran, metode pembayaran') }}</li>
          <li>{{ __('Data aktivitas: log masuk, riwayat misi, peringkat ulasan') }}</li>
          <li>{{ __('Data teknis: alamat IP, jenis perangkat, browser, dan waktu akses') }}</li>
        </ul>

        <h2>2. {{ __('Cara Kami Menggunakan Informasi') }}</h2>
        <p>{{ __('Informasi yang dikumpulkan digunakan untuk:') }}</p>
        <ul>
          <li>{{ __('Menyediakan, mengoperasikan, dan meningkatkan layanan platform') }}</li>
          <li>{{ __('Memproses transaksi pembayaran dan pengeluaran reward') }}</li>
          <li>{{ __('Mengirimkan notifikasi terkait akun dan misi') }}</li>
          <li>{{ __('Memverifikasi identitas dan mencegah penipuan') }}</li>
          <li>{{ __('Menganalisis penggunaan platform untuk peningkatan layanan') }}</li>
          <li>{{ __('Memenuhi kewajiban hukum yang berlaku') }}</li>
        </ul>

        <h2>3. {{ __('Berbagi Informasi') }}</h2>
        <p>
          {{ __('Kami tidak menjual informasi pribadi Anda kepada pihak ketiga. Namun, kami dapat membagikan informasi kepada:') }}
        </p>
        <ul>
          <li>{{ __('Penyedia layanan pembayaran (Duitku, Xendit) untuk memproses transaksi') }}</li>
          <li>{{ __('Penyedia layanan cloud (untuk penyimpanan dan hosting)') }}</li>
          <li>{{ __('Pihak berwenang apabila diwajibkan oleh hukum yang berlaku') }}</li>
        </ul>

        <h2>4. {{ __('Keamanan Data') }}</h2>
        <p>
          {{ __('Kami menggunakan langkah-langkah keamanan teknis dan organisasi yang wajar untuk melindungi informasi Anda, termasuk enkripsi data, akses terbatas, dan pemantauan sistem secara berkala.') }}
        </p>

        <h2>5. {{ __('Hak Pengguna') }}</h2>
        <p>{{ __('Anda memiliki hak untuk:') }}</p>
        <ul>
          <li>{{ __('Mengakses dan memperbarui data pribadi Anda') }}</li>
          <li>{{ __('Meminta penghapusan akun dan data Anda') }}</li>
          <li>{{ __('Menarik persetujuan pemrosesan data') }}</li>
          <li>{{ __('Mengajukan keberatan atas pemrosesan data tertentu') }}</li>
        </ul>

        <h2>6. {{ __('Cookies') }}</h2>
        <p>
          {{ __('Platform kami menggunakan cookies untuk menjaga sesi login Anda dan menyimpan preferensi. Anda dapat mengatur browser Anda untuk menolak cookies, namun hal ini dapat mempengaruhi fungsi tertentu.') }}
        </p>

        <h2>7. {{ __('Perubahan Kebijakan') }}</h2>
        <p>
          {{ __('Kami dapat memperbarui Kebijakan Privasi ini sewaktu-waktu. Perubahan signifikan akan diberitahukan melalui email atau notifikasi di platform.') }}
        </p>

        <h2>8. {{ __('Hubungi Kami') }}</h2>
        <p>{{ __('Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, silakan hubungi kami di:') }} <a
            href="mailto:privacy@testoplay.com">privacy@testoplay.com</a></p>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer
    class="bg-white dark:bg-[#111111] text-slate-500 dark:text-slate-400 border-t border-slate-200 dark:border-[#222222] text-center py-6 px-4 text-xs mt-4 transition-colors duration-200">
    <p>© 2026 <span class="text-slate-700 dark:text-slate-300 font-semibold">Testoplay</span>.
      {{ __('Hak cipta dilindungi undang-undang.') }}
    </p>
    <div class="flex flex-wrap justify-center gap-4 mt-2">
      <a href="{{ route('kebijakan-privasi') }}"
        class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Kebijakan Privasi') }}</a>
      <a href="{{ route('syarat-ketentuan') }}"
        class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Syarat & Ketentuan') }}</a>
      <a href="{{ route('faq') }}" class="hover:text-brand-600 dark:hover:text-white transition">FAQ</a>
      <a href="{{ route('hubungi-kami') }}"
        class="hover:text-brand-600 dark:hover:text-white transition">{{ __('Hubungi Kami') }}</a>
    </div>
  </footer>
</body>

</html>
