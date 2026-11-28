@php
    use Filament\Support\Enums\Width;

    $livewire ??= null;

    $renderHookScopes = $livewire?->getRenderHookScopes();
    $maxContentWidth ??= (filament()->getSimplePageMaxContentWidth() ?? Width::Large);

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @props([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ])

    {{-- ════════════════════════════════════════════════════════
         HELDEN INC DARK THEME SUPPORT ON AUTH PAGES
         Sync with user theme preference (default to dark)
    ════════════════════════════════════════════════════════ --}}
    @push('scripts')
    <script>
        (function () {
            var applyAuthTheme = function () {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                localStorage.setItem('pt-theme', 'dark');
            };
            applyAuthTheme();
            document.addEventListener('livewire:navigated', applyAuthTheme);
            document.addEventListener('DOMContentLoaded', applyAuthTheme);
        })();
    </script>
    @endpush

    @push('styles')
    <style>
        .dark body,
        .dark .fi-body,
        .dark .fi-simple-layout,
        .dark .fi-simple-main-ctn,
        .dark .fi-simple-main {
            background-color: #1a1a18 !important;
            background: #1a1a18 !important;
        }
    </style>
    @endpush

    <div class="fi-simple-layout">
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_START, scopes: $renderHookScopes) }}

        @if (($hasTopbar ?? true) && filament()->auth()->check())
            <div class="fi-simple-layout-header">
                @if (filament()->hasDatabaseNotifications())
                    @livewire(filament()->getDatabaseNotificationsLivewireComponent(), [
                        'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                        'position' => \Filament\Enums\DatabaseNotificationsPosition::Topbar,
                    ])
                @endif

                @if (filament()->hasUserMenu())
                    @livewire(Filament\Livewire\SimpleUserMenu::class)
                @endif
            </div>
        @endif

        <div class="fi-simple-main-ctn">
            <main
                @class([
                    'fi-simple-main',
                    ($maxContentWidth instanceof Width) ? "fi-width-{$maxContentWidth->value}" : $maxContentWidth,
                ])
            >
                {{ $slot }}
            </main>
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $renderHookScopes) }}

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $renderHookScopes) }}
    </div>
</x-filament-panels::layout.base>
