@php
    $pageComponent = static::isSimple() ? 'filament-panels::page.simple' : 'filament-panels::page';
@endphp

<x-dynamic-component :component="$pageComponent">
    {{ $this->content }}
</x-dynamic-component>

@push('scripts')
<script>
    function toggleAuthTheme() {
        const html = document.documentElement;
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        localStorage.setItem('pt-theme', isDark ? 'dark' : 'light');
    }
</script>
@endpush
