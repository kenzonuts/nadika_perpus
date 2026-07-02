@props(['placeholder' => 'Search...', 'filters' => true])

<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-4 shadow-soft']) }}>
    <div class="flex flex-col lg:flex-row lg:items-center gap-3">
        <div class="relative flex-1">
            <x-ui.icon name="magnifying-glass" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary/40 dark:text-white/40" />
            <input
                type="search"
                x-model="searchQuery"
                placeholder="{{ $placeholder }}"
                class="w-full pl-10 pr-4 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white placeholder:text-secondary/40 focus:outline-none focus:ring-2 focus:ring-primary/20"
                aria-label="Search"
            />
        </div>
        @if ($filters)
            <div class="flex flex-wrap gap-2">
                {{ $filtersSlot ?? '' }}
                @if ($slot->isNotEmpty())
                    {{ $slot }}
                @endif
            </div>
        @endif
    </div>
</div>
