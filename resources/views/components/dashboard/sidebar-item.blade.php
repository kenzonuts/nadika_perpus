@props([
    'href' => '#',
    'icon' => null,
    'active' => false,
    'label' => '',
])

@php
    $classes = $active
        ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light'
        : 'text-secondary/70 dark:text-white/60 hover:bg-background dark:hover:bg-white/5 hover:text-secondary dark:hover:text-white';
@endphp

<a
    href="{{ $href }}"
    @click="closeMobileSidebar()"
    {{ $attributes->merge(['class' => 'group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 ' . $classes]) }}
    @if ($active) aria-current="page" @endif
>
    @if ($icon)
        <x-ui.icon :name="$icon" class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" />
    @endif

    <span x-show="!sidebarCollapsed" x-cloak class="truncate">{{ $label ?: $slot }}</span>

    @if ($active)
        <span x-show="!sidebarCollapsed" x-cloak class="ml-auto w-1.5 h-1.5 rounded-full bg-primary"></span>
    @endif
</a>
