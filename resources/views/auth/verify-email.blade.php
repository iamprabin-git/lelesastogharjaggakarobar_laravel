<x-guest-layout :title="__('Verify email')" :subtitle="__('We sent a link to your inbox.')">
    <p class="text-muted-foreground mb-6 text-sm leading-relaxed">
        {{ __('Thanks for signing up! Please verify your email using the link we sent. If you did not receive it, you can request another.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-emerald-600 dark:text-emerald-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full sm:w-auto">
                {{ __('Resend verification email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="text-muted-foreground hover:text-foreground w-full text-sm underline-offset-4 transition-colors hover:underline sm:w-auto"
            >
                {{ __('Log out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
