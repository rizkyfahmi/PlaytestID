<?php

namespace App\Filament\Developer\Resources\Misis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class MisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make(__('1. Identitas & Lokasi Pengujian Tatap Muka'))
                    ->description(__('Cantumkan informasi identitas proyek dan alamat fisik tempat tester akan hadir.'))
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                TextInput::make('nama_aplikasi')
                                    ->label(__('Nama Aplikasi / Proyek'))
                                    ->placeholder(__('Contoh: Aplikasi POS Kasir Pintar'))
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('penyelenggara')
                                    ->label(__('Nama Penyelenggara / Perusahaan'))
                                    ->placeholder(__('Contoh: PT Digital Inovasi Nusantara'))
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        FileUpload::make('logo')
                            ->label(__('Logo / Banner Aplikasi'))
                            ->disk('public')
                            ->directory('logos')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('lokasi')
                            ->label(__('Lokasi Testing Fisik (Alamat Lengkap)'))
                            ->placeholder(__('Contoh: Ruang Meeting A, Gedung Creative Hub Lt. 3, Jl. Gatot Subroto No. 45, Jakarta Selatan'))
                            ->required()
                            ->rows(3)
                            ->helperText(__('Cantumkan patokan atau ruangan secara jelas agar tester dapat datang ke lokasi tanpa kendala.'))
                            ->columnSpanFull(),

                        Grid::make(['default' => 1, 'md' => 2])
                            ->schema([
                                DatePicker::make('jadwal_tanggal')
                                    ->label(__('Tanggal Pelaksanaan'))
                                    ->required()
                                    ->native(false)
                                    ->minDate(now()->startOfDay()),

                                TextInput::make('jadwal_waktu')
                                    ->label(__('Waktu / Jam Pelaksanaan'))
                                    ->placeholder(__('Contoh: 10:00 - 13:00 WIB'))
                                    ->required()
                                    ->maxLength(100),
                            ]),
                    ]),

                Section::make(__('2. Kebutuhan Tester & Rincian Biaya Komisi'))
                    ->description(__('Tentukan jumlah tester dan nominal komisi per orang (Minimum Rp 20.000).'))
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 3])
                            ->schema([
                                TextInput::make('kuota_tester')
                                    ->label(__('Jumlah Tester (Kuota)'))
                                    ->numeric()
                                    ->default(5)
                                    ->minValue(1)
                                    ->required()
                                    ->live(onBlur: true)
                                    ->helperText(__('Jumlah tester fisik yang dibutuhkan di lokasi.'))
                                    ->afterStateUpdated(function (Set $set, Get $get, $state) {
                                        $kuota = max(1, (int) ($state ?: 1));
                                        $komisi = max(20000, (int) ($get('komisi_per_tester') ?: 20000));
                                        $admin = (int) ($get('biaya_admin') ?: 0);
                                        $set('total_biaya', ($kuota * $komisi) + $admin);
                                    }),

                                TextInput::make('komisi_per_tester')
                                    ->label(__('Komisi per Tester'))
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(20000)
                                    ->minValue(20000)
                                    ->required()
                                    ->live(onBlur: true)
                                    ->helperText(__('Batas minimum komisi: Rp 20.000 per orang.'))
                                    ->afterStateUpdated(function (Set $set, Get $get, $state) {
                                        $kuota = max(1, (int) ($get('kuota_tester') ?: 1));
                                        $komisi = max(20000, (int) ($state ?: 20000));
                                        $admin = (int) ($get('biaya_admin') ?: 0);
                                        $set('total_biaya', ($kuota * $komisi) + $admin);
                                    }),

                                TextInput::make('biaya_admin')
                                    ->label(__('Biaya Layanan Admin'))
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated()
                                    ->helperText(__('Bebas biaya admin (Rp 0).')),
                            ]),

                        TextInput::make('total_biaya')
                            ->label(__('Total Biaya yang Harus Disiapkan'))
                            ->numeric()
                            ->prefix('Rp')
                            ->default(100000)
                            ->readOnly()
                            ->dehydrated()
                            ->helperText(__('Rincian: (Jumlah Tester × Komisi per Orang) + Biaya Layanan Admin'))
                            ->columnSpanFull(),
                    ]),

                Section::make(__('3. Deskripsi & Persyaratan Pengujian'))
                    ->description(__('Jelaskan aktivitas yang akan dilakukan tester dan persyaratan yang wajib dipatuhi.'))
                    ->columnSpanFull()
                    ->schema([
                        RichEditor::make('instruksi')
                            ->label(__('Deskripsi & Instruksi Kegiatan Testing'))
                            ->placeholder(__('Tuliskan gambaran proses testing, apa saja fitur yang akan diuji secara langsung, dan skenario pengujian di lokasi...'))
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('persyaratan')
                            ->label(__('Persyaratan Khusus Tester (Wajib Disetujui Sebelum Apply)'))
                            ->placeholder(__('Contoh:' . "\n" . '1. Wajib hadir 15 menit sebelum sesi dimulai.' . "\n" . '2. Membawa HP Android dengan RAM minimal 4GB.' . "\n" . '3. Bersedia mengikuti pengujian selama 2 jam penuh.' . "\n" . '4. Berpakaian sopan dan rapi.'))
                            ->required()
                            ->rows(5)
                            ->helperText(__('Tester wajib membaca dan mencentang persetujuan atas syarat ini sebelum tombol Apply dapat ditekan.'))
                            ->columnSpanFull(),
                    ]),

                Hidden::make('link_aplikasi')->default('-'),
                Hidden::make('kapasitas')->default(0),
                Hidden::make('point')->default(0),
                Hidden::make('status')->default('open'),
            ]);
    }
}
