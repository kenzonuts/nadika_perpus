@props([
    'loading' => false,
    'loadingText' => null,
])

<x-ui.button
    type="submit"
    variant="primary"
    class="w-full relative overflow-hidden group"
    x-bind:disabled="loading"
    {{ $attributes }}
>
    <span x-show="!loading" class="inline-flex items-center justify-center gap-2">
        {{ $slot }}
    </span>
    <span x-show="loading" x-cloak class="inline-flex items-center justify-center gap-2">
        <x-ui.spinner size="sm" class="text-white" />
        {{ $loadingText ?? $slot }}
    </span>
</x-ui.button>
