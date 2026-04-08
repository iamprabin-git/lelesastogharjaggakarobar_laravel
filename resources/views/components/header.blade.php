@php
    $company = \App\Models\Company::where('status', true)->first();
@endphp

<header
    class="w-full fixed top-0 z-50 transition-all duration-300 border-b border-zinc-200/70 bg-white/95 shadow-none backdrop-blur-md dark:border-zinc-800/70 dark:bg-zinc-950/95"
    id="mainHeader">

    {{-- Top contact bar — Filament primary (orange) --}}
    <div
        class="hidden items-center justify-between bg-primary px-4 py-2 text-sm text-primary-foreground md:flex md:px-6">
        <div class="flex flex-wrap items-center gap-4 md:gap-6">
            <span><i class="fa-solid fa-phone"></i> {{ $company?->phone ?? '+977-9765726294' }}</span>
            <span class="break-all"><i class="fa-solid fa-envelope"></i>
                {{ $company?->email ?? 'info.lelesastogharjaggakarobar@gmail.com' }}</span>
        </div>

        <div class="flex items-center gap-3 md:gap-4">
            @if ($company?->facebook)
                <a href="{{ $company->facebook }}" target="_blank" rel="noopener noreferrer"
                    class="transition hover:opacity-80"><i class="fa-brands fa-facebook"></i></a>
            @endif
            @if ($company?->instagram)
                <a href="{{ $company->instagram }}" target="_blank" rel="noopener noreferrer"
                    class="transition hover:opacity-80"><i class="fa-brands fa-instagram"></i></a>
            @endif
            @if ($company?->youtube)
                <a href="{{ $company->youtube }}" target="_blank" rel="noopener noreferrer"
                    class="transition hover:opacity-80"><i class="fa-brands fa-youtube"></i></a>
            @endif
            @if ($company?->tiktok)
                <a href="{{ $company->tiktok }}" target="_blank" rel="noopener noreferrer"
                    class="transition hover:opacity-80"><i class="fa-brands fa-tiktok"></i></a>
            @endif
            @if ($company?->whatsapp)
                <a href="{{ $company->whatsapp }}" target="_blank" rel="noopener noreferrer"
                    class="transition hover:opacity-80"><i class="fa-brands fa-whatsapp"></i></a>
            @endif

            <button type="button" id="themeToggle"
                class="ml-2 inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/30 text-lg transition hover:bg-white/10"
                aria-label="Toggle dark mode" title="Light / dark">
                <span class="dark:hidden"><i class="fa-solid fa-moon"></i></span>
                <span class="hidden dark:inline"><i class="fa-solid fa-sun"></i></span>
            </button>
        </div>
    </div>

    {{-- Main Navigation --}}
    <div class="container mx-auto flex flex-wrap items-center justify-between gap-3 px-4 py-4 md:py-5">

        <div class="flex min-w-0 flex-1 items-center gap-3 md:flex-none">
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3 hover:opacity-80">
                @if ($company?->logo)
                    <img src="{{ Storage::url($company->logo) }}"
                        class="h-12 w-12 shrink-0 rounded-full border-2 border-zinc-200 object-cover dark:border-zinc-600 md:h-16 md:w-16"
                        alt="{{ $company->name }}">
                @endif
                <h2 class="truncate text-lg font-bold tracking-wide text-zinc-900 dark:text-zinc-50 md:text-2xl">
                    {{ $company?->name ?? 'RealEstate' }}
                </h2>
            </a>
        </div>

        <div class="flex items-center gap-2 md:hidden">
            <button type="button" id="themeToggleMobile"
                class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-zinc-300 text-zinc-800 dark:border-zinc-600 dark:text-zinc-100"
                aria-label="Toggle dark mode">
                <span class="dark:hidden"><i class="fa-solid fa-moon"></i></span>
                <span class="hidden dark:inline"><i class="fa-solid fa-sun"></i></span>
            </button>
            <button type="button" id="menuBtn"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-zinc-300 text-2xl text-zinc-800 dark:border-zinc-600 dark:text-zinc-100"
                aria-expanded="false" aria-controls="mobileMenu">
                ☰
            </button>
        </div>

        <nav class="hidden items-center gap-6 font-medium text-zinc-700 dark:text-zinc-300 md:flex lg:gap-8">
            <a href="{{ route('home') }}" class="transition hover:text-primary dark:hover:text-primary">Home</a>
            <a href="{{ route('properties.index') }}"
                class="transition hover:text-primary dark:hover:text-primary">Properties</a>
            <a href="{{ route('about') }}" class="transition hover:text-primary dark:hover:text-primary">About</a>
            <a href="{{ route('contact') }}"
                class="transition hover:text-primary dark:hover:text-primary">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="transition hover:text-primary dark:hover:text-primary">Dashboard</a>
            @endauth
            <a href="{{ url('/agent/login') }}"
                class="rounded-full bg-primary px-5 py-2 text-primary-foreground shadow-xs transition hover:bg-primary/90">
                + Add Property
            </a>
        </nav>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="hidden border-t border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 md:hidden"
        role="navigation">
        <div class="flex flex-col gap-1 p-4 font-medium text-zinc-700 dark:text-zinc-300">
            <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-800">Home</a>
            <a href="{{ route('properties.index') }}"
                class="rounded-lg px-3 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-800">Properties</a>
            <a href="{{ route('about') }}"
                class="rounded-lg px-3 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-800">About</a>
            <a href="{{ route('contact') }}"
                class="rounded-lg px-3 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-800">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="rounded-lg px-3 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-800">Dashboard</a>
            @endauth
            <a href="{{ url('/agent/login') }}"
                class="mt-2 rounded-full bg-primary py-3 text-center text-primary-foreground shadow-xs hover:bg-primary/90">
                + Add Property
            </a>
        </div>
    </div>
</header>

{{-- Spacer for fixed header --}}
<div class="h-[7.5rem] md:h-36 lg:h-32"></div>

<script>
    (function () {
        function bindToggle(btn) {
            if (!btn) return;
            btn.addEventListener('click', function () {
                var root = document.documentElement;
                root.classList.toggle('dark');
                try {
                    localStorage.setItem('re_theme', root.classList.contains('dark') ? 'dark' : 'light');
                } catch (e) {}
            });
        }
        bindToggle(document.getElementById('themeToggle'));
        bindToggle(document.getElementById('themeToggleMobile'));

        var menuBtn = document.getElementById('menuBtn');
        var mobileMenu = document.getElementById('mobileMenu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function () {
                var open = mobileMenu.classList.toggle('hidden') === false;
                menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
        }
    })();
</script>
