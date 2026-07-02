<section id="home" class="relative pt-28 lg:pt-36 pb-20 lg:pb-32 overflow-hidden">
    {{-- Background decoration --}}
    <div class="absolute inset-0 -z-10">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-primary/3 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Left Content --}}
            <div class="animate-fade-up">
                <x-ui.badge class="mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                    Modern Digital Library
                </x-ui.badge>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-secondary leading-[1.1] tracking-tight">
                    Smart Secure Library
                    <span class="text-primary">Management System</span>
                </h1>

                <p class="mt-6 text-lg text-secondary/60 leading-relaxed max-w-xl">
                    Transform your library into a modern, secure digital experience. Manage books, members, and borrowing with enterprise-grade security and blazing-fast performance.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <x-ui.button variant="primary" size="lg" href="#register">
                        Get Started
                        <x-ui.icon name="arrow-right" class="w-4 h-4" />
                    </x-ui.button>
                    <x-ui.button variant="outline" size="lg" href="#demo">
                        <x-ui.icon name="play" class="w-4 h-4" />
                        Watch Demo
                    </x-ui.button>
                </div>

                {{-- Security Badges --}}
                <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach (['Secure Authentication', 'QR Borrowing', 'Fast Search', 'Activity Monitoring'] as $badge)
                        <div class="flex items-center gap-2 text-sm text-secondary/70">
                            <x-ui.icon name="check-circle" class="w-4 h-4 text-success shrink-0" />
                            <span>{{ $badge }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Dashboard Mockup --}}
            <div class="relative animate-fade-up [animation-delay:0.2s]">
                {{-- Main Dashboard Card --}}
                <div class="relative bg-card border border-border rounded-2xl shadow-soft-xl p-1">
                    <div class="bg-background rounded-xl p-6">
                        {{-- Mock Header --}}
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <x-ui.icon name="chart-bar" class="w-4 h-4 text-primary" />
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-secondary">Dashboard</p>
                                    <p class="text-xs text-secondary/50">Library Overview</p>
                                </div>
                            </div>
                            <div class="flex gap-1.5">
                                <div class="w-3 h-3 rounded-full bg-danger/60"></div>
                                <div class="w-3 h-3 rounded-full bg-warning/60"></div>
                                <div class="w-3 h-3 rounded-full bg-success/60"></div>
                            </div>
                        </div>

                        {{-- Mock Stats Row --}}
                        <div class="grid grid-cols-3 gap-3 mb-6">
                            <div class="bg-card rounded-xl p-3 border border-border">
                                <p class="text-lg font-bold text-primary">2,847</p>
                                <p class="text-xs text-secondary/50">Books</p>
                            </div>
                            <div class="bg-card rounded-xl p-3 border border-border">
                                <p class="text-lg font-bold text-success">1,234</p>
                                <p class="text-xs text-secondary/50">Members</p>
                            </div>
                            <div class="bg-card rounded-xl p-3 border border-border">
                                <p class="text-lg font-bold text-warning">156</p>
                                <p class="text-xs text-secondary/50">Borrowed</p>
                            </div>
                        </div>

                        {{-- Mock Chart --}}
                        <div class="bg-card rounded-xl p-4 border border-border">
                            <div class="flex items-end justify-between gap-2 h-32">
                                @foreach ([40, 65, 45, 80, 55, 90, 70, 85, 60, 95, 75, 88] as $height)
                                    <div
                                        class="flex-1 bg-primary/20 rounded-t-md hover:bg-primary/40 transition-colors duration-300"
                                        style="height: {{ $height }}%"
                                    ></div>
                                @endforeach
                            </div>
                            <div class="flex justify-between mt-3 text-xs text-secondary/40">
                                <span>Jan</span>
                                <span>Jun</span>
                                <span>Dec</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Floating Card: Active Users --}}
                <div class="absolute -left-4 top-8 animate-float hidden sm:block">
                    <div class="glass rounded-xl p-4 shadow-soft-lg min-w-[180px]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-success/10 rounded-xl flex items-center justify-center">
                                <x-ui.icon name="users" class="w-5 h-5 text-success" />
                            </div>
                            <div>
                                <p class="text-xs text-secondary/50">Active Users</p>
                                <p class="text-lg font-bold text-secondary">847</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Floating Card: Books Borrowed --}}
                <div class="absolute -right-4 bottom-16 animate-float-delayed hidden sm:block">
                    <div class="glass rounded-xl p-4 shadow-soft-lg min-w-[180px]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                                <x-ui.icon name="book-open" class="w-5 h-5 text-primary" />
                            </div>
                            <div>
                                <p class="text-xs text-secondary/50">Borrowed Today</p>
                                <p class="text-lg font-bold text-secondary">42</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Floating Card: Return Rate --}}
                <div class="absolute right-8 -bottom-4 animate-float-slow hidden md:block">
                    <div class="glass rounded-xl p-4 shadow-soft-lg min-w-[160px]">
                        <div class="flex items-center gap-2">
                            <x-ui.icon name="check-circle" class="w-5 h-5 text-success" />
                            <div>
                                <p class="text-xs text-secondary/50">Return Rate</p>
                                <p class="text-sm font-bold text-success">98.5%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
