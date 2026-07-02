<section id="demo" class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Left: Screenshot Placeholder --}}
            <div class="relative order-2 lg:order-1">
                <div class="relative bg-card border border-border rounded-2xl shadow-soft-xl overflow-hidden">
                    {{-- Browser Chrome --}}
                    <div class="flex items-center gap-2 px-4 py-3 bg-background border-b border-border">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-danger/60"></div>
                            <div class="w-3 h-3 rounded-full bg-warning/60"></div>
                            <div class="w-3 h-3 rounded-full bg-success/60"></div>
                        </div>
                        <div class="flex-1 mx-4">
                            <div class="bg-card rounded-lg px-4 py-1.5 text-xs text-secondary/40 text-center border border-border">
                                app.smartlibrary.io/dashboard
                            </div>
                        </div>
                    </div>

                    {{-- Dashboard Content Mock --}}
                    <div class="p-6 bg-background">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h4 class="text-sm font-semibold text-secondary">Library Dashboard</h4>
                                <p class="text-xs text-secondary/50">Welcome back, Admin</p>
                            </div>
                            <div class="px-3 py-1 bg-success/10 text-success text-xs font-medium rounded-full">Live</div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mb-6">
                            <div class="bg-card rounded-xl p-4 border border-border">
                                <p class="text-xs text-secondary/50">Books</p>
                                <p class="text-xl font-bold text-primary mt-1">12,847</p>
                            </div>
                            <div class="bg-card rounded-xl p-4 border border-border">
                                <p class="text-xs text-secondary/50">Members</p>
                                <p class="text-xl font-bold text-success mt-1">3,456</p>
                            </div>
                            <div class="bg-card rounded-xl p-4 border border-border">
                                <p class="text-xs text-secondary/50">Borrowed</p>
                                <p class="text-xl font-bold text-warning mt-1">892</p>
                            </div>
                            <div class="bg-card rounded-xl p-4 border border-border">
                                <p class="text-xs text-secondary/50">Overdue</p>
                                <p class="text-xl font-bold text-danger mt-1">23</p>
                            </div>
                        </div>

                        <div class="bg-card rounded-xl p-4 border border-border">
                            <p class="text-xs font-medium text-secondary mb-3">Recent Activity</p>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-primary"></div>
                                        <span class="text-secondary/70">John borrowed "Clean Code"</span>
                                    </div>
                                    <span class="text-secondary/40">2 min ago</span>
                                </div>
                                <div class="flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-success"></div>
                                        <span class="text-secondary/70">Sarah returned "Design Patterns"</span>
                                    </div>
                                    <span class="text-secondary/40">15 min ago</span>
                                </div>
                                <div class="flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-warning"></div>
                                        <span class="text-secondary/70">New member registered</span>
                                    </div>
                                    <span class="text-secondary/40">1 hour ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Decorative element --}}
                <div class="absolute -z-10 -bottom-6 -right-6 w-full h-full bg-primary/5 rounded-2xl"></div>
            </div>

            {{-- Right: Explanation --}}
            <div class="order-1 lg:order-2">
                <x-ui.badge class="mb-4">Dashboard Preview</x-ui.badge>
                <h2 class="text-3xl sm:text-4xl font-bold text-secondary tracking-tight">
                    Powerful insights at your fingertips
                </h2>
                <p class="mt-4 text-lg text-secondary/60 leading-relaxed">
                    Get a complete overview of your library operations with our intuitive dashboard. Track borrowing trends, monitor member activity, and make data-driven decisions.
                </p>

                <ul class="mt-8 space-y-4">
                    @foreach ([
                        'Real-time borrowing and return tracking',
                        'Member activity and engagement analytics',
                        'Automated overdue notifications and reminders',
                        'Customizable widgets and report generation',
                        'Export data in multiple formats',
                    ] as $item)
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-primary/10 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <x-ui.icon name="check" class="w-3.5 h-3.5 text-primary" />
                            </div>
                            <span class="text-secondary/70">{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-8">
                    <x-ui.button variant="primary" size="lg" href="#register">
                        Explore Dashboard
                        <x-ui.icon name="arrow-right" class="w-4 h-4" />
                    </x-ui.button>
                </div>
            </div>
        </div>
    </div>
</section>
