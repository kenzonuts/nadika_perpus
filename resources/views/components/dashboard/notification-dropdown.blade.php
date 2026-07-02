@php
    $notifications = [
        ['title' => 'New book added', 'message' => 'Clean Architecture was added to the catalog', 'time' => '2 min ago', 'unread' => true],
        ['title' => 'Overdue return', 'message' => 'John Mitchell has an overdue book', 'time' => '15 min ago', 'unread' => true],
        ['title' => 'New member registered', 'message' => 'Sarah Chen joined the library', 'time' => '1 hour ago', 'unread' => true],
        ['title' => 'Report generated', 'message' => 'Monthly borrowing report is ready', 'time' => '3 hours ago', 'unread' => false],
    ];
    $unreadCount = collect($notifications)->where('unread', true)->count();
@endphp

<div class="relative" @click.outside="closeDropdowns()">
    <button
        type="button"
        @click="openDropdown('notifications')"
        class="relative p-2 rounded-xl text-secondary/60 dark:text-white/60 hover:bg-background dark:hover:bg-white/5 hover:text-secondary dark:hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20"
        aria-label="Notifications"
        :aria-expanded="isDropdownOpen('notifications')"
    >
        <x-ui.icon name="bell" class="w-5 h-5" />
        @if ($unreadCount > 0)
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-danger rounded-full ring-2 ring-card dark:ring-secondary"></span>
        @endif
    </button>

    <div
        x-show="isDropdownOpen('notifications')"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute right-0 mt-2 w-80 sm:w-96 bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-2xl shadow-soft-xl overflow-hidden z-50"
        role="menu"
    >
        <div class="flex items-center justify-between px-4 py-3 border-b border-border dark:border-white/10">
            <h3 class="text-sm font-semibold text-secondary dark:text-white">Notifications</h3>
            <button type="button" class="text-xs font-medium text-primary hover:text-primary-dark transition-colors">Mark all read</button>
        </div>

        <div class="max-h-80 overflow-y-auto">
            @foreach ($notifications as $notification)
                <button
                    type="button"
                    class="w-full flex items-start gap-3 px-4 py-3 hover:bg-background dark:hover:bg-white/5 transition-colors text-left {{ $notification['unread'] ? 'bg-primary/5 dark:bg-primary/10' : '' }}"
                    role="menuitem"
                >
                    <div class="w-2 h-2 mt-2 rounded-full shrink-0 {{ $notification['unread'] ? 'bg-primary' : 'bg-transparent' }}"></div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-secondary dark:text-white">{{ $notification['title'] }}</p>
                        <p class="text-xs text-secondary/50 dark:text-white/50 mt-0.5 truncate">{{ $notification['message'] }}</p>
                        <p class="text-xs text-secondary/40 dark:text-white/40 mt-1">{{ $notification['time'] }}</p>
                    </div>
                </button>
            @endforeach
        </div>

        <div class="px-4 py-3 border-t border-border dark:border-white/10">
            <a href="#" class="block text-center text-sm font-medium text-primary hover:text-primary-dark transition-colors">View all notifications</a>
        </div>
    </div>
</div>
