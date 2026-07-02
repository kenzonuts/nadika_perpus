@props([
    'items' => [],
])

<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'hidden sm:flex items-center gap-1.5 text-sm min-w-0']) }}>
    @foreach ($items as $index => $item)
        @if ($index > 0)
            <x-ui.icon name="chevron-right" class="w-3.5 h-3.5 text-secondary/30 dark:text-white/30 shrink-0" />
        @endif

        @if (isset($item['href']) && !($item['active'] ?? false))
            <a href="{{ $item['href'] }}" class="text-secondary/50 dark:text-white/50 hover:text-primary dark:hover:text-primary-light transition-colors truncate">
                {{ $item['label'] }}
            </a>
        @else
            <span class="font-medium text-secondary dark:text-white truncate" @if ($item['active'] ?? false) aria-current="page" @endif>
                {{ $item['label'] }}
            </span>
        @endif
    @endforeach
</nav>
