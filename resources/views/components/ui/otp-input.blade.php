@props([
    'name' => 'code',
    'length' => 6,
])

<div
    x-data="otpInput({{ $length }})"
    {{ $attributes->merge(['class' => 'w-full']) }}
>
    <input type="hidden" name="{{ $name }}" :value="value" />

    <div
        class="flex justify-center gap-2 sm:gap-3"
        role="group"
        aria-label="One-time password digits"
        x-ref="otpGroup"
    >
        @for ($i = 0; $i < $length; $i++)
            <input
                type="text"
                inputmode="numeric"
                maxlength="1"
                pattern="[0-9]"
                autocomplete="one-time-code"
                class="w-11 h-14 sm:w-12 sm:h-14 text-center text-lg font-semibold text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl transition-all duration-200 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 hover:border-primary/30 disabled:opacity-50"
                x-model="digits[{{ $i }}]"
                @input="handleInput($event, {{ $i }})"
                @keydown="handleKeydown($event, {{ $i }})"
                @paste.prevent="handlePaste($event)"
                @focus="$event.target.select()"
                aria-label="Digit {{ $i + 1 }} of {{ $length }}"
            />
        @endfor
    </div>
</div>
