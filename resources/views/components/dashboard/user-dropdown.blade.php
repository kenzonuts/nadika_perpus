<div class="relative" @click.outside="closeDropdowns()">
    <button
        type="button"
        @click="openDropdown('user')"
        class="flex items-center gap-2.5 p-1.5 pr-3 rounded-xl hover:bg-background dark:hover:bg-white/5 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20"
        aria-label="User menu"
        :aria-expanded="isDropdownOpen('user')"
    >
        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white text-sm font-semibold shrink-0">
            AD
        </div>
        <div class="hidden lg:block text-left">
            <p class="text-sm font-medium text-secondary dark:text-white leading-tight">Admin User</p>
            <p class="text-xs text-secondary/50 dark:text-white/50">Administrator</p>
        </div>
        <x-ui.icon name="chevron-down" class="hidden lg:block w-4 h-4 text-secondary/40 dark:text-white/40" />
    </button>

    <div
        x-show="isDropdownOpen('user')"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute right-0 mt-2 w-56 bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-2xl shadow-soft-xl overflow-hidden z-50"
        role="menu"
    >
        <div class="px-4 py-3 border-b border-border dark:border-white/10">
            <p class="text-sm font-semibold text-secondary dark:text-white">Admin User</p>
            <p class="text-xs text-secondary/50 dark:text-white/50">admin@smartlibrary.io</p>
        </div>

        @foreach ([
            ['label' => 'Profile', 'icon' => 'user-circle', 'href' => '#'],
            ['label' => 'Settings', 'icon' => 'cog-6-tooth', 'href' => '#'],
            ['label' => 'Security', 'icon' => 'shield-check', 'href' => '#'],
            ['label' => 'Help', 'icon' => 'question-mark-circle', 'href' => '#'],
        ] as $item)
            <a
                href="{{ $item['href'] }}"
                class="flex items-center gap-3 px-4 py-2.5 text-sm text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5 hover:text-secondary dark:hover:text-white transition-colors"
                role="menuitem"
                @click="closeDropdowns()"
            >
                <x-ui.icon :name="$item['icon']" class="w-4 h-4" />
                {{ $item['label'] }}
            </a>
        @endforeach

        <div class="border-t border-border dark:border-white/10">
            <a
                href="{{ url('/login') }}"
                class="flex items-center gap-3 px-4 py-2.5 text-sm text-danger hover:bg-danger/5 transition-colors"
                role="menuitem"
                @click="closeDropdowns()"
            >
                <x-ui.icon name="arrow-right-on-rectangle" class="w-4 h-4" />
                Logout
            </a>
        </div>
    </div>
</div>
