<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Syarat & Ketentuan') }} – Testoplay</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any" />
  <meta name="description"
    content="{{ __('Syarat dan ketentuan penggunaan platform Testoplay yang mengatur hak dan kewajiban pengguna.') }}">
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

    .prose p {
      margin-bottom: 1rem;
      line-height: 1.75;
      color: #64748b;
    }

    .dark .prose p {
      color: #94a3b8;
    }

    .prose ul,
    .prose ol {
      padding-left: 1.5rem;
      margin-bottom: 1rem;
    }

    .prose ul {
      list-style: disc;
    }

    .prose ol {
      list-style: decimal;
    }

    .prose li {
      margin-bottom: 0.4rem;
      line-height: 1.75;
      color: #64748b;
    }

    .dark .prose li {
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
      border-top: 4px solid #7c3aed;
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
        <a href="{{ url('/') }}"
          class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 transition flex items-center gap-1.5">
          <i class="fa-solid fa-arrow-left text-xs"></i>
          <span class="hidden sm:inline">{{ __('Kembali') }}</span>
        </a>
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
          <i class="fa-solid fa-file-contract"></i> {{ __('Dokumen Hukum') }}
        </div>
        <h1 class="text-3xl sm:text-4xl font-black mb-2">{{ __('Syarat & Ketentuan') }}</h1>
        <p class="text-purple-100 text-sm">{{ __('Terakhir diperbarui: 1 Juni 2026') }}</p>
      </div>
    </div>
  </div>

  <!-- Content -->
  <main class="max-w-3xl mx-auto px-4 sm:px-6 py-10">
    <div class="page-card">
      <div class="prose">
        <p>
          {{ __('Selamat datang di Testoplay. Dengan mengakses atau menggunakan platform ini, Anda menyetujui syarat dan ketentuan yang tercantum di bawah ini. Harap baca dengan cermat sebelum menggunakan layanan kami.') }}
        </p>

        <h2>1. {{ __('Penerimaan Syarat') }}</h2>
        <p>
          {{ __('Dengan mendaftarkan akun atau menggunakan layanan Testoplay, Anda menyatakan bahwa Anda berusia minimal 17 tahun dan memiliki kapasitas hukum untuk menyetujui syarat ini. Jika Anda tidak setuju, jangan gunakan platform ini.') }}
        </p>

        <h2>2. {{ __('Deskripsi Layanan') }}</h2>
        <p>
          {{ __('Testoplay adalah platform yang menghubungkan developer aplikasi Android dengan tester untuk memenuhi persyaratan Google Play Closed Testing. Kami menyediakan:') }}
        </p>
        <ul>
          <li>{{ __('Sistem manajemen kampanye testing') }}</li>
          <li>{{ __('Pencocokan developer dengan tester yang relevan') }}</li>
          <li>{{ __('Sistem reward dan pembayaran') }}</li>
          <li>{{ __('Dukungan teknis dan panduan') }}</li>
        </ul>

        <h2>3. {{ __('Akun Pengguna') }}</h2>
        <p>{{ __('Anda bertanggung jawab untuk:') }}</p>
        <ul>
          <li>{{ __('Menjaga kerahasiaan kredensial akun Anda') }}</li>
          <li>{{ __('Semua aktivitas yang terjadi di bawah akun Anda') }}</li>
          <li>{{ __('Memberikan informasi yang akurat dan terkini') }}</li>
          <li>{{ __('Segera melaporkan penggunaan tidak sah kepada kami') }}</li>
        </ul>

        <h2>4. {{ __('Kewajiban Developer') }}</h2>
        <ul>
          <li>{{ __('Hanya mengiklankan aplikasi yang Anda miliki atau memiliki izin untuk mengiklankan') }}</li>
          <li>{{ __('Membayar biaya layanan sesuai paket yang dipilih') }}</li>
          <li>{{ __('Tidak menggunakan platform untuk tujuan penipuan') }}</li>
          <li>{{ __('Mematuhi Kebijakan Program Developer Google Play') }}</li>
        </ul>

        <h2>5. {{ __('Kewajiban Tester') }}</h2>
        <ul>
          <li>{{ __('Mengikuti misi dengan jujur dan sungguh-sungguh') }}</li>
          <li>{{ __('Tidak menggunakan akun Google palsu atau akun bot') }}</li>
          <li>{{ __('Memberikan ulasan yang autentik dan tidak memihak') }}</li>
          <li>{{ __('Tidak membagikan akses aplikasi kepada pihak ketiga') }}</li>
        </ul>

        <h2>6. {{ __('Pembayaran & Reward') }}</h2>
        <p>
          {{ __('Pembayaran diproses melalui gateway pembayaran pihak ketiga. Reward tester akan dicairkan sesuai ketentuan yang berlaku. Testoplay tidak bertanggung jawab atas penundaan yang disebabkan oleh pihak penyedia pembayaran.') }}
        </p>

        <h2>7. {{ __('Penghentian Akun') }}</h2>
        <p>
          {{ __('Kami berhak menangguhkan atau menghentikan akun Anda tanpa pemberitahuan jika Anda melanggar syarat ini, melakukan penipuan, atau merugikan pengguna lain.') }}
        </p>

        <h2>8. {{ __('Batasan Tanggung Jawab') }}</h2>
        <p>
          {{ __('Testoplay tidak bertanggung jawab atas kerusakan tidak langsung, insidental, atau kehilangan keuntungan yang timbul dari penggunaan platform. Tanggung jawab kami dibatasi pada jumlah yang Anda bayarkan dalam 12 bulan terakhir.') }}
        </p>

        <h2>9. {{ __('Hukum yang Berlaku') }}</h2>
        <p>
          {{ __('Syarat ini diatur oleh hukum Republik Indonesia. Segala sengketa akan diselesaikan melalui arbitrase atau pengadilan yang berwenang di Indonesia.') }}
        </p>

        <h2>10. {{ __('Kontak') }}</h2>
        <p>{{ __('Pertanyaan terkait syarat dan ketentuan dapat dikirimkan ke:') }} <a
            href="mailto:legal@testoplay.com">legal@testoplay.com</a></p>
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
