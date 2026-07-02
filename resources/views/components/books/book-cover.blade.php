@props([
    'book' => [],
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'w-10 h-10 rounded-lg',
        'md' => 'w-12 h-12 rounded-xl',
        'lg' => 'w-24 h-32 rounded-xl',
        'xl' => 'w-full aspect-[3/4] rounded-2xl',
    ];
    $iconSizes = ['sm' => 'w-4 h-4', 'md' => 'w-5 h-5', 'lg' => 'w-8 h-8', 'xl' => 'w-12 h-12'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $iconClass = $iconSizes[$size] ?? $iconSizes['md'];
    $color = $book['color'] ?? 'from-primary to-primary-dark';
@endphp

<div {{ $attributes->merge(['class' => $sizeClass . ' bg-gradient-to-br ' . $color . ' flex items-center justify-center shrink-0 shadow-soft overflow-hidden']) }}>
    @if (!empty($book['cover_url']))
        <img src="{{ $book['cover_url'] }}" alt="{{ $book['title'] ?? 'Book cover' }}" class="w-full h-full object-cover" />
    @else
        <x-ui.icon name="book-open" class="{{ $iconClass }} text-white/90" />
    @endif
</div>
