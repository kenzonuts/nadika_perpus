@props([
    'current' => 1,
    'total' => 5,
    'perPage' => 10,
    'totalItems' => 48,
])

<div {{ $attributes->merge(['class' => 'flex flex-col sm:flex-row items-center justify-between gap-4 px-2']) }}>
    <div class="flex items-center gap-3 text-sm text-secondary/60 dark:text-white/60">
        <span>Rows per page:</span>
        <select class="px-2 py-1.5 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
            <option value="10" @selected($perPage == 10)>10</option>
            <option value="25" @selected($perPage == 25)>25</option>
            <option value="50" @selected($perPage == 50)>50</option>
        </select>
        <span class="hidden sm:inline">Showing {{ ($current - 1) * $perPage + 1 }}–{{ min($current * $perPage, $totalItems) }} of {{ $totalItems }}</span>
    </div>

    <nav class="flex items-center gap-1" aria-label="Pagination">
        <button
            type="button"
            @disabled($current <= 1)
            class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-xl border border-border dark:border-white/10 text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5 disabled:opacity-40 disabled:cursor-not-allowed transition-colors"
        >
            <x-ui.icon name="chevron-left" class="w-4 h-4" />
            Previous
        </button>

        @for ($i = 1; $i <= min($total, 5); $i++)
            <button
                type="button"
                class="w-9 h-9 text-sm font-medium rounded-xl transition-colors {{ $i === $current ? 'bg-primary text-white shadow-soft' : 'text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5' }}"
                @if ($i === $current) aria-current="page" @endif
            >
                {{ $i }}
            </button>
        @endfor

        @if ($total > 5)
            <span class="px-2 text-secondary/40">...</span>
            <button type="button" class="w-9 h-9 text-sm font-medium rounded-xl text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5">{{ $total }}</button>
        @endif

        <button
            type="button"
            @disabled($current >= $total)
            class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-xl border border-border dark:border-white/10 text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5 disabled:opacity-40 disabled:cursor-not-allowed transition-colors"
        >
            Next
            <x-ui.icon name="chevron-right" class="w-4 h-4" />
        </button>
    </nav>
</div>
