@props(['active' => ''])

@php
    $tabs = [
        ['id' => 'general', 'label' => 'General', 'href' => url('/settings/general'), 'icon' => 'cog-6-tooth'],
        ['id' => 'library', 'label' => 'Library', 'href' => url('/settings/library'), 'icon' => 'book-open'],
        ['id' => 'security', 'label' => 'Security', 'href' => url('/settings/security'), 'icon' => 'shield-check'],
        ['id' => 'notifications', 'label' => 'Notifications', 'href' => url('/settings/notifications'), 'icon' => 'bell'],
        ['id' => 'system', 'label' => 'System', 'href' => url('/settings/system'), 'icon' => 'command-line'],
    ];
@endphp

<nav class="flex overflow-x-auto gap-1 p-1 bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl mb-6" aria-label="Settings tabs">
    @foreach ($tabs as $tab)
        <a
            href="{{ $tab['href'] }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg whitespace-nowrap transition-colors {{ $active === $tab['id'] ? 'bg-card dark:bg-secondary text-primary shadow-soft' : 'text-secondary/60 dark:text-white/60 hover:text-secondary dark:hover:text-white' }}"
            @if ($active === $tab['id']) aria-current="page" @endif
        >
            <x-ui.icon :name="$tab['icon']" class="w-4 h-4" />
            {{ $tab['label'] }}
        </a>
    @endforeach
</nav>
