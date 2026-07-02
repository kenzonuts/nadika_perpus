@php
    $steps = [
        [
            'number' => '01',
            'title' => 'Register',
            'description' => 'Create your account in seconds. Verify your identity and get instant access to the library catalog.',
            'icon' => 'user-group',
        ],
        [
            'number' => '02',
            'title' => 'Find Book',
            'description' => 'Search our extensive catalog with smart filters. Browse by category, author, or use our AI-powered recommendations.',
            'icon' => 'magnifying-glass',
        ],
        [
            'number' => '03',
            'title' => 'Borrow',
            'description' => 'Scan the QR code or click borrow. Your book is reserved instantly with automatic due date tracking.',
            'icon' => 'qr-code',
        ],
        [
            'number' => '04',
            'title' => 'Return',
            'description' => 'Return books at any drop-off point. Scan to confirm return and avoid late fees with smart reminders.',
            'icon' => 'arrow-path',
        ],
        [
            'number' => '05',
            'title' => 'Enjoy Reading',
            'description' => 'Track your reading history, get personalized recommendations, and build your digital bookshelf.',
            'icon' => 'book-open',
        ],
    ];
@endphp

<x-landing.section-header
    badge="How It Works"
    title="Five simple steps to get started"
    subtitle="From registration to return — experience a seamless library journey designed for modern users."
>
    <div class="relative">
        {{-- Timeline line --}}
        <div class="hidden lg:block absolute top-24 left-[10%] right-[10%] h-0.5 bg-border"></div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @foreach ($steps as $index => $step)
                <div class="relative group">
                    <x-ui.card class="text-center h-full">
                        {{-- Step Number --}}
                        <div class="relative inline-flex">
                            <div class="w-14 h-14 bg-primary text-white rounded-2xl flex items-center justify-center text-lg font-bold shadow-soft group-hover:shadow-soft-lg group-hover:scale-105 transition-all duration-300">
                                {{ $step['number'] }}
                            </div>
                            @if ($index < count($steps) - 1)
                                <div class="hidden lg:block absolute top-1/2 left-full w-full h-0.5 bg-primary/20 -translate-y-1/2"></div>
                            @endif
                        </div>

                        <div class="w-10 h-10 mx-auto mt-5 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <x-ui.icon :name="$step['icon']" class="w-5 h-5" />
                        </div>

                        <h3 class="mt-4 text-lg font-semibold text-secondary">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm text-secondary/60 leading-relaxed">{{ $step['description'] }}</p>
                    </x-ui.card>
                </div>
            @endforeach
        </div>
    </div>
</x-landing.section-header>
