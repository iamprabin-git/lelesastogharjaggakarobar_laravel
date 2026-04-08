<x-guest-layout title="Create your account" subtitle="Join and start exploring real estate opportunities">
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Full name')" />
            <x-text-input id="name" class="mt-2 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email address')" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm password')" />
            <x-text-input
                id="password_confirmation"
                class="mt-2 block w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <a
            href="{{ route('google.login') }}"
            class="border-input bg-background text-foreground hover:bg-accent inline-flex w-full items-center justify-center gap-3 rounded-md border px-4 py-2.5 text-sm font-medium shadow-xs transition-colors focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50"
        >
            <svg class="size-5" viewBox="0 0 24 24" aria-hidden="true">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.51h5.84c-.25 1.31-.98 2.42-2.07 3.16v2.63h3.35c1.96-1.81 3.09-4.47 3.09-7.8z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-1.01 7.28-2.73l-3.35-2.63c-1.01.68-2.29 1.08-3.93 1.08-3.02 0-5.58-2.04-6.49-4.79H.96v2.67C2.75 20.94 6.98 23 12 23z"/>
                <path fill="#FBBC05" d="M5.51 14.21c-.23-.68-.36-1.41-.36-2.21s.13-1.53.36-2.21V7.34H.96C.35 8.85 0 10.39 0 12s.35 3.15.96 4.66l4.55-2.45z"/>
                <path fill="#EA4335" d="M12 4.98c1.64 0 3.11.56 4.27 1.66l3.19-3.19C17.46 1.01 14.97 0 12 0 6.98 0 2.75 2.06.96 5.34l4.55 2.45C6.42 5.02 8.98 4.98 12 4.98z"/>
            </svg>
            {{ __('Sign up with Google') }}
        </a>

        <div class="border-border flex flex-col gap-4 border-t pt-6 sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ route('login') }}" class="text-primary text-sm font-medium hover:underline">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="sm:w-auto">
                {{ __('Create account') }}
            </x-primary-button>
        </div>

        <p class="text-muted-foreground text-center text-xs">
            By signing up, you agree to our
            <a href="{{ route('terms') }}" class="text-primary hover:underline">Terms</a>
            and
            <a href="{{ route('privacy.policy') }}" class="text-primary hover:underline">Privacy</a>.
        </p>
    </form>
</x-guest-layout>
