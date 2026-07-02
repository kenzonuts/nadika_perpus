<nav
    x-data="navbar"
    :class="scrolled ? 'bg-white/80 backdrop-blur-xl shadow-soft border-b border-border' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            {{-- Logo --}}
            <a href="#home" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-soft group-hover:shadow-soft-lg transition-all duration-300 group-hover:scale-105">
                    <x-ui.icon name="book-open" class="w-5 h-5 text-white" />
                </div>
                <span class="text-lg font-semibold text-secondary">Smart Library</span>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="#home" class="text-sm font-medium text-secondary/70 hover:text-primary transition-colors duration-200">Home</a>
                <a href="#features" class="text-sm font-medium text-secondary/70 hover:text-primary transition-colors duration-200">Features</a>
                <a href="#books" class="text-sm font-medium text-secondary/70 hover:text-primary transition-colors duration-200">Books</a>
                <a href="#about" class="text-sm font-medium text-secondary/70 hover:text-primary transition-colors duration-200">About</a>
                <a href="#contact" class="text-sm font-medium text-secondary/70 hover:text-primary transition-colors duration-200">Contact</a>
            </div>

            {{-- Desktop Buttons --}}
            <div class="hidden lg:flex items-center gap-3">
                <x-ui.button variant="ghost" size="sm" href="{{ route('login') }}" id="login">Login</x-ui.button>
                <x-ui.button variant="primary" size="sm" href="{{ route('register') }}">Register</x-ui.button>
            </div>

            {{-- Mobile Menu Button --}}
            <button
                @click="toggleMobile()"
                class="lg:hidden p-2 rounded-xl text-secondary hover:bg-background transition-colors"
                aria-label="Toggle menu"
            >
                <x-ui.icon x-show="!mobileOpen" name="bars-3" class="w-6 h-6" />
                <x-ui.icon x-show="mobileOpen" x-cloak name="x-mark" class="w-6 h-6" />
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="mobileOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden bg-white/95 backdrop-blur-xl border-b border-border"
    >
        <div class="px-4 py-4 space-y-1">
            <a @click="closeMobile()" href="#home" class="block px-4 py-3 text-sm font-medium text-secondary/70 hover:text-primary hover:bg-background rounded-xl transition-colors">Home</a>
            <a @click="closeMobile()" href="#features" class="block px-4 py-3 text-sm font-medium text-secondary/70 hover:text-primary hover:bg-background rounded-xl transition-colors">Features</a>
            <a @click="closeMobile()" href="#books" class="block px-4 py-3 text-sm font-medium text-secondary/70 hover:text-primary hover:bg-background rounded-xl transition-colors">Books</a>
            <a @click="closeMobile()" href="#about" class="block px-4 py-3 text-sm font-medium text-secondary/70 hover:text-primary hover:bg-background rounded-xl transition-colors">About</a>
            <a @click="closeMobile()" href="#contact" class="block px-4 py-3 text-sm font-medium text-secondary/70 hover:text-primary hover:bg-background rounded-xl transition-colors">Contact</a>
            <div class="pt-4 flex flex-col gap-2">
                <x-ui.button variant="outline" size="sm" href="{{ route('login') }}" class="w-full">Login</x-ui.button>
                <x-ui.button variant="primary" size="sm" href="{{ route('register') }}" class="w-full">Register</x-ui.button>
            </div>
        </div>
    </div>
</nav>
