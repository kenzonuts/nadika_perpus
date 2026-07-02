@props(['type' => 'category', 'label' => ''])

@php
    $variants = [
        'category' => 'default',
        'available' => 'success',
        'borrowed' => 'warning',
        'unavailable' => 'danger',
    ];
@endphp

<x-ui.badge :variant="$variants[$type] ?? 'neutral'" {{ $attributes }}>
    {{ $label ?: $slot }}
</x-ui.badge>
