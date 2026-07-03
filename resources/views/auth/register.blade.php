@extends('layouts.auth')

@section('content')
    <x-auth.card
        title="Create your account"
        subtitle="Join Smart Library and start managing your digital library today."
    >
        <form
            method="POST"
            action="{{ route('register') }}"
            x-data="formSubmit"
            @submit="submit"
            class="space-y-5"
        >
            @csrf

            @if ($errors->any())
                <div class="rounded-xl border border-danger/30 bg-danger/5 px-4 py-3 text-sm text-danger">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <x-ui.input
                label="Full name"
                name="name"
                type="text"
                placeholder="John Doe"
                autocomplete="name"
                :value="old('name')"
                :error="$errors->first('name')"
                required
            />

            <x-ui.input
                label="Email address"
                name="email"
                type="email"
                placeholder="you@example.com"
                autocomplete="email"
                :value="old('email')"
                :error="$errors->first('email')"
                required
            />

            <x-ui.password-input
                label="Password"
                name="password"
                placeholder="Create a strong password"
                autocomplete="new-password"
                hint="Min 8 characters with uppercase, lowercase, and a number"
                :error="$errors->first('password')"
                required
            />

            <x-ui.password-input
                label="Confirm password"
                name="password_confirmation"
                placeholder="Confirm your password"
                autocomplete="new-password"
                required
            />

            <x-ui.checkbox name="terms" id="terms" :checked="(bool) old('terms')" required>
                I agree to the
                <a href="#" class="text-primary hover:underline">Terms of Service</a>
                and
                <a href="#" class="text-primary hover:underline">Privacy Policy</a>
            </x-ui.checkbox>
            @error('terms')
                <x-ui.error-message>{{ $message }}</x-ui.error-message>
            @enderror

            <x-auth.submit-button loading-text="Creating account...">
                Create Account
            </x-auth.submit-button>
        </form>

        <p class="mt-8 text-center text-sm text-secondary/60 dark:text-white/60">
            Already have an account?
            <a
                href="{{ route('login') }}"
                class="font-medium text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20 rounded"
            >
                Login
            </a>
        </p>
    </x-auth.card>
@endsection
