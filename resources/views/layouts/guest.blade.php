<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 dark:bg-gray-950 flex items-center justify-center p-4 sm:p-6 lg:p-8 font-sans antialiased">
    <div class="w-full max-w-lg">
        <!-- Card -->
        <div class="bg-white dark:bg-gray-800/90 backdrop-blur-sm shadow-xl rounded-2xl border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
            <!-- Header / Branding -->
            <div class="px-8 pt-10 pb-6 text-center border-b border-gray-100 dark:border-gray-700/50">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-12 w-auto" />
                </a>
                <h1 class="mt-6 text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $title ?? 'Welcome' }}
                </h1>
                @if(isset($subtitle))
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>

            <!-- Form Content -->
            <div class="p-8 sm:p-10">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer links -->
        <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
            © {{ date('Y') }} {{ config('app.name') }} •
            <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400">Privacy</a> •
            <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400">Terms</a>
        </div>
    </div>
</body>
</html>
