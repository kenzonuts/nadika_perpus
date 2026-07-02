@php
    $currentPath = request()->path();
@endphp

<aside
    :class="{
        'translate-x-0': mobileSidebarOpen,
        '-translate-x-full': !mobileSidebarOpen,
        'lg:translate-x-0': true,
        'w-64': !sidebarCollapsed,
        'w-20': sidebarCollapsed,
    }"
    class="fixed inset-y-0 left-0 z-50 flex flex-col bg-card dark:bg-secondary border-r border-border dark:border-white/10 transition-all duration-300 ease-in-out lg:static lg:z-auto"
    aria-label="Sidebar navigation"
>
    {{-- Logo --}}
    <div class="flex items-center justify-between h-16 px-4 border-b border-border dark:border-white/10 shrink-0">
        <a href="{{ url('/dashboard') }}" class="flex items-center gap-2.5 min-w-0" @click="closeMobileSidebar()">
            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-soft shrink-0">
                <x-ui.icon name="book-open" class="w-5 h-5 text-white" />
            </div>
            <div x-show="!sidebarCollapsed" x-cloak class="min-w-0">
                <p class="text-sm font-semibold text-secondary dark:text-white truncate">Smart Secure Library</p>
            </div>
        </a>

        <button
            type="button"
            @click="toggleSidebar()"
            class="hidden lg:flex p-1.5 rounded-lg text-secondary/50 dark:text-white/50 hover:bg-background dark:hover:bg-white/5 hover:text-secondary dark:hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20"
            :aria-label="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'"
        >
            <x-ui.icon name="chevron-left" class="w-5 h-5 transition-transform duration-300" ::class="sidebarCollapsed ? 'rotate-180' : ''" />
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        <x-dashboard.sidebar-item
            href="{{ url('/dashboard') }}"
            icon="home"
            label="Dashboard"
            :active="request()->is('dashboard')"
        />

        <x-dashboard.sidebar-group label="Library" icon="book-open" :default-open="str_starts_with($currentPath, 'books') || str_starts_with($currentPath, 'categories') || str_starts_with($currentPath, 'shelves')">
            <x-dashboard.sidebar-item href="#" label="Books" icon="book" class="!py-2 !px-2" />
            <x-dashboard.sidebar-item href="#" label="Categories" icon="rectangle-stack" class="!py-2 !px-2" />
            <x-dashboard.sidebar-item href="#" label="Shelves" icon="archive-box" class="!py-2 !px-2" />
        </x-dashboard.sidebar-group>

        <x-dashboard.sidebar-item href="#" icon="users" label="Members" />

        <x-dashboard.sidebar-group label="Transactions" icon="arrow-path" :default-open="false">
            <x-dashboard.sidebar-item href="#" label="Borrowings" icon="arrow-right-circle" class="!py-2 !px-2" />
            <x-dashboard.sidebar-item href="#" label="Returns" icon="arrow-left-circle" class="!py-2 !px-2" />
        </x-dashboard.sidebar-group>

        <x-dashboard.sidebar-group label="Reports" icon="document-chart-bar" :default-open="false">
            <x-dashboard.sidebar-item href="#" label="Analytics" icon="chart-pie" class="!py-2 !px-2" />
        </x-dashboard.sidebar-group>

        <x-dashboard.sidebar-group label="Security" icon="shield-check" :default-open="false">
            <x-dashboard.sidebar-item href="#" label="Audit Logs" icon="clipboard-document-list" class="!py-2 !px-2" />
        </x-dashboard.sidebar-group>

        <div class="pt-4 mt-4 border-t border-border dark:border-white/10 space-y-1">
            <x-dashboard.sidebar-item href="#" icon="user-circle" label="Profile" />
            <x-dashboard.sidebar-item href="#" icon="cog-6-tooth" label="Settings" />
            <x-dashboard.sidebar-item href="{{ url('/login') }}" icon="arrow-right-on-rectangle" label="Logout" />
        </div>
    </nav>
</aside>
