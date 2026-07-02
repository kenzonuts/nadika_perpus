@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Profile', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1000px] mx-auto space-y-6">
        <x-profile.tabs active="index" />

        <x-shared.page-toolbar title="My Profile" subtitle="Manage your personal information and account details." />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Profile card --}}
            <div class="lg:col-span-1">
                <x-shared.form-section>
                    <x-shared.avatar-upload initials="AU" size="xl">
                        <p class="text-sm font-semibold text-secondary dark:text-white">Admin User</p>
                        <p class="text-xs text-secondary/50 dark:text-white/50">admin@nadika.library</p>
                        <x-ui.badge variant="success" class="mt-2">Administrator</x-ui.badge>
                    </x-shared.avatar-upload>

                    <div class="mt-6 pt-6 border-t border-border dark:border-white/10 space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-secondary/50 dark:text-white/50">Member since</span>
                            <span class="font-medium text-secondary dark:text-white">Jan 2024</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-secondary/50 dark:text-white/50">Last login</span>
                            <span class="font-medium text-secondary dark:text-white">2 min ago</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-secondary/50 dark:text-white/50">Role</span>
                            <span class="font-medium text-secondary dark:text-white">Super Admin</span>
                        </div>
                    </div>
                </x-shared.form-section>
            </div>

            {{-- Edit form --}}
            <div class="lg:col-span-2">
                <x-shared.form-section title="Personal Information" description="Update your profile details and contact information.">
                    <form class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <x-ui.input label="First Name" name="first_name" value="Admin" required />
                            <x-ui.input label="Last Name" name="last_name" value="User" required />
                        </div>
                        <x-ui.input label="Email Address" name="email" type="email" value="admin@nadika.library" required />
                        <x-ui.input label="Phone Number" name="phone" type="tel" value="+62 812 3456 7890" />
                        <x-ui.input label="Job Title" name="job_title" value="Library Administrator" />
                        <div>
                            <x-ui.label for="bio">Bio</x-ui.label>
                            <textarea
                                id="bio"
                                name="bio"
                                rows="4"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl placeholder:text-secondary/40 focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none"
                                placeholder="Tell us about yourself..."
                            >Managing the Nadika digital library system since 2024.</textarea>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-border dark:border-white/10">
                            <x-ui.button variant="outline" type="button">Cancel</x-ui.button>
                            <x-ui.button variant="primary" type="button">
                                <x-ui.icon name="check" class="w-4 h-4" />
                                Save Changes
                            </x-ui.button>
                        </div>
                    </form>
                </x-shared.form-section>
            </div>
        </div>
    </div>
@endsection
