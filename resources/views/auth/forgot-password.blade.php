<x-guest-layout :title="__('Reset password')" :subtitle="__('We will email you a link to choose a new password.')">
    <p class="text-muted-foreground mb-6 text-sm leading-relaxed">
        {{ __('Forgot your password? No problem. Enter your email and we will send a reset link.') }}
    </p>

    <x-auth-session-status class="mb-4 text-sm" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-end">
            <x-primary-button class="w-full sm:w-auto">
                {{ __('Email reset link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
