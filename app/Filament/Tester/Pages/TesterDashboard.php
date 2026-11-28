<?php  
  
namespace App\Filament\Tester\Pages;  
  
use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\MisiSub;
use App\Models\UserBalance;
use Filament\Notifications\Notification;
use Filament\Pages\Page;  
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TesterDashboard extends Page  
{  
    protected static string | \BackedEnum | null $navigationIcon  = 'heroicon-o-home';  
    protected static ?string $navigationLabel = 'Home';  
    protected static ?string $title           = 'Tester Dashboard';  
    protected static string | \UnitEnum | null $navigationGroup = 'Menu';
    protected static ?int    $navigationSort  = 1;  
    protected string  $view            = 'filament.tester.pages.tester-dashboard';  
  
    public function applyMisi($misiId)
    {
        $misi = Misi::with('paket')->find($misiId);
        if (!$misi) return;

        // Cek apakah sudah bergabung
        if (MisiAnggota::where('id_user', Auth::id())->where('id_misi', $misiId)->exists()) {
            Notification::make()
                ->title('Peringatan')
                ->warning()
                ->body('Anda sudah bergabung dengan misi ini.')
                ->send();
            return;
        }

        // Tentukan status pendaftaran:
        // - trusted_badge = false → siapapun bisa apply dan langsung accepted
        // - trusted_badge = true  → hanya tester badge > 5 yang bisa apply (dicegah di UI), status pending
        if ($misi->paket && $misi->paket->trusted_badge) {
            $status = 'pending'; // Menunggu acc manual developer
        } else {
            $status = 'accepted'; // Langsung diterima untuk misi biasa
        }

        MisiAnggota::create([
            'id_misi' => $misiId,
            'id_user' => Auth::id(),
            'status'  => $status,
        ]);

        // Increment kapasitas (jumlah tester saat ini)
        $misi->increment('kapasitas');

        // Jika kapasitas mencapai batas maksimal, tutup misi
        $maxCapacity = config('missions.max_capacity', 20);
        if ($misi->kapasitas >= $maxCapacity) {
            $misi->update(['status' => 'closed']);
        }

        if ($misi->paket && $misi->paket->trusted_badge) {
            Notification::make()
                ->title('Pendaftaran Berhasil Dikirim! ⏳')
                ->success()
                ->body('Pendaftaran Anda sedang menunggu persetujuan dari developer. Anda akan diberitahu saat diterima.')
                ->send();
        } else {
            Notification::make()
                ->title('Berhasil Bergabung! 🎉')
                ->success()
                ->body('Anda telah langsung diterima di misi ini. Silakan tunggu developer memulai misi.')
                ->send();
        }
    }
  
    public function getViewData(): array  
    {  
        $user = Auth::user();
        
        // Catatan: Pada sistem pengujian tatap muka, kehadiran diverifikasi oleh developer
        // saat pelaksanaan langsung di lokasi fisik.

        $balance = UserBalance::where('id_user', $user->id)->first();
        
        // ── 1. Statistik Dasar & Saldo Komisi Tunai ─────────────
        $totalSaldo = (int) ($balance->saldo_rupiah ?? 0);
        // Jika saldo rupiah masih 0 tapi user memiliki saldo dari point akun demo/sebelumnya, sinkronkan
        if ($totalSaldo <= 0 && ($balance->point ?? 0) > 0) {
            $totalSaldo = (int) $balance->point;
            $balance->update(['saldo_rupiah' => $totalSaldo]);
        }

        $misiSelesai = MisiAnggota::where('id_user', $user->id)->where('status', 'selesai')->count();
        $misiAktif   = MisiAnggota::where('id_user', $user->id)->whereIn('status', ['accepted', 'progress'])->count();
        $totalMisi   = MisiAnggota::where('id_user', $user->id)->count();
        
        // Komisi Pending: Total rupiah dari misi yang sedang dikerjakan atau menunggu verifikasi
        $komisiPending = MisiAnggota::where('id_user', $user->id)
            ->whereIn('status', ['accepted', 'progress', 'submitted', 'menunggu_seleksi'])
            ->with('misi')
            ->get()
            ->sum(function($ma) {
                $komisi = $ma->misi->komisi_per_tester ?? 0;
                return $komisi > 0 ? $komisi : ($ma->misi->point > 1000 ? $ma->misi->point : 20000);
            });

        // ── 2. Misi Aktif Saya (Jadwal & Lokasi yang Ditentukan Dev) ──
        $misiAktifList = MisiAnggota::where('id_user', $user->id)
            ->whereIn('status', ['accepted', 'progress', 'menunggu_seleksi'])
            ->with('misi')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($ma) {
                $m = $ma->misi;
                if (!$m) return null;

                // Warna & Gradasi berdasarkan ID agar variatif tapi tetap konsisten
                $gradients = [
                    ['icon' => '#ffd900', 'bar' => '#ffd900'],
                    ['icon' => '#8b5cf6', 'bar' => '#8b5cf6'],
                    ['icon' => '#10b981', 'bar' => '#10b981'],
                ];
                $gId = $m->id % count($gradients);

                $komisi = $m->komisi_per_tester > 0 ? $m->komisi_per_tester : ($m->point > 1000 ? $m->point : 20000);

                $statusLabel = 'Diterima';
                if ($ma->status === 'menunggu_seleksi') {
                    $statusLabel = 'Menunggu Seleksi';
                } elseif ($ma->status === 'accepted') {
                    $statusLabel = 'Diterima — Wajib Hadir';
                } elseif ($ma->status === 'selesai') {
                    $statusLabel = 'Selesai';
                }

                return [
                    'id'            => $m->id,
                    'logo'          => $m->logo,
                    'inisial'       => strtoupper(substr($m->nama_aplikasi, 0, 2)),
                    'gradient'      => $gradients[$gId]['icon'],
                    'nama'          => $m->nama_aplikasi,
                    'penyelenggara' => $m->penyelenggara ?: '-',
                    'tipe'          => $m->id % 2 === 0 ? 'Functional Testing' : 'UX Research',
                    'jadwalTanggal' => $m->jadwal_tanggal ? $m->jadwal_tanggal->translatedFormat('d M Y') : '-',
                    'jadwalWaktu'   => $m->jadwal_waktu ?: '-',
                    'lokasi'        => $m->lokasi ?: '-',
                    'reward'        => $komisi,
                    'komisi'        => $komisi,
                    'status'        => $statusLabel,
                    'rawStatus'     => $ma->status,
                    'aksi'          => 'detail',
                ];
            })->filter()->values()->toArray();

        // ── 3. Aplikasi Tersedia (Jadwal & Kuota yang Ditentukan Dev) ──
        $joinedMisiIds = MisiAnggota::where('id_user', $user->id)->pluck('id_misi');
        $userBadgeCount = $balance->badge ?? 0;
        
        $aplikasiList = Misi::where('status', 'open')
            ->whereNotIn('id', $joinedMisiIds)
            ->withCount('misiAnggotas')
            ->with(['paket'])
            ->latest()
            ->take(25)
            ->get()
            ->map(function ($m) use ($userBadgeCount) {
                // Mapping kategori visual
                $categories = [
                    ['bg' => '#fefce8', 'color' => '#ffd900', 'label' => 'Functional Testing'],
                    ['bg' => '#f5f3ff', 'color' => '#7c3aed', 'label' => 'UX Research'],
                    ['bg' => '#ecfdf5', 'color' => '#059669', 'label' => 'Bug Reporting'],
                ];
                $cat = $categories[$m->id % count($categories)];

                $gradients = [
                    '#ffd900',
                    '#8b5cf6',
                    '#10b981',
                    '#ef4444',
                ];

                $komisi = $m->komisi_per_tester > 0 ? $m->komisi_per_tester : ($m->point > 1000 ? $m->point : 20000);
                $kuota = $m->kuota_tester > 0 ? $m->kuota_tester : ($m->kapasitas ?: 5);
                $isRestricted = ($m->paket->trusted_badge ?? false) && ($userBadgeCount <= 5);
                $sisaSlot = max(0, $kuota - ($m->misi_anggotas_count ?? 0));
                $jadwalRaw = $m->jadwal_tanggal ? $m->jadwal_tanggal->format('Y-m-d') : ($m->created_at ? $m->created_at->format('Y-m-d') : '');

                return [
                    'id'               => $m->id,
                    'logo'             => $m->logo,
                    'inisial'          => strtoupper(substr($m->nama_aplikasi, 0, 2)),
                    'gradient'         => $gradients[$m->id % count($gradients)],
                    'nama'             => $m->nama_aplikasi,
                    'penyelenggara'    => $m->penyelenggara ?: '-',
                    'tipe'             => $cat['label'],
                    'tipeBg'           => $cat['bg'],
                    'tipeColor'        => $cat['color'],
                    'deskripsi'        => $m->instruksi ? substr(strip_tags($m->instruksi), 0, 60) . '...' : 'Uji aplikasi ' . $m->nama_aplikasi . ' dan berikan feedback terbaik.',
                    'durasi'           => '14 hari',
                    'testerCur'        => $m->kapasitas,
                    'testerMax'        => config('missions.max_capacity', 20),
                    'sisaSlot'         => $sisaSlot,
                    'jadwalTanggalRaw' => $jadwalRaw,
                    'reward'           => $komisi,
                    'komisi'           => $komisi,
                    'isTrusted'        => $m->paket->trusted_badge ?? false,
                    'isRestricted'     => $isRestricted,
                ];
            })->toArray();

        $lokasiList = collect($aplikasiList)
            ->pluck('lokasi')
            ->filter(fn($l) => !empty($l) && $l !== '-')
            ->unique()
            ->values()
            ->toArray();

        return [
            // ── Profil Tester ──────────────────────────────────  
            'namaTester'     => $user->name,  
            'inisialTester'  => strtoupper(substr($user->name, 0, 2)),  
            'tierTester'     => $balance->badge ?? 'Novice Tester',  
            'userBadgeCount' => $userBadgeCount,  
  
            // ── Komisi & Statistik ─────────────────────────────  
            'totalSaldo'     => $totalSaldo,
            'totalPoin'      => $totalSaldo,  
            'komisiPending'  => $komisiPending,
            'poinPending'    => $komisiPending,  
            'misiSelesai'    => $misiSelesai,  
            'rating'         => '4.8', // Static placeholder for now
            'misiAktif'      => $misiAktif,  
            'totalMisi'      => $totalMisi,
            'streakHari'     => $totalMisi,
  
            'misiAktifList'  => $misiAktifList,  
            'aplikasiList'   => $aplikasiList,  
            'lokasiList'     => $lokasiList,
        ];  
    }

    /**
     * Mengecek apakah tester melewatkan submit misi kemarin.
     * Jika tidak ada submission (notdone), status di misi_anggota diubah jadi failed.
     */
    protected function checkMissedSubmissions($userId)
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $today     = Carbon::today()->toDateString();

        // Ambil misi yang sedang diikuti user (status accepted)
        $activeMissions = MisiAnggota::where('id_user', $userId)
            ->where('status', 'accepted')
            ->with('misi')
            ->get();

        foreach ($activeMissions as $ma) {
            $misi = $ma->misi;
            if (!$misi) continue;

            // Hanya cek jika user sudah join sebelum hari ini
            $joinDate = $ma->created_at->toDateString();
            if ($joinDate >= $today) {
                continue;
            }

            // Ambil hari_ke hari ini dari jadwal misi_sub
            $currentSub = MisiSub::where('id_user', $userId)
                ->where('id_misi', $ma->id_misi)
                ->whereDate('created_at', $today)
                ->first();

            if (!$currentSub) {
                continue;
            }

            $hariToday = $currentSub->hari_ke;
            $hariYesterday = $hariToday - 1;

            // Jika hari ini adalah Hari ke-2 atau lebih, cek hari sebelumnya
            if ($hariYesterday >= 1 && $hariYesterday <= 14) {
                // Cek apakah ada submission untuk hari tersebut (hari kemarin)
                $sub = MisiSub::where('id_user', $userId)
                    ->where('id_misi', $ma->id_misi)
                    ->where('hari_ke', $hariYesterday)
                    ->first();

                // Jika tidak ada atau statusnya masih 'notdone', maka status user di misi tersebut diubah jadi failed
                if (!$sub || $sub->status === 'notdone') {
                    $ma->update(['status' => 'failed']);
                    
                    // Kurangi kapasitas misi karena 1 tester gagal/keluar
                    $misi->decrement('kapasitas');
                    
                    // Jika misi sebelumnya closed karena penuh, buka kembali
                    if ($misi->status === 'closed') {
                        $misi->update(['status' => 'open']);
                    }
                }
            }
        }
    }
}