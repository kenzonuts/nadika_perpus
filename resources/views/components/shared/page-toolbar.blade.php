@props([
    'title' => '',
    'subtitle' => null,
    'backUrl' => null,
    'backLabel' => 'Back',
])

<div {{ $attributes->merge(['class' => 'flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-up']) }}>
    <div>
        @if ($backUrl)
            <a href="{{ $backUrl }}" class="inline-flex items-center gap-1.5 text-sm text-secondary/50 dark:text-white/50 hover:text-primary mb-2 transition-colors">
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                {{ $backLabel }}
            </a>
        @endif
        <h1 class="text-2xl lg:text-3xl font-bold text-secondary dark:text-white tracking-tight">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">{{ $subtitle }}</p>
        @endif
    </div>
    @if ($slot->isNotEmpty())
        <div class="flex flex-wrap items-center gap-2 shrink-0">{{ $slot }}</div>
    @endif
</div>
