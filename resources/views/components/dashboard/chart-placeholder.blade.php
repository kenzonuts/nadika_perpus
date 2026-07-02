@props([
    'title' => 'Monthly Overview',
    'subtitle' => 'Borrowing activity over time',
])

<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft']) }}>
    <div class="flex items-start justify-between mb-6">
        <div>
            <h3 class="text-base font-semibold text-secondary dark:text-white">{{ $title }}</h3>
            @if ($subtitle)
                <p class="mt-1 text-sm text-secondary/50 dark:text-white/50">{{ $subtitle }}</p>
            @endif
        </div>
        <x-ui.badge variant="neutral">Chart.js Ready</x-ui.badge>
    </div>

    {{-- Chart placeholder --}}
    <div
        class="relative h-64 bg-background dark:bg-white/5 border border-dashed border-border dark:border-white/10 rounded-xl flex items-center justify-center"
        data-chart-placeholder
        role="img"
        aria-label="Chart placeholder for monthly borrowing data"
    >
        <div class="absolute inset-4 flex items-end justify-between gap-2">
            @foreach ([30, 45, 35, 60, 50, 75, 55, 80, 65, 90, 70, 85] as $h)
                <div class="flex-1 bg-primary/20 dark:bg-primary/30 rounded-t-md hover:bg-primary/40 transition-colors" style="height: {{ $h }}%"></div>
            @endforeach
        </div>

        <div class="relative z-10 text-center px-4 py-3 bg-card/90 dark:bg-secondary/90 backdrop-blur-sm rounded-xl border border-border dark:border-white/10">
            <x-ui.icon name="chart-bar" class="w-6 h-6 text-primary mx-auto mb-2" />
            <p class="text-sm font-medium text-secondary dark:text-white">Chart.js Integration Point</p>
            <p class="text-xs text-secondary/50 dark:text-white/50 mt-1">Connect your data source to render live charts</p>
        </div>
    </div>
</div>
