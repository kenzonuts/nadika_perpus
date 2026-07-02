@php
    $features = [
        [
            'icon' => 'shield-check',
            'title' => 'Secure Authentication',
            'description' => 'Enterprise-grade authentication with multi-factor support, session management, and secure password policies.',
            'color' => 'primary',
        ],
        [
            'icon' => 'qr-code',
            'title' => 'QR Borrowing',
            'description' => 'Streamline book checkout with QR code scanning. Fast, contactless, and error-free borrowing experience.',
            'color' => 'success',
        ],
        [
            'icon' => 'chart-bar',
            'title' => 'Real-time Dashboard',
            'description' => 'Monitor library activity in real-time with intuitive analytics, charts, and actionable insights.',
            'color' => 'warning',
        ],
        [
            'icon' => 'user-group',
            'title' => 'Role Permission',
            'description' => 'Granular role-based access control for admins, librarians, and members with custom permissions.',
            'color' => 'primary',
        ],
        [
            'icon' => 'magnifying-glass',
            'title' => 'Fast Search',
            'description' => 'Lightning-fast full-text search across books, authors, categories, and ISBN with smart filters.',
            'color' => 'success',
        ],
        [
            'icon' => 'document-arrow-down',
            'title' => 'Export Report',
            'description' => 'Generate comprehensive reports in PDF, Excel, or CSV. Schedule automated exports effortlessly.',
            'color' => 'warning',
        ],
    ];

    $colorMap = [
        'primary' => 'bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white',
        'success' => 'bg-success/10 text-success group-hover:bg-success group-hover:text-white',
        'warning' => 'bg-warning/10 text-warning group-hover:bg-warning group-hover:text-white',
    ];
@endphp

<x-landing.section-header
    id="features"
    badge="Features"
    title="Everything you need to run a modern library"
    subtitle="Powerful tools designed for security, speed, and simplicity. Built for libraries that demand excellence."
>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($features as $feature)
            <x-ui.card class="group">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-all duration-300 {{ $colorMap[$feature['color']] }}">
                    <x-ui.icon :name="$feature['icon']" class="w-6 h-6" />
                </div>
                <h3 class="mt-5 text-lg font-semibold text-secondary">{{ $feature['title'] }}</h3>
                <p class="mt-2 text-sm text-secondary/60 leading-relaxed">{{ $feature['description'] }}</p>
            </x-ui.card>
        @endforeach
    </div>
</x-landing.section-header>
