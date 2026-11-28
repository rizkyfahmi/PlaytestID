<?php

namespace App\Filament\Tester\Pages;

use App\Models\Misi;
use App\Models\MisiAnggota;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class MisiDetail extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = null;

    protected string $view = 'filament.tester.pages.misi-detail';

    protected static ?string $title = 'Detail Pengujian Tatap Muka';

    protected static bool $shouldRegisterNavigation = false;

    public ?int $misi_id = null;

    // Apply Form Data
    public string $phone_number = '';
    public string $payout_method = 'bank';
    public string $payout_bank_name = 'BCA';
    public string $payout_account_name = '';
    public string $payout_account_number = '';
    public bool $agreed_terms = false;

    public function mount(): void
    {
        $this->misi_id = (int) request()->query('misi_id');

        $user = Auth::user();
        if ($user) {
            $this->phone_number          = $user->phone_number ?? '';
            $this->payout_method         = $user->payout_method ?? 'bank';
            $this->payout_bank_name      = $user->payout_bank_name ?? 'BCA';
            $this->payout_account_name   = $user->payout_account_name ?? ($user->name ?? '');
            $this->payout_account_number = $user->payout_account_number ?? '';
        }
    }

    public function getMisi(): ?Misi
    {
        if (!$this->misi_id) return null;
        return Misi::find($this->misi_id);
    }

    public function getAlreadyJoined(): bool
    {
        if (!$this->misi_id || !Auth::check()) return false;
        return MisiAnggota::where('id_user', Auth::id())
            ->where('id_misi', $this->misi_id)
            ->exists();
    }

    public function getMisiAnggota(): ?MisiAnggota
    {
        if (!$this->misi_id || !Auth::check()) return null;
        return MisiAnggota::where('id_user', Auth::id())
            ->where('id_misi', $this->misi_id)
            ->first();
    }

    public function applyMission(): void
    {
        $misi = $this->getMisi();
        if (!$misi) return;

        $user = Auth::user();
        if (!$user) return;

        // Validasi persetujuan persyaratan
        if (!$this->agreed_terms) {
            Notification::make()
                ->title(__('Persetujuan Wajib'))
                ->body(__('Anda wajib membaca dan mencentang persetujuan persyaratan sebelum mengajukan pendaftaran.'))
                ->danger()
                ->send();
            return;
        }

        // Validasi data diri & pembayaran
        if (empty(trim($this->phone_number))) {
            Notification::make()
                ->title(__('Nomor Telepon Wajib Diisi'))
                ->body(__('Silakan lengkapi nomor telepon / WhatsApp aktif Anda agar developer dapat menghubungi Anda.'))
                ->danger()
                ->send();
            return;
        }

        if (empty(trim($this->payout_account_name)) || empty(trim($this->payout_account_number))) {
            Notification::make()
                ->title(__('Informasi Pembayaran Belum Lengkap'))
                ->body(__('Silakan lengkapi nama pemilik dan nomor rekening/akun pembayaran untuk penerimaan komisi.'))
                ->danger()
                ->send();
            return;
        }

        if ($this->getAlreadyJoined()) {
            Notification::make()
                ->title(__('Peringatan'))
                ->body(__('Anda sudah mengirimkan lamaran pada pengujian ini.'))
                ->warning()
                ->send();
            return;
        }

        // Cek kuota tester
        $acceptedCount = MisiAnggota::where('id_misi', $misi->id)
            ->whereIn('status', ['accepted', 'progress', 'selesai'])
            ->count();

        if ($acceptedCount >= ($misi->kuota_tester ?? 1) || $misi->status === 'closed') {
            Notification::make()
                ->title(__('Kuota Penuh'))
                ->body(__('Kapasitas tester untuk pengujian ini sudah terpenuhi.'))
                ->danger()
                ->send();
            return;
        }

        // Simpan / update profil user jika ada data baru
        $user->update([
            'phone_number'          => trim($this->phone_number),
            'payout_method'         => $this->payout_method,
            'payout_bank_name'      => ($this->payout_method === 'bank') ? $this->payout_bank_name : null,
            'payout_account_name'   => trim($this->payout_account_name),
            'payout_account_number' => trim($this->payout_account_number),
        ]);

        // Buat pengajuan di MisiAnggota (status: menunggu_seleksi)
        MisiAnggota::create([
            'id_misi'               => $misi->id,
            'id_user'               => $user->id,
            'phone_number'          => trim($this->phone_number),
            'payout_method'         => $this->payout_method,
            'payout_bank_name'      => ($this->payout_method === 'bank') ? $this->payout_bank_name : null,
            'payout_account_name'   => trim($this->payout_account_name),
            'payout_account_number' => trim($this->payout_account_number),
            'status'                => 'menunggu_seleksi',
            'status_kehadiran'      => 'belum_hadir',
            'status_komisi'         => 'belum_dibayar',
            'agreed_terms_at'       => now(),
        ]);

        Notification::make()
            ->title(__('Lamaran Berhasil Dikirim! ⏳'))
            ->body(__('Pengajuan Anda telah masuk ke daftar antrean developer dan sedang menunggu proses seleksi.'))
            ->success()
            ->send();
    }

    public function getViewData(): array
    {
        $misi          = $this->getMisi();
        $alreadyJoined = $this->getAlreadyJoined();
        $misiAnggota   = $this->getMisiAnggota();

        $acceptedCount = $misi ? MisiAnggota::where('id_misi', $misi->id)
            ->whereIn('status', ['accepted', 'progress', 'selesai'])
            ->count() : 0;

        return [
            'misi'          => $misi,
            'alreadyJoined' => $alreadyJoined,
            'misiAnggota'   => $misiAnggota,
            'acceptedCount' => $acceptedCount,
            'sisaKuota'     => $misi ? max(0, ($misi->kuota_tester ?? 0) - $acceptedCount) : 0,
        ];
    }
}
