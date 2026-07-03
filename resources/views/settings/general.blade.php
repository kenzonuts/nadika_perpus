@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Settings', 'href' => url('/settings/general')],
        ['label' => 'General', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[800px] mx-auto space-y-6">
        <x-settings.tabs active="general" />

        <x-shared.page-toolbar title="General Settings" subtitle="Configure basic library information and regional preferences." />

        <x-shared.form-section title="Library Information" description="Basic details displayed across the platform.">
            <form method="POST" action="{{ route('settings.update') }}" class="space-y-5">
                @csrf
                @method('PATCH')
                <input type="hidden" name="group" value="general">

                <x-ui.input label="Library Name" name="settings[library_name]" :value="$library_name ?? ''" required />
                <x-ui.input label="Library Tagline" name="settings[library_tagline]" :value="$library_tagline ?? ''" />
                <x-ui.input label="Contact Email" name="settings[contact_email]" type="email" :value="$contact_email ?? ''" />
                <x-ui.input label="Contact Phone" name="settings[contact_phone]" type="tel" :value="$contact_phone ?? ''" />

                <div>
                    <x-ui.label for="library_address">Address</x-ui.label>
                    <textarea
                        id="library_address"
                        name="settings[library_address]"
                        rows="3"
                        class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl placeholder:text-secondary/40 focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none"
                    >{{ $library_address ?? '' }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-border dark:border-white/10">
                    <x-ui.button variant="primary" type="submit">
                        <x-ui.icon name="check" class="w-4 h-4" />
                        Save Settings
                    </x-ui.button>
                </div>
            </form>
        </x-shared.form-section>
    </div>
@endsection
