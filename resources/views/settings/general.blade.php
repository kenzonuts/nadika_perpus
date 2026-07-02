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
            <form class="space-y-5">
                <x-ui.input label="Library Name" name="library_name" value="Nadika Digital Library" required />
                <x-ui.input label="Library Tagline" name="library_tagline" value="Your gateway to knowledge" />
                <x-ui.input label="Contact Email" name="contact_email" type="email" value="contact@nadika.library" />
                <x-ui.input label="Contact Phone" name="contact_phone" type="tel" value="+62 21 1234 5678" />

                <div>
                    <x-ui.label for="address">Address</x-ui.label>
                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl placeholder:text-secondary/40 focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none"
                    >Jl. Perpustakaan No. 42, Jakarta Selatan, 12345</textarea>
                </div>
            </form>
        </x-shared.form-section>

        <x-shared.form-section title="Regional Preferences" description="Timezone and language settings for your library.">
            <form class="space-y-5">
                <div>
                    <x-ui.label for="timezone">Timezone</x-ui.label>
                    <select id="timezone" name="timezone" class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB, UTC+7)</option>
                        <option value="Asia/Makassar">Asia/Makassar (WITA, UTC+8)</option>
                        <option value="Asia/Jayapura">Asia/Jayapura (WIT, UTC+9)</option>
                        <option value="UTC">UTC (Coordinated Universal Time)</option>
                    </select>
                </div>

                <div>
                    <x-ui.label>Language</x-ui.label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                        @foreach ([
                            ['code' => 'id', 'label' => 'Bahasa Indonesia', 'checked' => true],
                            ['code' => 'en', 'label' => 'English', 'checked' => false],
                        ] as $lang)
                            <label class="flex items-center gap-3 p-4 bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl cursor-pointer hover:border-primary/30 transition-colors has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                                <input type="radio" name="language" value="{{ $lang['code'] }}" @checked($lang['checked']) class="w-4 h-4 text-primary border-border focus:ring-primary/20" />
                                <span class="text-sm font-medium text-secondary dark:text-white">{{ $lang['label'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <x-ui.label for="date_format">Date Format</x-ui.label>
                    <select id="date_format" name="date_format" class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="d/m/Y" selected>DD/MM/YYYY</option>
                        <option value="m/d/Y">MM/DD/YYYY</option>
                        <option value="Y-m-d">YYYY-MM-DD</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-border dark:border-white/10">
                    <x-ui.button variant="outline" type="button">Reset</x-ui.button>
                    <x-ui.button variant="primary" type="button">
                        <x-ui.icon name="check" class="w-4 h-4" />
                        Save Settings
                    </x-ui.button>
                </div>
            </form>
        </x-shared.form-section>
    </div>
@endsection
