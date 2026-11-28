<?php

namespace App\Filament\Tester\Pages;

use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileTester extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';

    public static function getNavigationLabel(): string
    {
        return __('Profil Saya');
    }

    public function getTitle(): string
    {
        return __('Profil Tester & Informasi Pembayaran');
    }

    protected static ?int $navigationSort = 99;
    protected string $view = 'filament.tester.pages.profile-tester';

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $this->form->fill([
            'name'                  => $user->name,
            'email'                 => $user->email,
            'phone_number'          => $user->phone_number,
            'payout_method'         => $user->payout_method ?? 'bank',
            'payout_bank_name'      => $user->payout_bank_name ?? 'BCA',
            'payout_account_name'   => $user->payout_account_name ?? $user->name,
            'payout_account_number' => $user->payout_account_number,
        ]);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make(__('1. Data Diri Tester'))
                    ->description(__('Data ini digunakan oleh Developer saat pengujian langsung dan konfirmasi pendaftaran.'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Nama Lengkap'))
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->required()
                            ->disabled()
                            ->helperText(__('Email terdaftar di sistem.')),

                        TextInput::make('phone_number')
                            ->label(__('Nomor Telepon / WhatsApp Aktif'))
                            ->placeholder('081234567890')
                            ->tel()
                            ->required()
                            ->maxLength(20)
                            ->helperText(__('Wajib nomor aktif agar developer dapat menghubungi terkait jadwal & lokasi pengujian.'))
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make(__('2. Rekening & Akun Pembayaran Komisi'))
                    ->description(__('Rekening atau dompet digital ini akan digunakan untuk menerima pembayaran komisi setelah testing selesai.'))
                    ->schema([
                        Select::make('payout_method')
                            ->label(__('Metode Pembayaran'))
                            ->options([
                                'bank'      => 'Transfer Bank',
                                'dana'      => 'DANA',
                                'gopay'     => 'GoPay',
                                'ovo'       => 'OVO',
                                'shopeepay' => 'ShopeePay',
                            ])
                            ->required()
                            ->live()
                            ->native(false)
                            ->columnSpanFull(),

                        Select::make('payout_bank_name')
                            ->label(__('Nama Bank'))
                            ->options([
                                'BCA'        => 'Bank Central Asia (BCA)',
                                'Mandiri'    => 'Bank Mandiri',
                                'BNI'        => 'Bank Negara Indonesia (BNI)',
                                'BRI'        => 'Bank Rakyat Indonesia (BRI)',
                                'CIMB Niaga' => 'CIMB Niaga',
                                'Permata'    => 'Bank Permata',
                                'BSI'        => 'Bank Syariah Indonesia (BSI)',
                                'Bank Jago'  => 'Bank Jago',
                                'SeaBank'    => 'SeaBank',
                            ])
                            ->visible(fn(Get $get) => $get('payout_method') === 'bank')
                            ->required(fn(Get $get) => $get('payout_method') === 'bank')
                            ->native(false),

                        TextInput::make('payout_account_name')
                            ->label(fn(Get $get) => $get('payout_method') === 'bank' ? __('Nama Pemilik Rekening') : __('Nama Pemilik Akun'))
                            ->placeholder(__('Contoh: Budi Santoso'))
                            ->required()
                            ->maxLength(255),

                        TextInput::make('payout_account_number')
                            ->label(fn(Get $get) => $get('payout_method') === 'bank' ? __('Nomor Rekening') : __('Nomor HP Akun E-Wallet'))
                            ->placeholder(fn(Get $get) => $get('payout_method') === 'bank' ? 'Contoh: 1234567890' : 'Contoh: 081234567890')
                            ->required()
                            ->maxLength(50)
                            ->columnSpan(fn(Get $get) => $get('payout_method') === 'bank' ? 1 : 2),
                    ])->columns(2),

                Section::make(__('3. Ubah Kata Sandi'))
                    ->description(__('Kosongkan jika tidak ingin mengubah kata sandi.'))
                    ->schema([
                        TextInput::make('current_password')
                            ->label(__('Kata Sandi Saat Ini'))
                            ->password()
                            ->revealable(),
                        TextInput::make('new_password')
                            ->label(__('Kata Sandi Baru'))
                            ->password()
                            ->revealable()
                            ->minLength(8),
                        TextInput::make('new_password_confirmation')
                            ->label(__('Konfirmasi Kata Sandi Baru'))
                            ->password()
                            ->revealable()
                            ->same('new_password'),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = Auth::user();

        if (!empty($data['new_password'])) {
            if (empty($data['current_password']) || !Hash::check($data['current_password'], $user->password)) {
                Notification::make()
                    ->title(__('Kata sandi saat ini tidak cocok.'))
                    ->danger()
                    ->send();
                return;
            }
        }

        $user->name                  = $data['name'];
        $user->phone_number          = $data['phone_number'];
        $user->payout_method         = $data['payout_method'];
        $user->payout_bank_name      = ($data['payout_method'] === 'bank') ? ($data['payout_bank_name'] ?? null) : null;
        $user->payout_account_name   = $data['payout_account_name'];
        $user->payout_account_number = $data['payout_account_number'];

        if (!empty($data['new_password'])) {
            $user->password = Hash::make($data['new_password']);
        }
        $user->save();

        Notification::make()
            ->title(__('Profil dan informasi pembayaran berhasil disimpan! 🎉'))
            ->success()
            ->send();

        $this->data['current_password'] = null;
        $this->data['new_password'] = null;
        $this->data['new_password_confirmation'] = null;
    }

    public function getStats(): array
    {
        $user    = Auth::user();
        $balance = $user->userBalance;

        $totalMisi = \App\Models\MisiAnggota::where('id_user', $user->id)->count();
        $misiSelesai = \App\Models\MisiAnggota::where('id_user', $user->id)
            ->where('status', 'selesai')
            ->count();

        return [
            'saldo_rupiah' => $balance?->saldo_rupiah ?? 0,
            'total_misi'   => $totalMisi,
            'misi_selesai' => $misiSelesai,
            'member_since' => $user->created_at ? $user->created_at->translatedFormat('M Y') : '-',
        ];
    }
}
