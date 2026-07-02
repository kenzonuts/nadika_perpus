@props([
    'label' => null,
    'name' => '',
    'id' => null,
    'checked' => false,
    'required' => false,
])

@php
    $checkboxId = $id ?? $name ?: 'checkbox-' . uniqid();
@endphp

<label
    for="{{ $checkboxId }}"
    {{ $attributes->merge(['class' => 'relative inline-flex items-start gap-3 cursor-pointer group']) }}
>
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $checkboxId }}"
        value="1"
        @if ($checked) checked @endif
        @if ($required) required aria-required="true" @endif
        class="peer sr-only"
    />

    <span class="w-5 h-5 shrink-0 mt-0.5 border border-border dark:border-white/20 rounded-md bg-card dark:bg-secondary/50 transition-all duration-200 peer-focus-visible:ring-2 peer-focus-visible:ring-primary/20 peer-checked:bg-primary peer-checked:border-primary peer-disabled:opacity-50"></span>

    <span class="absolute left-0 top-0.5 w-5 h-5 flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity duration-200 pointer-events-none">
        <x-ui.icon name="check" class="w-3.5 h-3.5 text-white" />
    </span>

    @if ($label)
        <span class="text-sm text-secondary/70 dark:text-white/70 group-hover:text-secondary dark:group-hover:text-white transition-colors select-none leading-snug">
            {{ $label }}
        </span>
    @else
        <span class="text-sm text-secondary/70 dark:text-white/70 select-none leading-snug">{{ $slot }}</span>
    @endif
</label>
