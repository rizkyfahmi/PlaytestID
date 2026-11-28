<?php

namespace App\Filament\Tester\Pages;

use App\Models\User;
use App\Models\UserBalance;
use App\Models\Withdraw;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Dompet extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';

    public static function getNavigationLabel(): string
    {
        return __('Dompet & Penarikan');
    }

    public function getTitle(): string
    {
        return __('Dompet Tester & Tarik Komisi');
    }

    protected static ?string $slug = 'dompet';
    protected static ?int $navigationSort = 3;
    protected string $view = 'filament.tester.pages.dompet';

    // State Penarikan
    public $amount = 20000;
    public string $selectedMethod = 'bank';
    public string $bankName = 'BCA';
    public string $accountName = '';
    public string $accountNumber = '';

    public array $riwayat = [];

    public function mount(): void
    {
        $user = Auth::user();
        if ($user) {
            $this->selectedMethod = $user->payout_method ?? 'bank';
            $this->bankName       = $user->payout_bank_name ?? 'BCA';
            $this->accountName    = $user->payout_account_name ?? ($user->name ?? '');
            $this->accountNumber  = $user->payout_account_number ?? '';
        }

        $balance = $this->getBalance();
        if ($balance >= 20000 && $balance <= 100000) {
            $this->amount = $balance;
        } else {
            $this->amount = 20000;
        }

        $this->loadRiwayat();
    }

    public function setAmount(int $val): void
    {
        $this->amount = $val;
    }

    public function withdrawAll(): void
    {
        $this->amount = $this->getBalance();
    }

    public function loadRiwayat(): void
    {
        $userId = Auth::id();
        $this->riwayat = Withdraw::where('id_user', $userId)
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get()
            ->map(function ($w) {
                return [
                    'id' => $w->id,
                    'rupiah' => $w->rupiah,
                    'rupiahF' => 'Rp ' . number_format($w->rupiah, 0, ',', '.'),
                    'metode' => strtoupper($w->metode),
                    'nomorAkun' => $w->nomor_akun,
                    'status' => $w->status,
                    'tanggal' => $w->created_at->format('d M Y H:i'),
                    'catatan' => $w->catatan,
                ];
            })
            ->toArray();
    }

    public function getBalance(): int
    {
        $user = Auth::user();
        if (!$user) return 0;
        $ub = UserBalance::where('id_user', $user->id)->first();
        return (int) ($ub?->saldo_rupiah ?? 0);
    }

    public function submitWithdrawal(): void
    {
        $user = Auth::user();
        if (!$user) return;

        $balance = UserBalance::firstOrCreate(
            ['id_user' => $user->id],
            ['point' => 0, 'badge' => 0, 'saldo_rupiah' => 0]
        );

        $currentSaldo = (int) $balance->saldo_rupiah;
        $cleanAmount = (int) preg_replace('/[^0-9]/', '', (string) ($this->amount ?? 0));

        if ($cleanAmount < 20000) {
            Notification::make()
                ->title(__('Batas Minimum Penarikan'))
                ->body(__('Batas minimum penarikan komisi adalah Rp 20.000.'))
                ->danger()
                ->send();
            return;
        }

        if ($cleanAmount > $currentSaldo) {
            Notification::make()
                ->title(__('Saldo Tidak Mencukupi'))
                ->body(__('Saldo dompet Anda (Rp :saldo) tidak mencukupi untuk menarik Rp :amount.', [
                    'saldo'  => number_format($currentSaldo, 0, ',', '.'),
                    'amount' => number_format($cleanAmount, 0, ',', '.'),
                ]))
                ->danger()
                ->send();
            return;
        }

        if (empty(trim($this->accountName)) || empty(trim($this->accountNumber))) {
            Notification::make()
                ->title(__('Informasi Rekening / Akun Belum Lengkap'))
                ->body(__('Mohon lengkapi nama pemilik dan nomor rekening / e-wallet tujuan.'))
                ->danger()
                ->send();
            return;
        }

        // Potong saldo
        $balance->decrement('saldo_rupiah', $cleanAmount);

        // Catat withdraw
        $metodeFull = ($this->selectedMethod === 'bank') ? ($this->bankName . ' - ' . $this->selectedMethod) : $this->selectedMethod;

        Withdraw::create([
            'id_user'    => $user->id,
            'point'      => 0,
            'rupiah'     => $cleanAmount,
            'metode'     => $metodeFull,
            'nomor_akun' => $this->accountName . ' (' . $this->accountNumber . ')',
            'status'     => 'pending',
            'catatan'    => 'Penarikan komisi tester pengujian tatap muka',
        ]);

        // Simpan info rekening / akun tester untuk penarikan berikutnya
        /** @var User $user */
        $user->update([
            'payout_method'         => $this->selectedMethod,
            'payout_bank_name'      => $this->bankName,
            'payout_account_name'   => $this->accountName,
            'payout_account_number' => $this->accountNumber,
        ]);

        $this->loadRiwayat();

        // Reset default amount
        $newBalance = (int) $balance->fresh()->saldo_rupiah;
        $this->amount = $newBalance >= 20000 ? min(20000, $newBalance) : 20000;

        Notification::make()
            ->title(__('Permintaan Penarikan Terkirim! 💸'))
            ->body(__('Penarikan dana sebesar Rp :amount sedang diproses oleh Admin ke :tujuan.', [
                'amount' => number_format($cleanAmount, 0, ',', '.'),
                'tujuan' => strtoupper($this->selectedMethod) . ' ' . $this->accountNumber,
            ]))
            ->success()
            ->send();
    }
}
