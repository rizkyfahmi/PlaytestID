<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Pages\Login;
use App\Filament\Auth\Pages\Register;
use App\Filament\Auth\Pages\RequestResetPassword;
use App\Filament\Auth\Pages\ResetPassword;
use App\Filament\Developer\Pages\DeveloperDashboard;
use App\Filament\Developer\Pages\ProfileDeveloper;
use App\Filament\Developer\Pages\PantauProgress;
use App\Filament\Developer\Pages\TipsBantuanDeveloper;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class DeveloperPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('developer')
            ->path('developer')
            ->login(Login::class)
            ->registration(Register::class)
            ->passwordReset(RequestResetPassword::class, ResetPassword::class)
            // ── Warna sesuai landing page (#ea580c) ──  
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
            ->favicon('/favicon.ico')
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make(__('Manajemen Utama'))
                        ->items([
                            NavigationItem::make(__('Dasbor'))
                                ->icon('heroicon-o-squares-2x2')
                                ->url(fn(): string => DeveloperDashboard::getUrl())
                                ->isActiveWhen(fn() => request()->is('developer')),

                            NavigationItem::make(__('Pantau Progress'))
                                ->icon('heroicon-o-chart-bar')
                                ->url(fn(): string => PantauProgress::getUrl())
                                ->isActiveWhen(fn() => request()->routeIs('filament.developer.pages.pantau-progress')),

                            NavigationItem::make(__('Aplikasi Saya'))
                                ->icon('heroicon-o-square-3-stack-3d')
                                ->url(fn(): string => \App\Filament\Developer\Resources\Misis\MisiResource::getUrl())
                                ->isActiveWhen(fn() => request()->routeIs('filament.developer.resources.misis.index') || request()->routeIs('filament.developer.resources.misis.edit') || request()->routeIs('filament.developer.resources.misis.kelola-tester')),

                            NavigationItem::make(__('Test Case Baru'))
                                ->icon('heroicon-o-document-plus')
                                ->url(fn(): string => \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('create'))
                                ->isActiveWhen(fn() => request()->routeIs('filament.developer.resources.misis.create')),
                        ]),

                    NavigationGroup::make(__('Profil & Bantuan'))
                        ->items([
                            NavigationItem::make(__('Profil Saya'))
                                ->icon('heroicon-o-user-circle')
                                ->url(fn(): string => ProfileDeveloper::getUrl())
                                ->isActiveWhen(fn() => request()->routeIs('filament.developer.pages.profile-developer')),

                            NavigationItem::make(__('Tips & Bantuan'))
                                ->icon('heroicon-o-question-mark-circle')
                                ->url(fn(): string => TipsBantuanDeveloper::getUrl())
                                ->isActiveWhen(fn() => request()->routeIs('filament.developer.pages.tips-bantuan')),
                        ]),
                ]);
            })
            ->plugins([])

            ->renderHook(
                'panels::head.end',
                fn(): string => Blade::render("@vite(['resources/css/app.css', 'resources/css/filament-sidebar.css', 'resources/css/filament-topbar.css'])"),
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::USER_MENU_PROFILE_BEFORE,
                fn(): string => view('filament.components.language-switcher')->render(),
            )

            ->pages([
                DeveloperDashboard::class,
                PantauProgress::class,
            ])
            ->discoverPages(
                in: app_path('Filament/Developer/Pages'),
                for: 'App\\Filament\\Developer\\Pages'
            )
            ->discoverResources(
                in: app_path('Filament/Developer/Resources'),
                for: 'App\\Filament\\Developer\\Resources'
            )
            ->discoverWidgets(
                in: app_path('Filament/Developer/Widgets'),
                for: 'App\\Filament\\Developer\\Widgets'
            )
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->userMenuItems([
                'profile' => \Filament\Navigation\MenuItem::make()
                    ->label(fn() => auth()->user()->name)
                    ->url(fn(): string => ProfileDeveloper::getUrl())
                    ->icon('heroicon-o-user-circle'),
            ])
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
