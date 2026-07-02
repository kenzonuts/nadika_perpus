@props(['status' => 'published'])

@php
    $config = [
        'published' => ['label' => 'Published', 'variant' => 'success'],
        'draft' => ['label' => 'Draft', 'variant' => 'warning'],
        'archived' => ['label' => 'Archived', 'variant' => 'neutral'],
    ];
    $item = $config[$status] ?? $config['published'];
@endphp

<x-ui.badge :variant="$item['variant']" {{ $attributes }}>{{ $item['label'] }}</x-ui.badge>
