@props([
    'for' => null,
    'required' => false,
])

<label
    @if ($for) for="{{ $for }}" @endif
    {{ $attributes->merge(['class' => 'block text-sm font-medium text-secondary dark:text-white/90 mb-1.5']) }}
>
    {{ $slot }}
    @if ($required)
        <span class="text-danger ml-0.5" aria-hidden="true">*</span>
    @endif
</label>
