<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Pages\Login;
use App\Filament\Auth\Pages\Register;
use App\Filament\Auth\Pages\RequestResetPassword;
use App\Filament\Auth\Pages\ResetPassword;
use App\Filament\Tester\Pages\TesterDashboard;
use App\Filament\Tester\Pages\ProfileTester;
use App\Filament\Tester\Pages\Dompet;
use App\Filament\Tester\Pages\MisiSaya;
use App\Filament\Tester\Pages\HistoryMisi;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationBuilder;
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

class TesterPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('tester')
            ->path('tester')
            ->login(Login::class)
            ->registration(Register::class)
            ->passwordReset(RequestResetPassword::class, ResetPassword::class)
            ->darkMode(true, isForced: true)
            ->defaultThemeMode(\Filament\Enums\ThemeMode::Dark)

            // ── Warna primer: Helden Inc Gold/Yellow ────  
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
            ])

            // ── Sidebar Navigation ────────────────────────────  
            ->favicon('/favicon.ico')
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make(__('Utama'))
                        ->items([
                            NavigationItem::make(__('Beranda'))
                                ->icon('heroicon-o-home')
                                ->isActiveWhen(fn() => request()->routeIs('filament.tester.pages.tester-dashboard'))
                                ->url(fn() => TesterDashboard::getUrl()),

                            NavigationItem::make(__('Misi Saya'))
                                ->icon('heroicon-o-clipboard-document-check')
                                ->badge(fn() => MisiSaya::getNavigationBadge(), 'warning')
                                ->isActiveWhen(fn() => request()->routeIs('filament.tester.pages.misi-saya'))
                                ->url(fn() => MisiSaya::getUrl()),

                            NavigationItem::make(__('Dompet'))
                                ->icon('heroicon-o-credit-card')
                                ->isActiveWhen(fn() => request()->routeIs('filament.tester.pages.dompet'))
                                ->url(fn() => Dompet::getUrl()),

                            NavigationItem::make(__('Histori Misi'))
                                ->icon('heroicon-o-clock')
                                ->isActiveWhen(fn() => request()->routeIs('filament.tester.pages.history-misi'))
                                ->url(fn() => HistoryMisi::getUrl()),

                        ]),

                    NavigationGroup::make(__('Profil'))
                        ->items([
                            NavigationItem::make(__('Profil Saya'))
                                ->icon('heroicon-o-user-circle')
                                ->url(fn() => ProfileTester::getUrl())
                                ->isActiveWhen(fn() => request()->routeIs('filament.tester.pages.profile-tester')),
                        ]),
                ]);
            })

            // ── Pages ─────────────────────────────────────────  
            ->pages([
                TesterDashboard::class,
                ProfileTester::class,
                Dompet::class,
                HistoryMisi::class,
            ])
            ->discoverPages(
                in: app_path('Filament/Tester/Pages'),
                for: 'App\\Filament\\Tester\\Pages'
            )
            ->userMenuItems([
                'profile' => \Filament\Navigation\MenuItem::make()
                    ->label(fn() => auth()->user()->name)
                    ->url(fn(): string => ProfileTester::getUrl())
                    ->icon('heroicon-o-user-circle'),
            ])

            // ── Assets ────────────────────────────────────────  
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