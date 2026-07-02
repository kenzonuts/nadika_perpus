@props([
    'hover' => true,
    'padding' => 'p-6',
])

@php
    $classes = 'bg-card border border-border rounded-2xl shadow-soft transition-all duration-300 ' . $padding;

    if ($hover) {
        $classes .= ' hover:shadow-soft-lg hover:-translate-y-1';
    }
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
