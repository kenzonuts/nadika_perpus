@extends('layouts.dashboard')


@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Members', 'href' => url('/members')],
        ['label' => 'Trash', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1200px] mx-auto space-y-6" x-data="{ searchQuery: '' }">
        <x-shared.page-toolbar
            title="Trash"
            subtitle="Deleted members can be restored or permanently removed."
            :back-url="url('/members')"
            back-label="Back to Members"
        />

        <x-shared.filter-toolbar placeholder="Search deleted members..." :filters="false" />

        @if (count($trashedMembers) > 0)
            <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Member</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase hidden sm:table-cell">Email</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase hidden md:table-cell">Membership</th>
                                <th class="px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Deleted</th>
                                <th class="px-6 py-3.5 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border dark:divide-white/10">
                            @foreach ($trashedMembers as $member)
                                <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $member['color'] }} flex items-center justify-center text-white text-sm font-bold shrink-0 opacity-60">
                                                {{ $member['avatar_initials'] }}
                                            </div>
                                            <span class="font-medium text-secondary dark:text-white">{{ $member['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $member['email'] }}</td>
                                    <td class="px-6 py-4 hidden md:table-cell">
                                        <x-ui.badge variant="neutral">{{ $member['membership_type'] }}</x-ui.badge>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-secondary/40 dark:text-white/40">{{ $member['deleted_at'] }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <x-ui.button variant="outline" size="sm" type="button">
                                                <x-ui.icon name="arrow-uturn-left" class="w-3.5 h-3.5" />
                                                Restore
                                            </x-ui.button>
                                            <x-ui.button variant="ghost" size="sm" type="button" class="!text-danger hover:!bg-danger/5">
                                                <x-ui.icon name="trash" class="w-3.5 h-3.5" />
                                                Delete
                                            </x-ui.button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <x-dashboard.empty-state
                title="Trash is empty"
                description="Deleted members will appear here. You can restore them or delete permanently."
                icon="trash"
                action="Back to Members"
                :action-href="url('/members')"
            />
        @endif
    </div>
@endsection
