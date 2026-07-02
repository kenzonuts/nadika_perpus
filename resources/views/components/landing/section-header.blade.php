@props([
    'title' => null,
    'subtitle' => null,
    'badge' => null,
    'centered' => true,
])

<section {{ $attributes->merge(['class' => 'py-20 lg:py-28']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($title || $subtitle || $badge)
            <div class="{{ $centered ? 'text-center max-w-3xl mx-auto' : '' }} mb-16">
                @if ($badge)
                    <x-ui.badge class="mb-4">{{ $badge }}</x-ui.badge>
                @endif

                @if ($title)
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-secondary tracking-tight">
                        {{ $title }}
                    </h2>
                @endif

                @if ($subtitle)
                    <p class="mt-4 text-lg text-secondary/60 leading-relaxed">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>
        @endif

        {{ $slot }}
    </div>
</section>
