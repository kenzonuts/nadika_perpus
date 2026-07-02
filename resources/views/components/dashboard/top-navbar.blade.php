<header class="sticky top-0 z-40 glass dark:bg-secondary/80 border-b border-border/50 dark:border-white/10">
    <div class="flex items-center justify-between h-16 px-4 lg:px-6 gap-4">
        {{-- Left: Mobile menu + Breadcrumb --}}
        <div class="flex items-center gap-3 min-w-0">
            <button
                type="button"
                @click="toggleMobileSidebar()"
                class="lg:hidden p-2 rounded-xl text-secondary/60 dark:text-white/60 hover:bg-background dark:hover:bg-white/5 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20"
                aria-label="Toggle sidebar"
            >
                <x-ui.icon name="bars-3" class="w-5 h-5" />
            </button>

            {{ $breadcrumb ?? $slot }}
        </div>

        {{-- Center: Search (desktop) --}}
        <x-dashboard.search />

        {{-- Right: Actions --}}
        <div class="flex items-center gap-1 sm:gap-2 shrink-0">
            {{-- Mobile search --}}
            <button
                type="button"
                @click="toggleSearch()"
                class="md:hidden p-2 rounded-xl text-secondary/60 dark:text-white/60 hover:bg-background dark:hover:bg-white/5 transition-colors"
                aria-label="Search"
            >
                <x-ui.icon name="magnifying-glass" class="w-5 h-5" />
            </button>

            {{-- Quick Action --}}
            <x-ui.button variant="primary" size="sm" class="hidden sm:inline-flex">
                <x-ui.icon name="plus" class="w-4 h-4" />
                <span class="hidden lg:inline">Quick Action</span>
            </x-ui.button>

            {{-- Dark mode toggle --}}
            <button
                type="button"
                @click="toggleDarkMode()"
                class="p-2 rounded-xl text-secondary/60 dark:text-white/60 hover:bg-background dark:hover:bg-white/5 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20"
                :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
            >
                <x-ui.icon x-show="!darkMode" name="moon" class="w-5 h-5" />
                <x-ui.icon x-show="darkMode" x-cloak name="sun" class="w-5 h-5" />
            </button>

            {{-- Language dropdown --}}
            <div class="relative hidden sm:block" @click.outside="closeDropdowns()">
                <button
                    type="button"
                    @click="openDropdown('language')"
                    class="p-2 rounded-xl text-secondary/60 dark:text-white/60 hover:bg-background dark:hover:bg-white/5 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20"
                    aria-label="Language"
                >
                    <x-ui.icon name="globe-alt" class="w-5 h-5" />
                </button>

                <div
                    x-show="isDropdownOpen('language')"
                    x-cloak
                    x-transition
                    class="absolute right-0 mt-2 w-40 bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-xl shadow-soft-lg overflow-hidden z-50"
                >
                    @foreach (['English', 'Indonesia'] as $lang)
                        <button type="button" class="w-full px-4 py-2.5 text-sm text-left text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5 transition-colors {{ $loop->first ? 'bg-primary/5 text-primary font-medium' : '' }}">
                            {{ $lang }}
                        </button>
                    @endforeach
                </div>
            </div>

            <x-dashboard.notification-dropdown />
            <x-dashboard.user-dropdown />
        </div>
    </div>
</header>
