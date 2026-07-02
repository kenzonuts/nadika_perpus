@props([
    'title' => null,
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'w-full max-w-[480px] animate-fade-up']) }}>
    <div class="bg-card/80 dark:bg-secondary/80 backdrop-blur-xl border border-border/50 dark:border-white/10 rounded-3xl shadow-soft-xl p-8 sm:p-10">
        @if ($title || $subtitle)
            <div class="mb-8 text-center sm:text-left">
                @if ($title)
                    <h1 class="text-2xl font-bold text-secondary dark:text-white tracking-tight">{{ $title }}</h1>
                @endif
                @if ($subtitle)
                    <p class="mt-2 text-sm text-secondary/60 dark:text-white/60 leading-relaxed">{{ $subtitle }}</p>
                @endif
            </div>
        @endif

        {{ $slot }}
    </div>
</div>
