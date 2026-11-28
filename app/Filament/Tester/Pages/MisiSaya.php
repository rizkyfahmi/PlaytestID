<?php

namespace App\Filament\Tester\Pages;

use App\Models\MisiAnggota;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class MisiSaya extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected string $view = 'filament.tester.pages.misi-saya';

    public static function getNavigationLabel(): string
    {
        return __('Misi Saya');
    }

    public function getTitle(): string
    {
        return __('Pengujian & Misi Saya');
    }

    protected static string|\UnitEnum|null $navigationGroup = 'Menu';
    protected static ?int $navigationSort = 2;

    public string $activeTab = 'semua';
    public string $search = '';

    public static function getNavigationBadge(): ?string
    {
        if (!Auth::check()) return null;

        $count = MisiAnggota::where('id_user', Auth::id())
            ->whereIn('status', ['accepted', 'progress'])
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public function getViewData(): array
    {
        $userId = Auth::id();
        $query = MisiAnggota::where('id_user', $userId)
            ->with(['misi', 'misi.user'])
            ->orderBy('created_at', 'desc');

        if ($this->search) {
            $s = '%' . $this->search . '%';
            $query->whereHas('misi', function ($q) use ($s) {
                $q->where('nama_aplikasi', 'like', $s)
                  ->orWhere('penyelenggara', 'like', $s)
                  ->orWhere('lokasi', 'like', $s);
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

        $all = MisiAnggota::where('id_user', $userId)->get();

        return [
            'missions' => $query->get(),
            'statTotal' => $all->count(),
            'statMenunggu' => $all->whereIn('status', ['pending', 'reviewing', 'menunggu_seleksi'])->count(),
            'statDiterima' => $all->whereIn('status', ['accepted', 'progress'])->count(),
            'statSelesai' => $all->where('status', 'selesai')->count(),
            'statDitolak' => $all->whereIn('status', ['rejected', 'cancelled'])->count(),
        ];
    }
}
