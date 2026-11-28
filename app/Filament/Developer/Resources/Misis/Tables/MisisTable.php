<?php

namespace App\Filament\Developer\Resources\Misis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('logo_view')
                    ->label('Logo')
                    ->html()
                    ->getStateUsing(function ($record) {
                        if ($record->logo) {
                            return '<img src="/storage/' . $record->logo . '" alt="Logo" class="w-9 h-9 rounded-xl object-cover" style="width:36px;height:36px;border-radius:10px;object-fit:cover;">';
                        }

                        $inisial = strtoupper(substr($record->nama_aplikasi, 0, 2));
                        return '<div style="width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;background:#1a1a18;color:#ffd900;border:1px solid #333330;">' . $inisial . '</div>';
                    }),

                TextColumn::make('nama_aplikasi')
                    ->label(__('Nama Pengujian'))
                    ->description(fn($record) => $record->penyelenggara ? __('Oleh: ') . $record->penyelenggara : null)
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                TextColumn::make('lokasi')
                    ->label(__('Lokasi Fisik'))
                    ->limit(35)
                    ->tooltip(fn($record) => $record->lokasi)
                    ->searchable()
                    ->icon('heroicon-o-map-pin'),

                TextColumn::make('jadwal_tanggal')
                    ->label(__('Jadwal'))
                    ->formatStateUsing(function ($record) {
                        $tgl = $record->jadwal_tanggal ? $record->jadwal_tanggal->format('d M Y') : '-';
                        $waktu = $record->jadwal_waktu ? ' (' . $record->jadwal_waktu . ')' : '';
                        return $tgl . $waktu;
                    })
                    ->icon('heroicon-o-calendar')
                    ->sortable(),

                TextColumn::make('kuota_tester')
                    ->label(__('Tester'))
                    ->formatStateUsing(fn($record) => ($record->kapasitas ?? 0) . ' / ' . ($record->kuota_tester ?? 0) . ' orang')
                    ->badge()
                    ->color(fn($record) => ($record->kapasitas >= $record->kuota_tester) ? 'danger' : 'success')
                    ->sortable(),

                TextColumn::make('komisi_per_tester')
                    ->label(__('Komisi / Org'))
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state ?? 20000, 0, ',', '.'))
                    ->weight('bold')
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'open' => __('Membuka Pendaftaran'),
                        'running' => __('Sedang Berjalan'),
                        'completed' => __('Selesai'),
                        'closed' => __('Kuota Penuh'),
                        default => ucfirst($state),
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'open' => 'success',
                        'running' => 'info',
                        'completed' => 'primary',
                        'closed' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->filters([])
            ->recordActions([
                \Filament\Actions\Action::make('kelola_tester')
                    ->label(__('Seleksi & Kelola Tester'))
                    ->icon('heroicon-o-user-group')
                    ->color('primary')
                    ->tooltip(__('Periksa antrean pelamar, terima/tolak, dan konfirmasi kehadiran'))
                    ->url(fn(\App\Models\Misi $record): string => \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('kelola-tester', ['record' => $record])),

                EditAction::make()
                    ->iconButton()
                    ->tooltip('Edit'),
            ])
            ->actionsColumnLabel(__('Aksi'))
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
