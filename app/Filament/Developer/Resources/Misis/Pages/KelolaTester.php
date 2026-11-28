<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use App\Models\Misi;
use App\Models\MisiAnggota;
use App\Models\PelanggaranTester;
use App\Models\UserBalance;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class KelolaTester extends Page
{
    protected static string $resource = MisiResource::class;

    protected string $view = 'filament.developer.resources.misis.pages.kelola-tester';

    public Misi $record;

    public string $activeTab = 'semua';
    public string $search = '';

    public ?int $selectedTesterId = null;
    public string $alasanPelanggaran = '';

    public function mount(Misi $record): void
    {
        $this->record = $record;
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return new \Illuminate\Support\HtmlString('
            <div class="flex items-center gap-3">
                <a href="' . MisiResource::getUrl('index') . '" class="text-sm font-semibold text-neutral-400 hover:text-white flex items-center gap-1.5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    ' . __('Kembali ke Daftar Misi') . '
                </a>
            </div>
        ');
    }

    public function getViewData(): array
    {
        $query = MisiAnggota::where('id_misi', $this->record->id)
            ->with(['user', 'user.userBalance'])
            ->orderBy('created_at', 'desc');

        if ($this->search) {
            $s = '%' . $this->search . '%';
            $query->whereHas('user', function ($q) use ($s) {
                $q->where('name', 'like', $s)
                  ->orWhere('email', 'like', $s)
                  ->orWhere('phone_number', 'like', $s);
            });
        }

        if ($this->activeTab === 'menunggu') {
            $query->whereIn('status', ['pending', 'reviewing', 'menunggu_seleksi']);
        } elseif ($this->activeTab === 'diterima') {
            $query->whereIn('status', ['accepted', 'progress']);
        } elseif ($this->activeTab === 'selesai') {
            $query->where('status', 'selesai');
        } elseif ($this->activeTab === 'ditolak') {
            $query->whereIn('status', ['rejected', 'cancelled']);
        }

        $allMembers = MisiAnggota::where('id_misi', $this->record->id)->get();

        $statTotal = $allMembers->count();
        $statMenunggu = $allMembers->whereIn('status', ['pending', 'reviewing', 'menunggu_seleksi'])->count();
        $statDiterima = $allMembers->whereIn('status', ['accepted', 'progress'])->count();
        $statSelesai = $allMembers->where('status', 'selesai')->count();
        $statDitolak = $allMembers->whereIn('status', ['rejected', 'cancelled'])->count();

        $testers = $query->get()->map(function ($tester) {
            $user = $tester->user;
            $nama = $user->name ?? 'Tester';
            $inisial = strtoupper(substr($nama, 0, 2));

            $payoutMethod = $tester->payout_method ?? $user->payout_method ?? '-';
            $accountName = $tester->payout_account_name ?? $user->payout_account_name ?? '-';
            $accountNumber = $tester->payout_account_number ?? $user->payout_account_number ?? '-';
            $bankName = $tester->payout_bank_name ?? $user->payout_bank_name ?? '';
            $phone = $tester->phone_number ?? $user->phone_number ?? '-';

            return [
                'id' => $tester->id,
                'user_id' => $user->id ?? 0,
                'nama' => $nama,
                'email' => $user->email ?? '-',
                'phone' => $phone,
                'inisial' => $inisial,
                'payout_method' => strtoupper($payoutMethod),
                'payout_bank_name' => $bankName,
                'payout_account_name' => $accountName,
                'payout_account_number' => $accountNumber,
                'status' => $tester->status,
                'status_kehadiran' => $tester->status_kehadiran ?? 'belum_hadir',
                'status_komisi' => $tester->status_komisi ?? 'belum_dibayar',
                'tanggal_apply' => $tester->created_at->format('d M Y H:i'),
            ];
        });

        return [
            'testers' => $testers,
            'statTotal' => $statTotal,
            'statMenunggu' => $statMenunggu,
            'statDiterima' => $statDiterima,
            'statSelesai' => $statSelesai,
            'statDitolak' => $statDitolak,
            'kuota' => $this->record->kuota_tester ?? 0,
            'sisaKuota' => max(0, ($this->record->kuota_tester ?? 0) - ($statDiterima + $statSelesai)),
        ];
    }

    public function terimaTester($id): void
    {
        $tester = MisiAnggota::find($id);
        if (!$tester || !in_array($tester->status, ['pending', 'reviewing', 'menunggu_seleksi'])) {
            return;
        }

        $acceptedCount = MisiAnggota::where('id_misi', $this->record->id)
            ->whereIn('status', ['accepted', 'progress', 'selesai'])
            ->count();

        if ($acceptedCount >= ($this->record->kuota_tester ?? 1)) {
            Notification::make()
                ->title(__('Kuota Tester Sudah Terpenuhi'))
                ->body(__('Pengujian ini sudah mencapai batas kuota tester (:kuota orang).', ['kuota' => $this->record->kuota_tester]))
                ->warning()
                ->send();
            return;
        }

        $tester->update(['status' => 'accepted']);

        // Update kapasitas misi
        $newAccepted = $acceptedCount + 1;
        $this->record->update([
            'kapasitas' => $newAccepted,
            'status' => ($newAccepted >= $this->record->kuota_tester) ? 'closed' : 'open',
        ]);

        Notification::make()
            ->title(__('Tester Berhasil Diterima! ✅'))
            ->body(__('Tester telah diterima untuk mengikuti pengujian langsung.'))
            ->success()
            ->send();
    }

    public function tolakTester($id): void
    {
        $tester = MisiAnggota::find($id);
        if (!$tester) return;

        $tester->update(['status' => 'rejected']);

        $acceptedCount = MisiAnggota::where('id_misi', $this->record->id)
            ->whereIn('status', ['accepted', 'progress', 'selesai'])
            ->count();

        $this->record->update([
            'kapasitas' => $acceptedCount,
            'status' => ($acceptedCount < $this->record->kuota_tester) ? 'open' : 'closed',
        ]);

        Notification::make()
            ->title(__('Pengajuan Tester Ditolak'))
            ->success()
            ->send();
    }

    public function konfirmasiHadirDanSelesai($id): void
    {
        $tester = MisiAnggota::find($id);
        if (!$tester || !in_array($tester->status, ['accepted', 'progress'])) {
            return;
        }

        $komisi = $this->record->komisi_per_tester ?? 20000;

        $tester->update([
            'status' => 'selesai',
            'status_kehadiran' => 'hadir',
            'status_komisi' => 'masuk_dompet',
        ]);

        // Kreditkan komisi IDR ke dompet tester
        $balance = UserBalance::firstOrCreate(
            ['id_user' => $tester->id_user],
            ['point' => 0, 'badge' => 0, 'saldo_rupiah' => 0]
        );
        $balance->increment('saldo_rupiah', $komisi);

        Notification::make()
            ->title(__('Kehadiran Dikonfirmasi & Selesai! 🎉'))
            ->body(__('Tester telah diverifikasi hadir. Komisi sebesar Rp :nominal telah masuk ke Saldo Dompet Tester.', [
                'nominal' => number_format($komisi, 0, ',', '.')
            ]))
            ->success()
            ->send();
    }

    public function openReportModal($id): void
    {
        $this->selectedTesterId = $id;
        $this->alasanPelanggaran = '';
        $this->dispatch('open-report-modal');
    }

    public function submitReport(): void
    {
        if (!$this->selectedTesterId || empty(trim($this->alasanPelanggaran))) {
            Notification::make()->title(__('Mohon isi alasan ketidakhadiran'))->warning()->send();
            return;
        }

        $tester = MisiAnggota::find($this->selectedTesterId);
        if (!$tester) return;

        $tester->update([
            'status_kehadiran' => 'tidak_hadir',
        ]);

        PelanggaranTester::create([
            'id_user' => $tester->id_user,
            'id_developer' => auth()->id(),
            'id_misi' => $this->record->id,
            'alasan' => trim($this->alasanPelanggaran),
            'status' => 'pending',
        ]);

        $this->selectedTesterId = null;
        $this->alasanPelanggaran = '';
        $this->dispatch('close-report-modal');

        Notification::make()
            ->title(__('Laporan Ketidakhadiran Terkirim ⚠️'))
            ->body(__('Laporan telah dicatat dan diteruskan ke Admin untuk ditinjau secara berkala.'))
            ->warning()
            ->send();
    }
}
