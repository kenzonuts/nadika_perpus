@extends('layouts.dashboard')

@include('members.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Members', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="moduleIndex">
        <x-shared.page-toolbar
            title="Members"
            subtitle="Manage library members, memberships, and borrowing access."
        >
            <x-ui.button variant="outline" size="sm" href="{{ url('/members/trash') }}">
                <x-ui.icon name="trash" class="w-4 h-4" />
                Trash
            </x-ui.button>
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export
            </x-ui.button>
            <x-ui.button variant="outline" size="sm" type="button" @click="refresh()" x-bind:disabled="loading">
                <x-ui.icon name="arrow-path-rounded" class="w-4 h-4" ::class="loading ? 'animate-spin' : ''" />
                Refresh
            </x-ui.button>
            <x-ui.button variant="primary" size="sm" href="{{ url('/members/create') }}">
                <x-ui.icon name="plus" class="w-4 h-4" />
                Add Member
            </x-ui.button>
        </x-shared.page-toolbar>

        {{-- Statistics --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard.stat-card title="Total Members" value="2,847" icon="users" color="primary" trend="12%" :trend-up="true" />
            <x-dashboard.stat-card title="Active Members" value="2,456" icon="check-circle" color="success" trend="8%" :trend-up="true" />
            <x-dashboard.stat-card title="Currently Borrowing" value="342" icon="book-open" color="warning" />
            <x-dashboard.stat-card title="Suspended / Expired" value="89" icon="exclamation-triangle" color="danger" trend="3%" :trend-up="false" />
        </div>

        {{-- Filters --}}
        <x-shared.filter-toolbar placeholder="Search members by name, email, or phone...">
            <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="">All Memberships</option>
                @foreach ($membershipTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="">All Status</option>
                @foreach ($membershipStatuses as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="name">Name A-Z</option>
                <option value="borrows">Most Borrowed</option>
            </select>
        </x-shared.filter-toolbar>

        {{-- Loading skeleton --}}
        <div x-show="loading" x-cloak>
            <x-dashboard.skeleton-table :rows="6" />
        </div>

        {{-- Member table --}}
        <div x-show="!loading" class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Avatar</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Name</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Email</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Membership</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Borrowed</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden xl:table-cell">Joined</th>
                            <th class="px-4 lg:px-6 py-3.5 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border dark:divide-white/10">
                        @foreach ($members as $member)
                            @php
                                $statusConfig = [
                                    'active' => ['label' => 'Active', 'variant' => 'success'],
                                    'inactive' => ['label' => 'Inactive', 'variant' => 'neutral'],
                                    'suspended' => ['label' => 'Suspended', 'variant' => 'danger'],
                                    'expired' => ['label' => 'Expired', 'variant' => 'warning'],
                                ];
                                $statusItem = $statusConfig[$member['status']] ?? $statusConfig['active'];
                                $menuId = 'member-menu-' . $member['id'];
                            @endphp
                            <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors group">
                                <td class="px-4 lg:px-6 py-4">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $member['color'] }} flex items-center justify-center text-white text-sm font-bold shrink-0">
                                        {{ $member['avatar_initials'] }}
                                    </div>
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <a href="{{ url('/members/' . $member['id']) }}" class="font-medium text-secondary dark:text-white hover:text-primary transition-colors">
                                        {{ $member['name'] }}
                                    </a>
                                    <p class="text-xs text-secondary/40 dark:text-white/40 mt-0.5 md:hidden">{{ $member['email'] }}</p>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60 hidden md:table-cell">{{ $member['email'] }}</td>
                                <td class="px-4 lg:px-6 py-4 hidden lg:table-cell">
                                    <x-ui.badge variant="default">{{ $member['membership_type'] }}</x-ui.badge>
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <x-ui.badge :variant="$statusItem['variant']">{{ $statusItem['label'] }}</x-ui.badge>
                                </td>
                                <td class="px-4 lg:px-6 py-4 hidden sm:table-cell">
                                    <span class="font-medium {{ $member['borrowed_count'] > 0 ? 'text-warning' : 'text-secondary/50 dark:text-white/50' }}">
                                        {{ $member['borrowed_count'] }}
                                    </span>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-xs text-secondary/40 dark:text-white/40 hidden xl:table-cell">{{ $member['join_date'] }}</td>
                                <td class="px-4 lg:px-6 py-4 text-right">
                                    <div class="relative inline-block" @click.outside="closeRowMenu()">
                                        <button
                                            type="button"
                                            @click.stop="toggleRowMenu('{{ $menuId }}')"
                                            class="p-1.5 rounded-lg text-secondary/50 dark:text-white/50 hover:bg-background dark:hover:bg-white/5 hover:text-secondary dark:hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20"
                                            aria-label="Member actions"
                                            :aria-expanded="activeRowMenu === '{{ $menuId }}'"
                                        >
                                            <x-ui.icon name="ellipsis-vertical" class="w-5 h-5" />
                                        </button>
                                        <div
                                            x-show="activeRowMenu === '{{ $menuId }}'"
                                            x-cloak
                                            x-transition
                                            class="absolute right-0 mt-1 w-48 bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-xl shadow-soft-lg overflow-hidden z-50"
                                            role="menu"
                                        >
                                            <a href="{{ url('/members/' . $member['id']) }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5" role="menuitem" @click="closeRowMenu()">
                                                <x-ui.icon name="eye" class="w-4 h-4" /> View
                                            </a>
                                            <a href="{{ url('/members/' . $member['id'] . '/edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5" role="menuitem" @click="closeRowMenu()">
                                                <x-ui.icon name="pencil-square" class="w-4 h-4" /> Edit
                                            </a>
                                            <button type="button" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5 text-left" role="menuitem" @click="closeRowMenu()">
                                                <x-ui.icon name="qr-code" class="w-4 h-4" /> Print QR Card
                                            </button>
                                            <div class="border-t border-border dark:border-white/10">
                                                <button
                                                    type="button"
                                                    class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-danger hover:bg-danger/5 text-left"
                                                    role="menuitem"
                                                    @click="openDeleteModal(@json($member))"
                                                >
                                                    <x-ui.icon name="trash" class="w-4 h-4" /> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <x-books.pagination :current="1" :total="5" :total-items="48" />

        <x-shared.confirm-modal
            title="Delete Member"
            message="Are you sure you want to move this member to trash? They can be restored later."
            confirm-label="Delete"
            :danger="true"
        >
            <template x-if="selectedItem">
                <div class="flex items-center gap-3 p-3 bg-background dark:bg-white/5 rounded-xl">
                    <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white text-sm font-bold" x-text="selectedItem?.avatar_initials"></div>
                    <div>
                        <p class="text-sm font-medium text-secondary dark:text-white" x-text="selectedItem?.name"></p>
                        <p class="text-xs text-secondary/50 dark:text-white/50" x-text="selectedItem?.email"></p>
                    </div>
                </div>
            </template>
        </x-shared.confirm-modal>
    </div>
@endsection
