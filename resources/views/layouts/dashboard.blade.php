<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    @include('partials.head')
</head>
<body class="font-sans h-full bg-background dark:bg-secondary antialiased" x-data="dashboard">
    {{-- Mobile sidebar overlay --}}
    <div
        x-show="mobileSidebarOpen"
        x-cloak
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-secondary/50 dark:bg-black/60 backdrop-blur-sm z-40 lg:hidden"
        @click="closeMobileSidebar()"
        aria-hidden="true"
    ></div>

    <div class="flex min-h-screen">
        <x-dashboard.sidebar />

        <div class="flex-1 flex flex-col min-w-0">
            <x-dashboard.top-navbar>
                @hasSection('breadcrumb')
                    @yield('breadcrumb')
                @else
                    <x-dashboard.breadcrumb :items="[['label' => 'Dashboard', 'active' => true]]" />
                @endif
            </x-dashboard.top-navbar>

            <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    @include('partials.scripts')
    @stack('scripts')
</body>
</html>
