@php
    $securityFeatures = [
        ['icon' => 'shield-check', 'title' => 'CSRF Protection', 'description' => 'Cross-site request forgery prevention on all forms'],
        ['icon' => 'lock-closed', 'title' => 'SQL Injection Prevention', 'description' => 'Parameterized queries and ORM protection'],
        ['icon' => 'bolt', 'title' => 'XSS Protection', 'description' => 'Input sanitization and output encoding'],
        ['icon' => 'user-group', 'title' => 'Role Based Access', 'description' => 'Granular permissions for every user role'],
        ['icon' => 'clipboard-document-list', 'title' => 'Audit Log', 'description' => 'Complete activity tracking and logging'],
        ['icon' => 'cloud-arrow-up', 'title' => 'Secure Upload', 'description' => 'Validated file uploads with virus scanning'],
        ['icon' => 'clock', 'title' => 'Rate Limiting', 'description' => 'API and login attempt throttling'],
    ];
@endphp

<section id="about" class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-secondary rounded-3xl overflow-hidden shadow-soft-xl">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-5">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)"/>
                </svg>
            </div>

            <div class="relative grid lg:grid-cols-2 gap-12 p-8 sm:p-12 lg:p-16 items-center">
                {{-- Left: Shield Illustration --}}
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-48 h-48 sm:w-64 sm:h-64 bg-primary/20 rounded-full flex items-center justify-center">
                            <div class="w-36 h-36 sm:w-48 sm:h-48 bg-primary/30 rounded-full flex items-center justify-center animate-pulse">
                                <div class="w-24 h-24 sm:w-32 sm:h-32 bg-primary rounded-3xl flex items-center justify-center shadow-soft-xl">
                                    <x-ui.icon name="shield-check" class="w-16 h-16 sm:w-20 sm:h-20 text-white" />
                                </div>
                            </div>
                        </div>

                        {{-- Floating security badges --}}
                        <div class="absolute -top-2 -right-4 glass-dark rounded-xl px-3 py-2 text-xs text-white/80 animate-float">
                            OWASP Compliant
                        </div>
                        <div class="absolute -bottom-2 -left-4 glass-dark rounded-xl px-3 py-2 text-xs text-white/80 animate-float-delayed">
                            256-bit Encryption
                        </div>
                    </div>
                </div>

                {{-- Right: Content --}}
                <div>
                    <x-ui.badge variant="success" class="mb-4 bg-success/20 text-success border-success/30">
                        Enterprise Security
                    </x-ui.badge>

                    <h2 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">
                        Built using OWASP Security Principles
                    </h2>

                    <p class="mt-4 text-lg text-white/60 leading-relaxed">
                        Your library data deserves the highest level of protection. Our platform is built from the ground up with security-first architecture.
                    </p>

                    <div class="mt-8 grid sm:grid-cols-2 gap-4">
                        @foreach ($securityFeatures as $feature)
                            <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white/5 transition-colors duration-200">
                                <div class="w-8 h-8 bg-primary/20 rounded-lg flex items-center justify-center shrink-0">
                                    <x-ui.icon :name="$feature['icon']" class="w-4 h-4 text-primary" />
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $feature['title'] }}</p>
                                    <p class="text-xs text-white/50 mt-0.5">{{ $feature['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
