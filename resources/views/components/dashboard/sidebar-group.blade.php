@props([
    'label' => '',
    'icon' => null,
    'defaultOpen' => false,
])

<div x-data="sidebarGroup({{ $defaultOpen ? 'true' : 'false' }})" {{ $attributes }}>
    <button
        type="button"
        @click="toggle()"
        class="w-full group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-secondary/70 dark:text-white/60 hover:bg-background dark:hover:bg-white/5 hover:text-secondary dark:hover:text-white transition-all duration-200"
        :aria-expanded="open"
    >
        @if ($icon)
            <x-ui.icon :name="$icon" class="w-5 h-5 shrink-0" />
        @endif

        <span x-show="!sidebarCollapsed" x-cloak class="truncate flex-1 text-left">{{ $label }}</span>

        <x-ui.icon
            x-show="!sidebarCollapsed"
            x-cloak
            name="chevron-down"
            class="w-4 h-4 shrink-0 transition-transform duration-200"
            ::class="open ? 'rotate-180' : ''"
        />
    </button>

    <div
        x-show="open && !sidebarCollapsed"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="mt-1 ml-4 pl-4 border-l border-border dark:border-white/10 space-y-0.5"
    >
        {{ $slot }}
    </div>
</div>
