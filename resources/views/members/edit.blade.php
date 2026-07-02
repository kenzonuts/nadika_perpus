@extends('layouts.dashboard')


@php $member = $members[0]; @endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Members', 'href' => url('/members')],
        ['label' => 'Edit', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto" x-data="memberForm({{ json_encode([
        'name' => $member['name'],
        'email' => $member['email'],
        'phone' => $member['phone'],
        'membership_type' => $member['membership_type'],
        'status' => $member['status'],
        'join_date' => '2024-01-15',
        'address' => $member['address'],
        'notes' => $member['notes'],
    ]) }})">
        <div
            x-show="dirty"
            x-cloak
            x-transition
            class="mb-4 flex items-center gap-3 px-4 py-3 bg-warning/10 border border-warning/20 rounded-xl text-sm text-warning"
            role="alert"
        >
            <x-ui.icon name="exclamation-triangle" class="w-5 h-5 shrink-0" />
            You have unsaved changes. Don't forget to save before leaving this page.
        </div>

        <x-shared.page-toolbar
            class="mb-6"
            title="Edit Member"
            :subtitle="'Update information for ' . $member['name']"
        >
            <x-ui.button variant="outline" size="sm" :href="url('/members/' . $member['id'])">
                <x-ui.icon name="eye" class="w-4 h-4" />
                View
            </x-ui.button>
            <x-ui.button variant="outline" size="sm" href="{{ url('/members') }}">
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                Back
            </x-ui.button>
        </x-shared.page-toolbar>

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
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            />
                        </div>
                        <div>
                            <x-ui.label for="phone">Phone Number</x-ui.label>
                            <input
                                type="tel"
                                id="phone"
                                x-model="form.phone"
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20"
                            />
                        </div>
                        <div class="sm:col-span-2">
                            <x-ui.label for="address">Address</x-ui.label>
                            <input
                                type="text"
                                id="address"
                                x-model="form.address"
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
                                class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none"
                            ></textarea>
                        </div>
                    </div>
                </x-shared.form-section>

                <div class="flex items-center justify-between">
                    <x-ui.button variant="ghost" type="button" class="!text-danger hover:!bg-danger/5" href="{{ url('/members/trash') }}">
                        <x-ui.icon name="trash" class="w-4 h-4" />
                        Delete Member
                    </x-ui.button>
                    <div class="flex gap-3">
                        <x-ui.button variant="outline" :href="url('/members/' . $member['id'])">Cancel</x-ui.button>
                        <x-ui.button type="submit" variant="primary">Save Changes</x-ui.button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <x-shared.form-section title="Profile Photo">
                    <x-shared.avatar-upload :initials="$member['avatar_initials']" size="xl" class="mx-auto">
                        <p class="text-xs text-secondary/50 dark:text-white/50 text-center">{{ $member['name'] }}</p>
                    </x-shared.avatar-upload>
                </x-shared.form-section>

                <x-shared.form-section title="Member Card">
                    <div class="text-center space-y-4">
                        <div class="mx-auto w-32 h-32 bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-2xl flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-2 grid grid-cols-5 grid-rows-5 gap-0.5 opacity-30">
                                @for ($i = 0; $i < 25; $i++)
                                    <div class="{{ $i % 3 === 0 ? 'bg-secondary dark:bg-white' : 'bg-transparent' }} rounded-sm"></div>
                                @endfor
                            </div>
                            <x-ui.icon name="qr-code" class="w-12 h-12 text-secondary dark:text-white relative z-10" />
                        </div>
                        <p class="text-xs font-mono text-secondary/60 dark:text-white/60">{{ $member['qr_code'] }}</p>
                        <x-ui.button variant="outline" size="sm" type="button" class="w-full">
                            <x-ui.icon name="document-duplicate" class="w-4 h-4" />
                            Print QR Card
                        </x-ui.button>
                    </div>
                </x-shared.form-section>
            </div>
        </form>
    </div>
@endsection
