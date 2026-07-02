@extends('layouts.dashboard')

@include('members.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Members', 'href' => url('/members')],
        ['label' => 'Create', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto" x-data="memberForm()">
        <x-shared.page-toolbar
            class="mb-6"
            title="Add New Member"
            subtitle="Register a new library member and assign their membership."
            :back-url="url('/members')"
            back-label="Back to Members"
        />

        <form @submit.prevent="markClean()" class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <div class="lg:col-span-2 space-y-6">
                <x-shared.form-section title="Personal Information" description="Basic contact details for the member.">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <x-ui.label for="name" :required="true">Full Name</x-ui.label>
                            <input
                                type="text"
                                id="name"
                                x-model="form.name"
                                required
                                placeholder="e.g. John Mitchell"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            />
                        </div>
                        <div>
                            <x-ui.label for="email" :required="true">Email Address</x-ui.label>
                            <input
                                type="email"
                                id="email"
                                x-model="form.email"
                                required
                                placeholder="member@email.com"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            />
                        </div>
                        <div>
                            <x-ui.label for="phone">Phone Number</x-ui.label>
                            <input
                                type="tel"
                                id="phone"
                                x-model="form.phone"
                                placeholder="+1 555-0100"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            />
                        </div>
                        <div class="sm:col-span-2">
                            <x-ui.label for="address">Address</x-ui.label>
                            <input
                                type="text"
                                id="address"
                                x-model="form.address"
                                placeholder="Street address, city"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            />
                        </div>
                    </div>
                </x-shared.form-section>

                <x-shared.form-section title="Membership Details" description="Configure membership type and access status.">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-ui.label for="membership_type" :required="true">Membership Type</x-ui.label>
                            <select
                                id="membership_type"
                                x-model="form.membership_type"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            >
                                @foreach ($membershipTypes as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-ui.label for="status">Status</x-ui.label>
                            <select
                                id="status"
                                x-model="form.status"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            >
                                @foreach ($membershipStatuses as $status)
                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-ui.label for="join_date">Join Date</x-ui.label>
                            <input
                                type="date"
                                id="join_date"
                                x-model="form.join_date"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            />
                        </div>
                        <div class="sm:col-span-2">
                            <x-ui.label for="notes">Notes</x-ui.label>
                            <textarea
                                id="notes"
                                x-model="form.notes"
                                rows="3"
                                placeholder="Optional notes about this member..."
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none"
                            ></textarea>
                        </div>
                    </div>
                </x-shared.form-section>

                <div class="flex items-center justify-end gap-3">
                    <x-ui.button variant="outline" href="{{ url('/members') }}">Cancel</x-ui.button>
                    <x-ui.button type="submit" variant="primary">
                        <x-ui.icon name="plus" class="w-4 h-4" />
                        Create Member
                    </x-ui.button>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <x-shared.form-section title="Profile Photo">
                    <x-shared.avatar-upload :initials="'NM'" size="xl" class="mx-auto">
                        <p class="text-xs text-secondary/50 dark:text-white/50 text-center">Upload a profile photo or use initials</p>
                    </x-shared.avatar-upload>
                </x-shared.form-section>

                <x-shared.form-section title="Member Card Preview">
                    <div class="text-center space-y-4">
                        <div class="mx-auto w-32 h-32 bg-background dark:bg-white/5 border-2 border-dashed border-border dark:border-white/10 rounded-2xl flex items-center justify-center">
                            <x-ui.icon name="qr-code" class="w-16 h-16 text-secondary/20 dark:text-white/20" />
                        </div>
                        <p class="text-xs text-secondary/50 dark:text-white/50">QR code will be generated after creation</p>
                        <p class="text-xs font-mono text-secondary/40 dark:text-white/40">M-XXXXX</p>
                    </div>
                </x-shared.form-section>
            </div>
        </form>
    </div>
@endsection
