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
use App\Filament\Tester\Pages\TipsBantuanTester;
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

            // ── Warna primer: Orange ────  
            ->colors([
                'primary' => [
                    50 => '255 247 237',
                    100 => '255 237 213',
                    200 => '254 215 170',
                    300 => '253 186 116',
                    400 => '251 146 60',
                    500 => '249 115 22',
                    600 => '234 88 12',
                    700 => '194 65 12',
                    800 => '154 52 18',
                    900 => '124 45 18',
                    950 => '67 20 7',
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
                                ->badge(fn() => MisiSaya::getNavigationBadge())
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

                    NavigationGroup::make(__('Profil & Bantuan'))
                        ->items([
                            NavigationItem::make(__('Profil Saya'))
                                ->icon('heroicon-o-user-circle')
                                ->url(fn() => ProfileTester::getUrl())
                                ->isActiveWhen(fn() => request()->routeIs('filament.tester.pages.profile-tester')),

                            NavigationItem::make(__('Tips & Bantuan'))
                                ->icon('heroicon-o-question-mark-circle')
                                ->url(fn() => TipsBantuanTester::getUrl())
                                ->isActiveWhen(fn() => request()->routeIs('filament.tester.pages.tips-bantuan')),
                        ]),
                ]);
            })

            // ── Pages ─────────────────────────────────────────  
            ->pages([
                TesterDashboard::class,
                ProfileTester::class,
                Dompet::class,
                HistoryMisi::class,
                TipsBantuanTester::class,
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
            ->renderHook(
                \Filament\View\PanelsRenderHook::USER_MENU_PROFILE_BEFORE,
                fn(): string => view('filament.components.language-switcher')->render(),
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