@php
    $currentLocale = strtolower(App::getLocale());
    $languages = [
        'nl' => ['name' => 'Nederlands', 'code' => 'NL'],
        'en' => ['name' => 'English', 'code' => 'EN'],
        'id' => ['name' => 'Bahasa Indonesia', 'code' => 'ID'],
    ];
    $activeLang = $languages[$currentLocale] ?? $languages['id'];
    $isPrefixRoute = in_array(request()->segment(1), ['id', 'en', 'nl']);
    $currentRoute = Route::currentRouteName();
    $routeParams = Route::current() ? Route::current()->parameters() : [];
@endphp

<div class="lang-dropdown-wrapper {{ $attributes->get('class') }}" onclick="event.stopPropagation()">
    <button 
        type="button" 
        class="lang-dropdown-trigger" 
        style="white-space: nowrap !important; font-size: 12px !important;"
        onclick="toggleLangMenu(this, event)"
        aria-label="{{ __('Pilih Bahasa') }}"
        title="{{ __('Ganti Bahasa') }}"
    >
        <!-- Flag for current locale -->
        <span class="inline-flex items-center justify-center flex-shrink-0">
            @if ($currentLocale === 'nl')
                <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden" viewBox="0 0 9 6">
                    <rect width="9" height="2" fill="#AE1C28"/>
                    <rect y="2" width="9" height="2" fill="#FFFFFF"/>
                    <rect y="4" width="9" height="2" fill="#21468B"/>
                </svg>
            @elseif ($currentLocale === 'en')
                <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden" viewBox="0 0 60 36">
                    <clipPath id="landing-uk-flag"><path d="M0,0 v36 h60 v-36 z"/></clipPath>
                    <clipPath id="landing-uk-diag"><path d="M30,18 L60,36 H48 L24,21.6 L12,36 H0 L24,18 L0,0 H12 L36,14.4 L48,0 H60 z"/></clipPath>
                    <g clip-path="url(#landing-uk-flag)">
                        <path d="M0,0 v36 h60 v-36 z" fill="#012169"/>
                        <path d="M0,0 L60,36 M60,0 L0,36" stroke="#fff" stroke-width="6"/>
                        <path d="M0,0 L60,36 M60,0 L0,36" clip-path="url(#landing-uk-diag)" stroke="#C8102E" stroke-width="4"/>
                        <path d="M30,0 v36 M0,18 h60" stroke="#fff" stroke-width="10"/>
                        <path d="M30,0 v36 M0,18 h60" stroke="#C8102E" stroke-width="6"/>
                    </g>
                </svg>
            @else
                <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden border border-black/10" viewBox="0 0 3 2">
                    <rect width="3" height="1" fill="#E70011"/>
                    <rect y="1" width="3" height="1" fill="#FFFFFF"/>
                </svg>
            @endif
        </span>

        <span class="lang-dropdown-label" style="white-space: nowrap !important; font-size: 12px !important; line-height: 1 !important;">{{ $activeLang['name'] }}</span>

        <svg class="lang-dropdown-arrow" viewBox="0 0 10 6" fill="currentColor">
            <path d="M0 0l5 6 5-6z"/>
        </svg>
    </button>

    <div class="lang-dropdown-menu" style="display: none;">
        @foreach($languages as $code => $lang)
            @php
                if ($isPrefixRoute && $currentRoute) {
                    $langUrl = route($currentRoute, array_merge($routeParams, ['locale' => $code]));
                } elseif ($isPrefixRoute) {
                    $langUrl = url('/' . $code);
                } else {
                    $langUrl = route('language.switch', $code);
                }
                $isActive = ($currentLocale === $code);
            @endphp
            <a 
                href="{{ $langUrl }}" 
                class="lang-dropdown-item {{ $isActive ? 'active' : '' }}"
                onclick="closeAllLangMenus()"
            >
                <span class="inline-flex items-center gap-x-2">
                    @if ($code === 'nl')
                        <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden" viewBox="0 0 9 6">
                            <rect width="9" height="2" fill="#AE1C28"/>
                            <rect y="2" width="9" height="2" fill="#FFFFFF"/>
                            <rect y="4" width="9" height="2" fill="#21468B"/>
                        </svg>
                    @elseif ($code === 'en')
                        <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden" viewBox="0 0 60 36">
                            <clipPath id="landing-menu-uk-{{ $code }}"><path d="M0,0 v36 h60 v-36 z"/></clipPath>
                            <clipPath id="landing-menu-diag-{{ $code }}"><path d="M30,18 L60,36 H48 L24,21.6 L12,36 H0 L24,18 L0,0 H12 L36,14.4 L48,0 H60 z"/></clipPath>
                            <g clip-path="url(#landing-menu-uk-{{ $code }})">
                                <path d="M0,0 v36 h60 v-36 z" fill="#012169"/>
                                <path d="M0,0 L60,36 M60,0 L0,36" stroke="#fff" stroke-width="6"/>
                                <path d="M0,0 L60,36 M60,0 L0,36" clip-path="url(#landing-menu-diag-{{ $code }})" stroke="#C8102E" stroke-width="4"/>
                                <path d="M30,0 v36 M0,18 h60" stroke="#fff" stroke-width="10"/>
                                <path d="M30,0 v36 M0,18 h60" stroke="#C8102E" stroke-width="6"/>
                            </g>
                        </svg>
                    @else
                        <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden border border-black/10" viewBox="0 0 3 2">
                            <rect width="3" height="1" fill="#E70011"/>
                            <rect y="1" width="3" height="1" fill="#FFFFFF"/>
                        </svg>
                    @endif
                    <span>{{ $lang['name'] }}</span>
                </span>
                @if ($isActive)
                    <svg class="w-[8px] h-[5px] text-gray-500 flex-shrink-0 ml-2" viewBox="0 0 10 6" fill="currentColor">
                        <path d="M0 6l5-6 5 6z"/>
                    </svg>
                @endif
            </a>
        @endforeach
    </div>
