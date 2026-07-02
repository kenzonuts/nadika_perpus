@props(['title' => '', 'description' => null])

<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft']) }}>
    @if ($title)
        <div class="mb-6">
            <h2 class="text-base font-semibold text-secondary dark:text-white">{{ $title }}</h2>
            @if ($description)
                <p class="mt-1 text-sm text-secondary/50 dark:text-white/50">{{ $description }}</p>
            @endif
        </div>
    @endif
    {{ $slot }}
</div>
