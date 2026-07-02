@props([
    'title' => '',
    'value' => '',
    'icon' => 'chart-bar',
    'trend' => null,
    'trendUp' => true,
    'color' => 'primary',
])

@php
    $colorClasses = [
        'primary' => 'bg-primary/10 text-primary dark:bg-primary/20',
        'success' => 'bg-success/10 text-success dark:bg-success/20',
        'warning' => 'bg-warning/10 text-warning dark:bg-warning/20',
        'danger' => 'bg-danger/10 text-danger dark:bg-danger/20',
    ];
    $iconBg = $colorClasses[$color] ?? $colorClasses['primary'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-5 shadow-soft hover:shadow-soft-lg hover:-translate-y-0.5 transition-all duration-300 group']) }}>
    <div class="flex items-start justify-between">
        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ $iconBg }} transition-transform duration-300 group-hover:scale-110">
            <x-ui.icon :name="$icon" class="w-5 h-5" />
        </div>

        @if ($trend)
            <span class="inline-flex items-center gap-0.5 text-xs font-medium px-2 py-1 rounded-full {{ $trendUp ? 'bg-success/10 text-success' : 'bg-danger/10 text-danger' }}">
                <x-ui.icon :name="$trendUp ? 'arrow-right' : 'arrow-left'" class="w-3 h-3 {{ $trendUp ? '-rotate-90' : 'rotate-90' }}" />
                {{ $trend }}
            </span>
        @endif
    </div>

    <div class="mt-4">
        <p class="text-2xl lg:text-3xl font-bold text-secondary dark:text-white">{{ $value }}</p>
        <p class="mt-1 text-sm text-secondary/50 dark:text-white/50">{{ $title }}</p>
    </div>

    {{-- Mini chart placeholder --}}
    <div class="mt-4 flex items-end gap-0.5 h-8">
        @foreach ([40, 65, 45, 80, 55, 90, 70] as $h)
            <div class="flex-1 bg-primary/15 dark:bg-primary/25 rounded-sm group-hover:bg-primary/25 transition-colors" style="height: {{ $h }}%"></div>
        @endforeach
    </div>
</div>