</div>

@once
<style>
    .lang-dropdown-wrapper {
        position: relative;
        display: inline-block;
        vertical-align: middle;
        z-index: 60;
        font-family: inherit;
    }

    .lang-dropdown-trigger {
        height: 32px !important;
        padding: 0 10px !important;
        background: #18181b !important;
        border: 1px solid #2e2e34 !important;
        border-radius: 6px !important;
        color: #f4f4f5 !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        cursor: pointer !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
        transition: all 0.15s ease !important;
        user-select: none !important;
        outline: none !important;
        width: auto !important;
        line-height: normal !important;
    }

    .lang-dropdown-trigger:hover {
        background: #222226 !important;
        border-color: #ffd900 !important;
        color: #ffffff !important;
    }

    .lang-dropdown-wrapper.open .lang-dropdown-trigger {
        border-color: #ffd900 !important;
    }

    .lang-dropdown-label {
        font-size: 13px !important;
        font-weight: 500 !important;
        color: #f4f4f5 !important;
        letter-spacing: -0.01em !important;
    }

    .lang-dropdown-arrow {
        width: 8px;
        height: 5px;
        color: #a1a1aa;
        transition: transform 0.15s ease, color 0.15s ease;
        flex-shrink: 0;
    }

    .lang-dropdown-trigger:hover .lang-dropdown-arrow,
    .lang-dropdown-wrapper.open .lang-dropdown-arrow {
        color: #ffd900;
        transform: rotate(180deg);
    }

    .lang-dropdown-menu {
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        min-width: 100%;
        width: max-content;
        min-width: 140px;
        background: #18181b !important;
        border: 1px solid #2e2e34 !important;
        border-radius: 6px !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.7), 0 8px 10px -6px rgba(0, 0, 0, 0.6) !important;
        padding: 4px !important;
        z-index: 100;
    }

    .lang-dropdown-item {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 6px 10px !important;
        border-radius: 4px !important;
        color: #d4d4d8 !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        text-decoration: none !important;
        transition: all 0.12s ease !important;
        cursor: pointer !important;
        white-space: nowrap !important;
    }

    .lang-dropdown-item:hover {
        background: #27272a !important;
        color: #ffffff !important;
    }

    .lang-dropdown-item.active {
        background: rgba(255, 217, 0, 0.12) !important;
        font-weight: 600 !important;
        color: #ffd900 !important;
    }
</style>
<script>
    function toggleLangMenu(btn, event) {
        if (event) event.stopPropagation();
        var wrap = btn.closest('.lang-dropdown-wrapper');
        if (!wrap) return;
        var menu = wrap.querySelector('.lang-dropdown-menu');
        if (!menu) return;

        var isOpen = menu.style.display !== 'none';
        closeAllLangMenus();

        if (!isOpen) {
            menu.style.display = 'block';
            wrap.classList.add('open');
        }
    }

    function closeAllLangMenus() {
        document.querySelectorAll('.lang-dropdown-menu').forEach(function(m) {
            m.style.display = 'none';
        });
        document.querySelectorAll('.lang-dropdown-wrapper').forEach(function(w) {
            w.classList.remove('open');
        });
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.lang-dropdown-wrapper')) {
            closeAllLangMenus();
        }
    });
</script>
@endonce
