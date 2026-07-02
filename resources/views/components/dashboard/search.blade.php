{{-- Global Search Modal (Ctrl+K) --}}
<div
    x-show="searchOpen"
    x-cloak
    class="fixed inset-0 z-[100] flex items-start justify-center pt-[15vh] px-4"
    @keydown.escape.window="searchOpen = false"
>
    <div class="fixed inset-0 bg-secondary/40 dark:bg-black/60 backdrop-blur-sm" @click="searchOpen = false"></div>

    <div
        x-show="searchOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-xl bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-2xl shadow-soft-xl overflow-hidden"
        role="dialog"
        aria-modal="true"
        aria-label="Global search"
    >
        <div class="flex items-center gap-3 px-4 border-b border-border dark:border-white/10">
            <x-ui.icon name="magnifying-glass" class="w-5 h-5 text-secondary/40 dark:text-white/40 shrink-0" />
            <input
                type="search"
                placeholder="Search books, members, transactions..."
                class="flex-1 py-4 text-sm bg-transparent text-secondary dark:text-white placeholder:text-secondary/40 dark:placeholder:text-white/40 focus:outline-none"
                x-ref="searchInput"
                x-init="$watch('searchOpen', value => { if (value) $nextTick(() => $refs.searchInput?.focus()) })"
            />
            <kbd class="hidden sm:inline-flex items-center gap-0.5 px-2 py-1 text-xs text-secondary/40 dark:text-white/40 bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-md">ESC</kbd>
        </div>

        <div class="p-2">
            <p class="px-3 py-2 text-xs font-medium text-secondary/40 dark:text-white/40 uppercase tracking-wider">Recent Searches</p>
            @foreach (['Clean Code', 'John Mitchell', 'Overdue returns', 'Programming books'] as $recent)
                <button
                    type="button"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5 transition-colors text-left"
                >
                    <x-ui.icon name="clock" class="w-4 h-4 text-secondary/30 dark:text-white/30" />
                    {{ $recent }}
                </button>
            @endforeach
        </div>
    </div>
</div>

{{-- Search trigger button (for navbar) --}}
<button
    type="button"
    @click="toggleSearch()"
    {{ $attributes->merge(['class' => 'hidden md:flex items-center gap-3 w-64 lg:w-80 px-4 py-2 text-sm text-secondary/50 dark:text-white/50 bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl hover:border-primary/30 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/20']) }}
>
    <x-ui.icon name="magnifying-glass" class="w-4 h-4 shrink-0" />
    <span class="flex-1 text-left">Search...</span>
    <kbd class="inline-flex items-center gap-0.5 px-1.5 py-0.5 text-[10px] font-medium bg-card dark:bg-secondary border border-border dark:border-white/10 rounded">⌘K</kbd>
</button>
