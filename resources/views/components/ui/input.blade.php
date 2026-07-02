@props([
    'label' => null,
    'name' => '',
    'type' => 'text',
    'error' => null,
    'success' => false,
    'hint' => null,
    'required' => false,
])

@php
    $inputId = $attributes->get('id', $name ?: 'input-' . uniqid());

    $inputClasses = 'block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border rounded-xl transition-all duration-200 placeholder:text-secondary/40 dark:placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-offset-0 disabled:opacity-50 disabled:cursor-not-allowed';

    if ($error) {
        $inputClasses .= ' border-danger focus:border-danger focus:ring-danger/20';
    } elseif ($success) {
        $inputClasses .= ' border-success focus:border-success focus:ring-success/20';
    } else {
        $inputClasses .= ' border-border dark:border-white/10 focus:border-primary focus:ring-primary/20 hover:border-primary/30';
    }
@endphp

<div {{ $attributes->only('class')->merge(['class' => 'w-full']) }}>
    @if ($label)
        <x-ui.label :for="$inputId" :required="$required">{{ $label }}</x-ui.label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $inputId }}"
        @if ($required) required aria-required="true" @endif
        @if ($error) aria-invalid="true" aria-describedby="{{ $inputId }}-error" @endif
        {{ $attributes->except('class')->merge(['class' => $inputClasses]) }}
    />

    @if ($error)
        <x-ui.error-message :id="$inputId . '-error'" class="mt-1.5">{{ $error }}</x-ui.error-message>
    @elseif ($hint)
        <p class="mt-1.5 text-xs text-secondary/50 dark:text-white/50">{{ $hint }}</p>
    @endif
</div>
