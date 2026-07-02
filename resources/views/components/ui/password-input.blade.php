@props([
    'label' => 'Password',
    'name' => 'password',
    'error' => null,
    'hint' => null,
    'required' => false,
])

@php
    $inputId = $attributes->get('id', $name);
@endphp

<div
    x-data="{ show: false }"
    {{ $attributes->only('class')->merge(['class' => 'w-full']) }}
>
    @if ($label)
        <x-ui.label :for="$inputId" :required="$required">{{ $label }}</x-ui.label>
    @endif

    <div class="relative">
        <input
            :type="show ? 'text' : 'password'"
            name="{{ $name }}"
            id="{{ $inputId }}"
            @if ($required) required aria-required="true" @endif
            @if ($error) aria-invalid="true" aria-describedby="{{ $inputId }}-error" @endif
            {{ $attributes->except('class')->merge([
                'class' => 'block w-full px-4 py-3 pr-12 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border rounded-xl transition-all duration-200 placeholder:text-secondary/40 dark:placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-offset-0 disabled:opacity-50 disabled:cursor-not-allowed ' . ($error ? 'border-danger focus:border-danger focus:ring-danger/20' : 'border-border dark:border-white/10 focus:border-primary focus:ring-primary/20 hover:border-primary/30'),
                'autocomplete' => 'current-password',
            ]) }}
        />

        <button
            type="button"
            @click="show = !show"
            class="absolute right-3 top-1/2 -translate-y-1/2 p-1 text-secondary/40 hover:text-secondary dark:text-white/40 dark:hover:text-white/70 transition-colors rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20"
            :aria-label="show ? 'Hide password' : 'Show password'"
        >
            <x-ui.icon x-show="!show" name="eye" class="w-5 h-5" />
            <x-ui.icon x-show="show" x-cloak name="eye-slash" class="w-5 h-5" />
        </button>
    </div>

    @if ($error)
        <x-ui.error-message :id="$inputId . '-error'" class="mt-1.5">{{ $error }}</x-ui.error-message>
    @elseif ($hint)
        <p class="mt-1.5 text-xs text-secondary/50 dark:text-white/50">{{ $hint }}</p>
    @endif
</div>
