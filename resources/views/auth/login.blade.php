@extends('layouts.auth')

@section('content')
    <x-auth.card
        title="Welcome back"
        subtitle="Sign in to your Smart Library account to continue."
    >
        <form
            method="POST"
            action="{{ route('login') }}"
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
                placeholder="Enter your password"
                :error="$errors->first('password')"
                required
            />

            <div class="flex items-center justify-between gap-4">
                <x-ui.checkbox name="remember" id="remember" :checked="old('remember')">
                    Remember me
                </x-ui.checkbox>

                <a
                    href="{{ route('password.request') }}"
                    class="text-sm font-medium text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20 rounded"
                >
                    Forgot password?
                </a>
            </div>

            <x-auth.submit-button loading-text="Signing in...">
                Sign In
            </x-auth.submit-button>

            <x-ui.divider />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <x-ui.social-button provider="google" />
                <x-ui.social-button provider="github" />
            </div>
        </form>

        <p class="mt-8 text-center text-sm text-secondary/60 dark:text-white/60">
            Don't have an account?
            <a
                href="{{ route('register') }}"
                class="font-medium text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20 rounded"
            >
                Register
            </a>
        </p>
    </x-auth.card>
@endsection
