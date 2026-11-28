<?php

namespace App\Filament\Tester\Widgets;

use App\Models\Misi;
use App\Filament\Tester\Pages\MisiDetail;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;

class ActiveMissions extends BaseWidget
{
    protected static ?string $heading = 'Pengujian yang Diikuti';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Misi::query()
                    ->whereHas('misiAnggotas', function ($query) {
                        $query->where('id_user', Auth::id());
                    })
                    ->latest()
            )
            ->columns([
                TextColumn::make('nama_aplikasi')
                    ->label('Nama Pengujian')
                    ->weight('bold')
                    ->description(fn(Misi $record): string => $record->lokasi ? 'Lokasi: ' . substr($record->lokasi, 0, 30) . '...' : ''),

                TextColumn::make('jadwal_tanggal')
                    ->label('Jadwal')
                    ->formatStateUsing(fn(Misi $record) => $record->jadwal_tanggal ? $record->jadwal_tanggal->format('d M Y') . ($record->jadwal_waktu ? ' (' . $record->jadwal_waktu . ')' : '') : '-')
                    ->icon('heroicon-o-calendar'),

                TextColumn::make('misiAnggotas')
                    ->label('Status Lamaran')
                    ->formatStateUsing(function (Misi $record) {
                        $anggota = $record->misiAnggotas()->where('id_user', Auth::id())->first();
                        $status = strtolower($anggota?->status ?? 'pending');
                        return match ($status) {
                            'pending', 'reviewing', 'menunggu_seleksi' => 'Menunggu Seleksi',
                            'accepted', 'progress' => 'Diterima (Wajib Hadir)',
                            'selesai' => 'Hadir & Selesai',
                            'rejected', 'cancelled' => 'Ditolak',
                            default => ucfirst($status),
                        };
                    })
                    ->badge()
                    ->color(function (Misi $record): string {
                        $anggota = $record->misiAnggotas()->where('id_user', Auth::id())->first();
                        $status = strtolower($anggota?->status ?? 'pending');
                        return match ($status) {
                            'pending', 'reviewing', 'menunggu_seleksi' => 'warning',
                            'accepted', 'progress' => 'info',
                            'selesai' => 'success',
                            'rejected', 'cancelled' => 'danger',
                            default => 'gray',
                        };
                    }),
            ])
            ->actions([
                Action::make('detail')
                    ->label('Lihat Detail & Lokasi')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->url(fn(Misi $record) => MisiDetail::getUrl(['misi_id' => $record->id])),
            ])
            ->recordAction('detail')
            ->emptyStateHeading('Belum Ada Pengujian Diikuti')
            ->emptyStateDescription('Daftar lamaran pengujian Anda akan muncul di sini.');
    }
}
