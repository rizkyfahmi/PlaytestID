<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Pages\Login;
use App\Filament\Auth\Pages\RequestResetPassword;
use App\Filament\Auth\Pages\ResetPassword;
use App\Filament\Admin\Pages\AdminDashboard;
use App\Filament\Admin\Pages\ManajemenPengguna;
use App\Filament\Admin\Pages\ManajemenKampanye;
use App\Filament\Admin\Pages\ManajemenPembayaran;
use App\Filament\Admin\Pages\ManajemenPaket;
use App\Filament\Admin\Pages\ProfileAdmin;
use App\Filament\Admin\Pages\ManajemenWithdraw;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->passwordReset(RequestResetPassword::class, ResetPassword::class)
            ->darkMode(true, isForced: true)
            ->defaultThemeMode(\Filament\Enums\ThemeMode::Dark)

            // ── Brand & Warna (Helden Inc Theme: Gold/Yellow #ffd900) ──  
            ->colors([
                'primary' => [
                    50  => '254 252 232',
                    100 => '254 249 195',
                    200 => '254 240 138',
                    300 => '253 224 71',
                    400 => '254 208 0',
                    500 => '255 217 0',
                    600 => '230 195 0',
                    700 => '202 138 4',
                    800 => '161 98  7',
                    900 => '113 63  18',
                    950 => '66  32  6',
                ],
                'warning' => Color::Amber,
            ])

            ->favicon('/favicon.ico')

            // ── Sidebar Navigation ────────────────────────────  
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make(__('Manajemen Utama'))
                        ->items([
                            NavigationItem::make(__('Dasbor'))
                                ->icon('heroicon-o-squares-2x2')
                                ->isActiveWhen(fn() => request()->routeIs('filament.admin.pages.admin-dashboard'))
                                ->url(fn() => AdminDashboard::getUrl()),

                            NavigationItem::make(__('Pengguna'))
                                ->icon('heroicon-o-users')
                                ->badge(fn() => \App\Models\User::where('role', '!=', \App\Enums\UserRole::admin)->count() ?: null)
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-pengguna*'))
                                ->url(fn() => ManajemenPengguna::getUrl()),

                            NavigationItem::make(__('Kampanye'))
                                ->icon('heroicon-o-clipboard-document-list')
                                ->badge(fn() => \App\Models\Misi::count() ?: null)
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-kampanye*'))
                                ->url(fn() => ManajemenKampanye::getUrl()),

                            NavigationItem::make(__('Paket'))
                                ->icon('heroicon-o-currency-dollar')
                                ->url(fn() => ManajemenPaket::getUrl())
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-paket*') || request()->is('admin/packets*')),
                        ]),

                    NavigationGroup::make(__('Transaksi & Keuangan'))
                        ->items([
                            NavigationItem::make(__('Pembayaran Developer'))
                                ->icon('heroicon-o-credit-card')
                                ->badge(fn() => \App\Models\Pembayaran::where('status', 'pending')->count() ?: null)
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-pembayaran*'))
                                ->url(fn() => ManajemenPembayaran::getUrl()),

                            NavigationItem::make(__('Penarikan Tester'))
                                ->icon('heroicon-o-banknotes')
                                ->badge(fn() => \App\Models\Withdraw::where('status', 'pending')->count() ?: null)
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-withdraw*'))
                                ->url(fn() => ManajemenWithdraw::getUrl()),
                        ]),

                    NavigationGroup::make(__('Profil'))
                        ->items([
                            NavigationItem::make(__('Profil Saya'))
                                ->icon('heroicon-o-user-circle')
                                ->isActiveWhen(fn() => request()->routeIs('filament.admin.pages.profile-admin'))
                                ->url(fn() => ProfileAdmin::getUrl()),
                        ]),
                ]);
            })

            // ── Pages & Widgets ───────────────────────────────  
            ->pages([
                AdminDashboard::class,
                ManajemenPengguna::class,
                ManajemenKampanye::class,
                ManajemenPembayaran::class,
                ManajemenPaket::class,
                ProfileAdmin::class,
                ManajemenWithdraw::class,
            ])
            ->discoverPages(
                in: app_path('Filament/Admin/Pages'),
                for: 'App\\Filament\\Admin\\Pages'
            )
            ->discoverResources(
                in: app_path('Filament/Admin/Resources'),
                for: 'App\\Filament\\Admin\\Resources'
            )
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->userMenuItems([
                'profile' => \Filament\Navigation\MenuItem::make()
                    ->label(fn() => auth()->user()->name)
                    ->url(fn(): string => ProfileAdmin::getUrl())
                    ->icon('heroicon-o-user-circle'),
            ])

            // ── Assets ───────────────────────────────────────  
            ->renderHook(
                'panels::head.end',
                fn(): string => Blade::render("@vite(['resources/css/app.css', 'resources/css/filament-sidebar.css', 'resources/css/filament-topbar.css'])"),
            )

            // ── Middleware ────────────────────────────────────  
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \App\Http\Middleware\LanguageManagerMiddleware::class,
            ])
            ->authMiddleware([
                \App\Http\Middleware\AuthenticatePanel::class,
            ]);
    }
}
