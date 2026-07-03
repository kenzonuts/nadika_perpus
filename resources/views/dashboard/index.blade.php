@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="space-y-6 lg:space-y-8 max-w-[1600px] mx-auto">
        <x-dashboard.welcome-card class="animate-fade-up" />

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6">
            @foreach ($overviewStats as $stat)
                <x-dashboard.stat-card
                    :title="$stat['title']"
                    :value="$stat['value']"
                    :icon="$stat['icon']"
                    :color="$stat['color']"
                    class="animate-fade-up"
                />
            @endforeach
        </div>

        <div>
            <h3 class="text-base font-semibold text-secondary dark:text-white mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <x-dashboard.quick-action-card title="Add Book" description="Add new book to catalog" icon="plus-circle" color="primary" :href="route('books.create')" />
                <x-dashboard.quick-action-card title="Add Member" description="Register new member" icon="user-group" color="success" :href="route('members.create')" />
                <x-dashboard.quick-action-card title="Borrow Book" description="Process new borrowing" icon="arrow-right-circle" color="warning" :href="route('borrowings.create')" />
                <x-dashboard.quick-action-card title="Generate Report" description="Export library reports" icon="document-chart-bar" color="primary" :href="route('reports.index')" />
                <x-dashboard.quick-action-card title="Audit Log" description="View system activity" icon="users" color="danger" :href="route('audit.index')" />
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2">
                <x-dashboard.chart-placeholder />
            </div>
            <x-dashboard.timeline title="Recent Activity">
                @forelse ($recentActivity as $activity)
                    <x-dashboard.timeline-item
                        :icon="$activity['icon']"
                        :title="$activity['title']"
                        :description="$activity['description']"
                        :time="$activity['time']"
                        :color="$activity['color']"
                    />
                @empty
                    <p class="px-4 py-6 text-sm text-secondary/50 dark:text-white/50 text-center">No recent activity yet.</p>
                @endforelse
            </x-dashboard.timeline>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <x-dashboard.table title="Popular Books" action="View all" :action-href="route('books.index')">
                <thead>
                    <tr class="border-b border-border dark:border-white/10">
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Book</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Borrows</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border dark:divide-white/10">
                    @forelse ($bookReports as $book)
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
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-secondary/50 dark:text-white/50">No books in catalog yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </x-dashboard.table>

            <x-dashboard.table title="Recent Borrowings" action="View all" :action-href="route('borrowings.index')">
                <thead>
                    <tr class="border-b border-border dark:border-white/10">
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Member</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Book</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Return</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border dark:divide-white/10">
                    @forelse ($borrowingReports as $row)
                        <tr class="hover:bg-background dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center text-xs font-semibold text-primary shrink-0">
                                        {{ collect(explode(' ', $row['member']))->map(fn ($w) => $w[0])->join('') }}
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
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-secondary/50 dark:text-white/50">No borrowings yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </x-dashboard.table>
        </div>
    </div>
@endsection
