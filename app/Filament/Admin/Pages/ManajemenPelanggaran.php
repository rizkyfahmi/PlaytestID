<?php

namespace App\Filament\Admin\Pages;

use App\Models\PelanggaranTester;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManajemenPelanggaran extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shield-exclamation';
    protected static ?int $navigationSort = 7;
    protected string $view = 'filament.admin.pages.manajemen-pelanggaran';

    public static function getNavigationLabel(): string
    {
        return __('Sanksi & Pelanggaran');
    }

    public function getTitle(): string
    {
        return __('Manajemen Sanksi & Ketidakhadiran Tester');
    }

    public string $activeFilter = 'pending';

    public function getViewData(): array
    {
        $query = PelanggaranTester::with(['tester', 'developer', 'misi'])->latest();

        if ($this->activeFilter !== 'semua') {
            $query->where('status', $this->activeFilter);
        }

        $all = PelanggaranTester::all();

        return [
            'pelanggaran' => $query->get(),
            'statPending' => $all->where('status', 'pending')->count(),
            'statDisetujui' => $all->where('status', 'disetujui')->count(),
            'statDitolak' => $all->where('status', 'ditolak')->count(),
        ];
    }

    public function blokirAkun($id): void
    {
        $p = PelanggaranTester::find($id);
        if (!$p) return;

        $p->update([
            'status' => 'disetujui',
            'tindakan_admin' => 'Akun tester diblokir karena ketidakhadiran tanpa alasan yang sah.',
        ]);

        if ($p->tester) {
            $p->tester->update([
                'is_banned' => true,
                'banned_reason' => 'Diblokir karena pelanggaran ketidakhadiran pada pengujian: ' . ($p->misi->nama_aplikasi ?? '-'),
            ]);
        }

        Notification::make()
            ->title(__('Sanksi Diterapkan: Akun Tester Diblokir'))
            ->success()
            ->send();
    }

    public function beriPeringatan($id): void
    {
        $p = PelanggaranTester::find($id);
        if (!$p) return;

        $p->update([
            'status' => 'disetujui',
            'tindakan_admin' => 'Peringatan resmi diberikan kepada tester (tanpa pemblokiran).',
        ]);

        Notification::make()
            ->title(__('Peringatan Resmi Dicatat'))
            ->warning()
            ->send();
    }

    public function tolakLaporan($id): void
    {
        $p = PelanggaranTester::find($id);
        if (!$p) return;

        $p->update([
            'status' => 'ditolak',
            'tindakan_admin' => 'Laporan ditolak oleh admin setelah pemeriksaan.',
        ]);

        Notification::make()
            ->title(__('Laporan Ditolak / Dibatalkan'))
            ->info()
            ->send();
    }

    public function bukaBlokir($userId): void
    {
        $user = User::find($userId);
        if ($user) {
            $user->update([
                'is_banned' => false,
                'banned_reason' => null,
            ]);

            Notification::make()
                ->title(__('Pemblokiran Akun Berhasil Dibuka'))
                ->success()
                ->send();
        }
    }
}
