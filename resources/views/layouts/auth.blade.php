<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    @include('partials.head')
</head>
<body class="font-sans h-full bg-background dark:bg-secondary antialiased">
    <div class="min-h-screen flex">
        <x-auth.branding-panel />

        <main class="flex-1 flex flex-col items-center justify-center px-4 py-8 sm:px-6 lg:px-12 relative">
            {{-- Mobile logo --}}
            <div class="lg:hidden mb-8 flex items-center gap-2.5 animate-fade-in">
                <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-soft">
                    <x-ui.icon name="book-open" class="w-5 h-5 text-white" />
                </div>
                <span class="text-lg font-semibold text-secondary dark:text-white">Smart Library</span>
            </div>

            {{-- Back to home link --}}
            <a
                href="{{ url('/') }}"
                class="absolute top-6 left-6 lg:top-8 lg:left-8 inline-flex items-center gap-1.5 text-sm text-secondary/50 dark:text-white/50 hover:text-primary dark:hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20 rounded-lg px-2 py-1"
            >
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                Back to home
            </a>

            @yield('content')
        </main>
    </div>

    @include('partials.scripts')
</body>
</html>
