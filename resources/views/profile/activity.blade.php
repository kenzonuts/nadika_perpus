@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Profile', 'href' => url('/profile')],
        ['label' => 'Activity', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1000px] mx-auto space-y-6">
        <x-profile.tabs active="activity" />

        <x-shared.page-toolbar title="Activity" subtitle="Your recent actions and active login sessions." />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-shared.form-section title="Recent Activity">
                <x-dashboard.timeline title="">
                    @forelse ($activityTimeline as $activity)
                        <x-dashboard.timeline-item
                            :icon="$activity['icon']"
                            :title="$activity['title']"
                            :description="$activity['description']"
                            :time="$activity['time']"
                            :color="$activity['color']"
                        />
                    @empty
                        <p class="py-6 text-sm text-center text-secondary/50 dark:text-white/50">No activity recorded yet.</p>
                    @endforelse
                </x-dashboard.timeline>
            </x-shared.form-section>

            <x-shared.form-section title="Active Sessions" description="Session management coming soon.">
                <p class="text-sm text-secondary/50 dark:text-white/50">Your current session is active. Multi-session management will be available in a future update.</p>
            </x-shared.form-section>
        </div>
    </div>
@endsection
