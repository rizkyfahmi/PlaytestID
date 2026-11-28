<?php

namespace App\Filament\Tester\Widgets;

use App\Models\Misi;
use App\Filament\Tester\Pages\MisiDetail;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;

class AvailableMissions extends BaseWidget
{
    protected static ?string $heading = 'Pengujian Tatap Muka Tersedia';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Misi::query()
                    ->where('status', 'open')
                    ->whereDoesntHave('misiAnggotas', function ($query) {
                        $query->where('id_user', Auth::id());
                    })
                    ->latest()
            )
            ->columns([
                TextColumn::make('nama_aplikasi')
                    ->label('Nama Pengujian')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn(Misi $record): string => $record->penyelenggara ? 'Oleh: ' . $record->penyelenggara : ''),

                TextColumn::make('lokasi')
                    ->label('Lokasi Fisik')
                    ->limit(35)
                    ->icon('heroicon-o-map-pin'),

                TextColumn::make('jadwal_tanggal')
                    ->label('Jadwal')
                    ->formatStateUsing(function (Misi $record) {
                        $t = $record->jadwal_tanggal ? $record->jadwal_tanggal->format('d M Y') : '-';
                        return $t . ($record->jadwal_waktu ? ' (' . $record->jadwal_waktu . ')' : '');
                    })
                    ->icon('heroicon-o-calendar'),

                TextColumn::make('kuota_tester')
                    ->label('Kuota')
                    ->formatStateUsing(fn(Misi $record) => ($record->kapasitas ?? 0) . ' / ' . ($record->kuota_tester ?? 0) . ' org')
                    ->badge()
                    ->color('success'),

                TextColumn::make('komisi_per_tester')
                    ->label('Komisi Tunai')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state ?? 20000, 0, ',', '.'))
                    ->weight('black')
                    ->color('primary'),
            ])
            ->actions([
                Action::make('apply')
                    ->label('Lihat & Apply')
                    ->icon('heroicon-o-arrow-right')
                    ->color('primary')
                    ->button()
                    ->url(fn(Misi $record): string => MisiDetail::getUrl(['misi_id' => $record->id])),
            ])
            ->recordAction('apply')
            ->emptyStateHeading('Belum Ada Pengujian Baru')
            ->emptyStateDescription('Pengujian tatap muka yang dibuka oleh developer akan muncul di sini.');
    }
}
