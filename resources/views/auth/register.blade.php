<x-guest-layout>
    <div class="min-h-screen bg-linear-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-950 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-lg">
            <!-- Card -->
            <div class="bg-white/85 dark:bg-gray-800/85 backdrop-blur-xl shadow-2xl rounded-2xl border border-white/30 dark:border-gray-700/40 overflow-hidden transition-all duration-300 hover:shadow-3xl">
                <!-- Header -->
                <div class="px-8 pt-10 pb-6 text-center border-b border-gray-100 dark:border-gray-700/50">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-14 w-auto" />
                    </a>
                    <h1 class="mt-6 text-3xl font-bold text-gray-900 dark:text-white tracking-tight">
                        Create Your Account
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        Join and start exploring real estate opportunities
                    </p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="px-8 pb-10 pt-6 space-y-6">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 dark:text-gray-300 font-medium" />
                        <x-text-input
                            id="name"
                            class="block mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition duration-150"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 dark:text-red-400 text-sm" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 font-medium" />
                        <x-text-input
                            id="email"
                            class="block mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition duration-150"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autocomplete="username"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 dark:text-red-400 text-sm" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 font-medium" />
                        <x-text-input
                            id="password"
                            class="block mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition duration-150"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-400 text-sm" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-300 font-medium" />
                        <x-text-input
                            id="password_confirmation"
                            class="block mt-2 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition duration-150"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 dark:text-red-400 text-sm" />
                    </div>

                    <!-- Google Signup -->
                    <div class="pt-4">
                        <a
                            href="{{ route('google.login') }}"
                            class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow transition-all duration-200"
                        >
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.51h5.84c-.25 1.31-.98 2.42-2.07 3.16v2.63h3.35c1.96-1.81 3.09-4.47 3.09-7.8z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-1.01 7.28-2.73l-3.35-2.63c-1.01.68-2.29 1.08-3.93 1.08-3.02 0-5.58-2.04-6.49-4.79H.96v2.67C2.75 20.94 6.98 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.51 14.21c-.23-.68-.36-1.41-.36-2.21s.13-1.53.36-2.21V7.34H.96C.35 8.85 0 10.39 0 12s.35 3.15.96 4.66l4.55-2.45z"/>
                                <path fill="#EA4335" d="M12 4.98c1.64 0 3.11.56 4.27 1.66l3.19-3.19C17.46 1.01 14.97 0 12 0 6.98 0 2.75 2.06.96 5.34l4.55 2.45C6.42 5.02 8.98 4.98 12 4.98z"/>
                            </svg>
                            {{ __('Sign up with Google') }}
                        </a>
                    </div>

                    <!-- Submit & Login link -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a
                            href="{{ route('login') }}"
                            class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 hover:underline transition duration-150"
                        >
                            {{ __('Already have an account? Sign in') }}
                        </a>

                        <x-primary-button class="bg-linear-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white shadow-lg px-6 py-2.5">
                            {{ __('Create Account') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <p class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                By signing up, you agree to our
                <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline">Terms of Service</a> and
                <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline">Privacy Policy</a>
            </p>
        </div>
    </div>
</x-guest-layout>
