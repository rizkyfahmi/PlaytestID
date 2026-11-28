@php
    $currentLocale = strtolower(app()->getLocale());
    $languages = [
        'nl' => [
            'name' => 'Nederlands',
            'code' => 'NL',
        ],
        'en' => [
            'name' => 'English',
            'code' => 'EN',
        ],
        'id' => [
            'name' => 'Bahasa Indonesia',
            'code' => 'ID',
        ],
    ];
    $activeLang = $languages[$currentLocale] ?? $languages['id'];
@endphp

<div 
    x-data="{ open: false }" 
    x-on:click.outside="open = false" 
    x-on:keydown.escape.window="open = false"
    class="relative inline-block text-left fi-lang-switcher"
>
    <!-- Trigger Button (Matches dark theme, Flag + Label + Solid Triangle, Strict 1 line) -->
    <button 
        type="button" 
        x-on:click="open = !open" 
        :aria-expanded="open.toString()"
        aria-haspopup="true"
        class="fi-lang-btn group inline-flex items-center gap-x-2 select-none cursor-pointer focus:outline-none whitespace-nowrap"
        style="height: 34px !important; background: #18181b !important; border: 1px solid #2e2e34 !important; color: #f4f4f5 !important; white-space: nowrap !important; font-size: 12px !important; width: auto !important; flex-shrink: 0 !important;"
        title="{{ __('Ganti Bahasa') }}"
    >
        <!-- Flag Icon -->
        <span class="inline-flex items-center justify-center flex-shrink-0">
            @if ($currentLocale === 'nl')
                <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden" viewBox="0 0 9 6">
                    <rect width="9" height="2" fill="#AE1C28"/>
                    <rect y="2" width="9" height="2" fill="#FFFFFF"/>
                    <rect y="4" width="9" height="2" fill="#21468B"/>
                </svg>
            @elseif ($currentLocale === 'en')
                <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden" viewBox="0 0 60 36">
                    <clipPath id="lang-uk-flag-top"><path d="M0,0 v36 h60 v-36 z"/></clipPath>
                    <clipPath id="lang-uk-diag-top"><path d="M30,18 L60,36 H48 L24,21.6 L12,36 H0 L24,18 L0,0 H12 L36,14.4 L48,0 H60 z"/></clipPath>
                    <g clip-path="url(#lang-uk-flag-top)">
                        <path d="M0,0 v36 h60 v-36 z" fill="#012169"/>
                        <path d="M0,0 L60,36 M60,0 L0,36" stroke="#fff" stroke-width="6"/>
                        <path d="M0,0 L60,36 M60,0 L0,36" clip-path="url(#lang-uk-diag-top)" stroke="#C8102E" stroke-width="4"/>
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

        <!-- Language Name (Strictly 1 single line) -->
        <span class="fi-lang-label whitespace-nowrap" style="white-space: nowrap !important; font-size: 12px !important; line-height: 1 !important; display: inline-block !important;">
            {{ $activeLang['name'] }}
        </span>

        <!-- Triangle: Down when closed, Up when open (matching reference) -->
        <svg 
            class="fi-lang-chevron w-[8px] h-[5px] transition-transform duration-150 flex-shrink-0" 
            :class="{ 'rotate-180': open }"
            viewBox="0 0 10 6" 
            fill="currentColor"
        >
            <path d="M0 0l5 6 5-6z"/>
        </svg>
    </button>

    <!-- Dropdown Menu (Matches reference dropdown list) -->
    <div 
        x-show="open" 
        x-cloak
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fi-lang-dropdown absolute right-0 z-50 mt-1"
    >
        @foreach($languages as $code => $lang)
            @php $isSelected = ($currentLocale === $code); @endphp
            <a 
                href="{{ route('language.switch', $code) }}"
                class="fi-lang-item {{ $isSelected ? 'fi-lang-item--active' : '' }}"
            >
                <div class="flex items-center gap-x-2 min-w-0">
                    <span class="inline-flex items-center justify-center flex-shrink-0">
                        @if ($code === 'nl')
                            <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden" viewBox="0 0 9 6">
                                <rect width="9" height="2" fill="#AE1C28"/>
                                <rect y="2" width="9" height="2" fill="#FFFFFF"/>
                                <rect y="4" width="9" height="2" fill="#21468B"/>
                            </svg>
                        @elseif ($code === 'en')
                            <svg class="w-[18px] h-[12px] rounded-[2px] shadow-2xs flex-shrink-0 overflow-hidden" viewBox="0 0 60 36">
                                <clipPath id="lang-uk-flag-{{ $code }}"><path d="M0,0 v36 h60 v-36 z"/></clipPath>
                                <clipPath id="lang-uk-diag-{{ $code }}"><path d="M30,18 L60,36 H48 L24,21.6 L12,36 H0 L24,18 L0,0 H12 L36,14.4 L48,0 H60 z"/></clipPath>
                                <g clip-path="url(#lang-uk-flag-{{ $code }})">
                                    <path d="M0,0 v36 h60 v-36 z" fill="#012169"/>
                                    <path d="M0,0 L60,36 M60,0 L0,36" stroke="#fff" stroke-width="6"/>
                                    <path d="M0,0 L60,36 M60,0 L0,36" clip-path="url(#lang-uk-diag-{{ $code }})" stroke="#C8102E" stroke-width="4"/>
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
                    <span class="truncate">{{ $lang['name'] }}</span>
                </div>

                @if ($isSelected)
                    <svg class="w-[8px] h-[5px] text-gray-500 flex-shrink-0 ml-2" viewBox="0 0 10 6" fill="currentColor">
                        <path d="M0 6l5-6 5 6z"/>
                    </svg>
                @endif
            </a>
        @endforeach
    </div>
</div>
