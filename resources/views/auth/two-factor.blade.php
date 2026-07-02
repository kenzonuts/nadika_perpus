@extends('layouts.auth')

@section('content')
    <x-auth.card
        title="Two-factor authentication"
        subtitle="Enter the 6-digit verification code sent to your authenticator app."
    >
        <form
            x-data="formSubmit"
            @submit="submit"
            class="space-y-6"
            novalidate
        >
            <div>
                <x-ui.label class="text-center block mb-4">Verification code</x-ui.label>
                <x-ui.otp-input name="code" :length="6" />
            </div>

            <x-auth.submit-button loading-text="Verifying...">
                Verify
            </x-auth.submit-button>
        </form>

        <div
            x-data="countdown(60)"
            class="mt-6 text-center space-y-3"
        >
            <p class="text-sm text-secondary/50 dark:text-white/50">
                <template x-if="!expired">
                    <span>Resend code in <span class="font-medium text-secondary dark:text-white" x-text="formatted"></span></span>
                </template>
                <template x-if="expired">
                    <span>Didn't receive a code?</span>
                </template>
            </p>

            <button
                type="button"
                @click="start()"
                :disabled="!expired"
                class="text-sm font-medium text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors disabled:opacity-40 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-primary/20 rounded px-2 py-1"
            >
                Resend code
            </button>
        </div>

        <p class="mt-8 text-center text-sm text-secondary/60 dark:text-white/60">
            <a
                href="{{ url('/login') }}"
                class="inline-flex items-center gap-1.5 font-medium text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20 rounded"
            >
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                Back to login
            </a>
        </p>
    </x-auth.card>
@endsection
