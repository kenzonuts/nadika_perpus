@props(['active' => 'index'])

@php
    $tabs = [
        ['id' => 'index', 'label' => 'Profile', 'href' => url('/profile'), 'icon' => 'user-circle'],
        ['id' => 'security', 'label' => 'Security', 'href' => url('/profile/security'), 'icon' => 'shield-check'],
        ['id' => 'activity', 'label' => 'Activity', 'href' => url('/profile/activity'), 'icon' => 'clock'],
    ];
@endphp

<nav class="flex overflow-x-auto gap-1 p-1 bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl mb-6" aria-label="Profile tabs">
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
