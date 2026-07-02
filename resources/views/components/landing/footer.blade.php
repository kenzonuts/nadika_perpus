<footer class="bg-secondary text-white/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Main Footer --}}
        <div class="py-16 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 lg:gap-12">
            {{-- Brand --}}
            <div class="col-span-2 md:col-span-4 lg:col-span-1">
                <a href="#home" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center">
                        <x-ui.icon name="book-open" class="w-5 h-5 text-white" />
                    </div>
                    <span class="text-lg font-semibold text-white">Smart Library</span>
                </a>
                <p class="mt-4 text-sm leading-relaxed">
                    Modern digital library management for institutions that demand security, speed, and exceptional user experience.
                </p>

                {{-- Social Media --}}
                <div class="flex gap-3 mt-6">
                    @foreach (['twitter', 'github', 'linkedin'] as $social)
                        <a
                            href="#"
                            class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center hover:bg-primary transition-colors duration-200"
                            aria-label="{{ ucfirst($social) }}"
                        >
                            @if ($social === 'twitter')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            @elseif ($social === 'github')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0 0 22 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                            @else
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Navigation --}}
            <div>
                <h4 class="text-sm font-semibold text-white mb-4">Navigation</h4>
                <ul class="space-y-3">
                    @foreach (['Home', 'Features', 'Books', 'About', 'Contact'] as $link)
                        <li>
                            <a href="#{{ strtolower($link) }}" class="text-sm hover:text-white transition-colors duration-200">
                                {{ $link }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Resources --}}
            <div>
                <h4 class="text-sm font-semibold text-white mb-4">Resources</h4>
                <ul class="space-y-3">
                    @foreach (['Documentation', 'API Reference', 'Blog', 'Changelog'] as $link)
                        <li>
                            <a href="#" class="text-sm hover:text-white transition-colors duration-200">
                                {{ $link }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Support --}}
            <div>
                <h4 class="text-sm font-semibold text-white mb-4">Support</h4>
                <ul class="space-y-3">
                    @foreach (['Help Center', 'Community', 'Status', 'Privacy Policy'] as $link)
                        <li>
                            <a href="#" class="text-sm hover:text-white transition-colors duration-200">
                                {{ $link }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="py-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm">
                &copy; {{ date('Y') }} Smart Secure Library Management System. All rights reserved.
            </p>
            <div class="flex gap-6 text-sm">
                <a href="#" class="hover:text-white transition-colors duration-200">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors duration-200">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors duration-200">Cookies</a>
            </div>
        </div>
    </div>
</footer>
