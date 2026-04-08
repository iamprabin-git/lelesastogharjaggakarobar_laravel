<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lele sasto ghar jagga karobar kendra </title>
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <script>
        (function () {
            try {
                var k = 're_theme';
                var t = localStorage.getItem(k);
                if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        })();
    </script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/legacy.ts'])
    @if (Auth::guard('agent')->user())
        <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
        <script>
            window.OneSignalDeferred = window.OneSignalDeferred || [];
            OneSignalDeferred.push(async function(OneSignal) {
                await OneSignal.init({
                    appId: "f29faee7-87f1-44f0-b855-88bd00868fca",
                });
            });
        </script>
    @endif
</head>

<body class="min-h-full bg-background font-sans text-foreground antialiased transition-colors">
    <x-header />

    <main class="min-h-[50vh]">
        @if (session('success'))
            <div class="container mx-auto px-4 pt-4">
                <div class="border-primary/20 bg-primary/5 text-foreground rounded-lg border px-4 py-3 text-sm"
                    role="status">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="container mx-auto px-4 pt-4">
                <div class="border-destructive/30 bg-destructive/10 text-destructive rounded-lg border px-4 py-3 text-sm"
                    role="alert">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        {{ $slot }}
    </main>
    <x-footer />
</body>

</html>
