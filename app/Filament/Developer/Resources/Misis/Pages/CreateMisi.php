<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use App\Models\Pembayaran;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateMisi extends CreateRecord
{
    protected static string $resource = MisiResource::class;
    protected static ?string $activeNavigationItem = 'New Test Case';

    public function getTitle(): string
    {
        return __('Buat Pengujian Tatap Muka (Face to Face)');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_user'] = auth()->id();
        $data['kuota_tester'] = max(1, (int) ($data['kuota_tester'] ?? 1));
        $data['komisi_per_tester'] = max(20000, (int) ($data['komisi_per_tester'] ?? 20000));
        $data['biaya_admin'] = 0;
        $data['total_biaya'] = ($data['kuota_tester'] * $data['komisi_per_tester']) + $data['biaya_admin'];
        $data['kapasitas'] = 0;
        $data['status'] = 'open';
        $data['point'] = 0;
        $data['link_aplikasi'] = $data['link_aplikasi'] ?? '-';

        return $data;
    }

    protected function afterCreate(): void
    {
        $misi = $this->record;
        $user = auth()->user();

        Pembayaran::create([
            'id_misi' => $misi->id,
            'id_user' => $user->id,
            'status' => 'success', // Pembayaran langsung aktif (karena biaya admin Rp 0)
            'reference' => 'F2F-' . $misi->id . '-' . time(),
        ]);

        Notification::make()
            ->title(__('Pengujian Berhasil Diterbitkan! 🎉'))
            ->body(__('Testing tatap muka Anda telah berhasil dipublikasikan dan siap menerima pelamar tester.'))
            ->success()
            ->send();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
