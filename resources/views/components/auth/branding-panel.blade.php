<aside
    {{ $attributes->merge(['class' => 'relative hidden lg:flex lg:w-1/2 xl:w-[55%] flex-col justify-between overflow-hidden bg-primary']) }}
    aria-hidden="true"
>
    {{-- Animated background shapes --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/5 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl animate-float-slow"></div>

        {{-- Grid pattern --}}
        <svg class="absolute inset-0 w-full h-full opacity-[0.07]" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="auth-grid" width="32" height="32" patternUnits="userSpaceOnUse">
                    <path d="M 32 0 L 0 0 0 32" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#auth-grid)"/>
        </svg>
    </div>

    <div class="relative z-10 flex flex-col h-full p-10 xl:p-14">
        {{-- Logo & Brand --}}
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20">
                <x-ui.icon name="book-open" class="w-6 h-6 text-white" />
            </div>
            <div>
                <p class="text-lg font-semibold text-white">Smart Secure Library</p>
                <p class="text-xs text-white/60">Management System</p>
            </div>
        </div>

        {{-- Headline --}}
        <div class="flex-1 flex flex-col justify-center max-w-lg py-12">
            <h2 class="text-3xl xl:text-4xl font-bold text-white leading-tight tracking-tight">
                Manage Your Digital Library Securely
            </h2>
            <p class="mt-4 text-base text-white/70 leading-relaxed">
                Streamline book management, member access, and borrowing workflows with enterprise-grade security built for modern institutions.
            </p>

            <ul class="mt-8 space-y-3">
                @foreach (['Secure Authentication', 'Real-time Dashboard', 'OWASP Security'] as $feature)
                    <li class="flex items-center gap-3 text-sm text-white/80">
                        <span class="w-5 h-5 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                            <x-ui.icon name="check" class="w-3 h-3 text-white" />
                        </span>
                        {{ $feature }}
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Dashboard Preview Illustration --}}
        <div class="relative">
            <div class="glass rounded-2xl p-5 border border-white/20 shadow-soft-xl">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-white/20 rounded-lg flex items-center justify-center">
                            <x-ui.icon name="chart-bar" class="w-4 h-4 text-white" />
                        </div>
                        <span class="text-sm font-medium text-white">Library Overview</span>
                    </div>
                    <div class="flex gap-1">
                        <div class="w-2 h-2 rounded-full bg-white/40"></div>
                        <div class="w-2 h-2 rounded-full bg-white/40"></div>
                        <div class="w-2 h-2 rounded-full bg-white/40"></div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 mb-4">
                    <div class="bg-white/10 rounded-lg p-2.5 text-center">
                        <p class="text-lg font-bold text-white">12.8K</p>
                        <p class="text-[10px] text-white/50">Books</p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-2.5 text-center">
                        <p class="text-lg font-bold text-white">3.4K</p>
                        <p class="text-[10px] text-white/50">Members</p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-2.5 text-center">
                        <p class="text-lg font-bold text-white">892</p>
                        <p class="text-[10px] text-white/50">Borrowed</p>
                    </div>
                </div>

                <div class="flex items-end gap-1 h-16">
                    @foreach ([35, 55, 40, 70, 50, 85, 60, 90, 65, 80] as $h)
                        <div class="flex-1 bg-white/20 rounded-t-sm" style="height: {{ $h }}%"></div>
                    @endforeach
                </div>
            </div>

            {{-- Floating stat cards --}}
            <div class="absolute -top-4 -right-4 glass rounded-xl px-3 py-2 animate-float hidden xl:block">
                <p class="text-[10px] text-white/60">Active Now</p>
                <p class="text-sm font-bold text-white">247 users</p>
            </div>
            <div class="absolute -bottom-3 -left-3 glass rounded-xl px-3 py-2 animate-float-delayed hidden xl:block">
                <p class="text-[10px] text-white/60">Return Rate</p>
                <p class="text-sm font-bold text-white">98.5%</p>
            </div>
        </div>
    </div>
</aside>
