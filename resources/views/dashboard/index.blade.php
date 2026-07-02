@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="space-y-6 lg:space-y-8 max-w-[1600px] mx-auto">
        {{-- Welcome Card --}}
        <x-dashboard.welcome-card class="animate-fade-up" />

        {{-- Statistics --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6">
            <x-dashboard.stat-card
                title="Total Books"
                value="12,847"
                icon="book-open"
                trend="12.5%"
                :trend-up="true"
                color="primary"
                class="animate-fade-up"
            />
            <x-dashboard.stat-card
                title="Total Members"
                value="3,456"
                icon="users"
                trend="8.2%"
                :trend-up="true"
                color="success"
                class="animate-fade-up [animation-delay:0.05s]"
            />
            <x-dashboard.stat-card
                title="Borrowed Books"
                value="892"
                icon="arrow-right-circle"
                trend="3.1%"
                :trend-up="false"
                color="warning"
                class="animate-fade-up [animation-delay:0.1s]"
            />
            <x-dashboard.stat-card
                title="Late Returns"
                value="23"
                icon="exclamation-triangle"
                trend="15.3%"
                :trend-up="false"
                color="danger"
                class="animate-fade-up [animation-delay:0.15s]"
            />
        </div>

        {{-- Quick Actions --}}
        <div>
            <h3 class="text-base font-semibold text-secondary dark:text-white mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <x-dashboard.quick-action-card title="Add Book" description="Add new book to catalog" icon="plus-circle" color="primary" />
                <x-dashboard.quick-action-card title="Add Member" description="Register new member" icon="user-group" color="success" />
                <x-dashboard.quick-action-card title="Borrow Book" description="Process new borrowing" icon="arrow-right-circle" color="warning" />
                <x-dashboard.quick-action-card title="Generate Report" description="Export library reports" icon="document-chart-bar" color="primary" />
                <x-dashboard.quick-action-card title="Manage Users" description="Admin user management" icon="users" color="danger" />
            </div>
        </div>

        {{-- Chart + Activity --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2">
                <x-dashboard.chart-placeholder />
            </div>
            <x-dashboard.timeline title="Recent Activity">
                <x-dashboard.timeline-item icon="user-circle" title="User logged in" description="Admin User signed in from Chrome" time="2 min ago" color="primary" />
                <x-dashboard.timeline-item icon="arrow-right-circle" title="Book borrowed" description="John Mitchell borrowed Clean Code" time="15 min ago" color="success" />
                <x-dashboard.timeline-item icon="arrow-left-circle" title="Book returned" description="Sarah Chen returned Design Patterns" time="32 min ago" color="warning" />
                <x-dashboard.timeline-item icon="plus-circle" title="Book created" description="Atomic Habits added to catalog" time="1 hour ago" color="primary" />
                <x-dashboard.timeline-item icon="trash" title="Book deleted" description="Outdated manual removed from system" time="2 hours ago" color="danger" />
            </x-dashboard.timeline>
        </div>

        {{-- Tables --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            {{-- Popular Books --}}
            <x-dashboard.table title="Popular Books" action="View all" action-href="#">
                <thead>
                    <tr class="border-b border-border dark:border-white/10">
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Book</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Borrows</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border dark:divide-white/10">
                    @foreach ([
                        ['title' => 'Clean Code', 'category' => 'Programming', 'borrows' => 342, 'status' => 'Available', 'variant' => 'success', 'color' => 'from-blue-500 to-blue-600'],
                        ['title' => 'Design Patterns', 'category' => 'Engineering', 'borrows' => 289, 'status' => 'Available', 'variant' => 'success', 'color' => 'from-violet-500 to-violet-600'],
                        ['title' => 'Atomic Habits', 'category' => 'Self-Help', 'borrows' => 256, 'status' => 'Borrowed', 'variant' => 'warning', 'color' => 'from-amber-500 to-amber-600'],
                        ['title' => 'Deep Work', 'category' => 'Productivity', 'borrows' => 198, 'status' => 'Available', 'variant' => 'success', 'color' => 'from-rose-500 to-rose-600'],
                    ] as $book)
                        <tr class="hover:bg-background dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br {{ $book['color'] }} flex items-center justify-center shrink-0">
                                        <x-ui.icon name="book-open" class="w-4 h-4 text-white" />
                                    </div>
                                    <span class="text-sm font-medium text-secondary dark:text-white">{{ $book['title'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $book['category'] }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-secondary dark:text-white">{{ $book['borrows'] }}</td>
                            <td class="px-6 py-4">
                                <x-ui.badge :variant="$book['variant']">{{ $book['status'] }}</x-ui.badge>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard.table>

            {{-- Recent Borrowings --}}
            <x-dashboard.table title="Recent Borrowings" action="View all" action-href="#">
                <thead>
                    <tr class="border-b border-border dark:border-white/10">
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Member</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Book</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Return</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border dark:divide-white/10">
                    @foreach ([
                        ['member' => 'John Mitchell', 'book' => 'Clean Code', 'status' => 'Active', 'variant' => 'success', 'borrow' => 'Jul 1', 'return' => 'Jul 15'],
                        ['member' => 'Sarah Chen', 'book' => 'Design Patterns', 'status' => 'Returned', 'variant' => 'neutral', 'borrow' => 'Jun 28', 'return' => 'Jul 12'],
                        ['member' => 'Michael Brown', 'book' => 'Atomic Habits', 'status' => 'Overdue', 'variant' => 'danger', 'borrow' => 'Jun 20', 'return' => 'Jul 4'],
                        ['member' => 'Emily Davis', 'book' => 'Deep Work', 'status' => 'Active', 'variant' => 'success', 'borrow' => 'Jul 2', 'return' => 'Jul 16'],
                    ] as $row)
                        <tr class="hover:bg-background dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center text-xs font-semibold text-primary shrink-0">
                                        {{ collect(explode(' ', $row['member']))->map(fn($w) => $w[0])->join('') }}
                                    </div>
                                    <span class="text-sm font-medium text-secondary dark:text-white">{{ $row['member'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden md:table-cell">{{ $row['book'] }}</td>
                            <td class="px-6 py-4">
                                <x-ui.badge :variant="$row['variant']">{{ $row['status'] }}</x-ui.badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-secondary/50 dark:text-white/50 hidden lg:table-cell">{{ $row['return'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard.table>
        </div>

        {{-- Announcements --}}
        <div>
            <h3 class="text-base font-semibold text-secondary dark:text-white mb-4">Announcements</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <x-dashboard.announcement-card
                    title="System Maintenance"
                    date="Jul 5, 2026 · 2:00 AM"
                    priority="high"
                >
                    Scheduled maintenance window. The system will be unavailable for approximately 2 hours.
                </x-dashboard.announcement-card>
                <x-dashboard.announcement-card
                    title="New Books Arrived"
                    date="Jul 3, 2026"
                    priority="medium"
                >
                    45 new titles have been added to the programming section. Check them out!
                </x-dashboard.announcement-card>
                <x-dashboard.announcement-card
                    title="Holiday Hours"
                    date="Jul 1, 2026"
                    priority="low"
                >
                    Library will operate with reduced hours during the upcoming holiday weekend.
                </x-dashboard.announcement-card>
            </div>
        </div>
    </div>
@endsection
