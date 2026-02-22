@php
    $company = \App\Models\Company::where('status', true)->first();
@endphp

<header class="w-full fixed top-0 z-50 transition-all duration-300 bg-white shadow-md" id="mainHeader">

    {{-- Top Contact Bar --}}
    <div class="bg-green-400 text-white text-sm py-2 px-6 hidden md:flex justify-between items-center">
        <div class="flex items-center gap-6">
            <span><i class="fa-solid fa-phone"></i> {{ $company->phone ?? '+977-9765726294' }}</span>
            <span><i class="fa-solid fa-envelope"></i> {{ $company->email ?? 'info.lelesastogharjaggakarobar@gmail.com' }}</span>
        </div>

        <div class="flex items-center gap-4">
            @if ($company?->facebook)
                <a href="{{ $company->facebook }}" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-facebook"></i></a>
            @endif
            @if ($company?->instagram)
                <a href="{{ $company->instagram }}" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-instagram"></i></a>
            @endif
            @if ($company?->youtube)
                <a href="{{ $company->youtube }}" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-youtube"></i></a>
            @endif

            @if ($company?->tiktok)
                <a href="{{ $company->tiktok }}" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-tiktok"></i></a>
            @endif

            @if ($company?->whatsapp)
                <a href="{{ $company->whatsapp }}" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-whatsapp"></i></a>
            @endif
        </div>
    </div>

    {{-- Main Navigation --}}
    <div class="container mx-auto flex justify-between items-center py-6 px-4">

        {{-- Logo --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="flex items-center gap-3 mb-4 hover:opacity-80 transition">
                @if ($company?->logo)
                    <img src="{{ Storage::url($company->logo) }}"
                        class="h-16 w-16 rounded-full object-cover border-2 border-white" alt="{{ $company->name }}">
                @endif
                <h2 class="text-2xl font-bold tracking-wide text-gray-900">
                    {{ $company->name ?? 'RealEstate' }}
                </h2>
            </a>

        </div>

        {{-- Desktop Menu --}}
        <nav class="hidden md:flex items-center gap-8 font-medium text-gray-700">
            <a href="/" class="hover:text-yellow-500 transition">Home</a>
            <a href="/properties" class="hover:text-yellow-500 transition">Properties</a>
            <a href="/about" class="hover:text-yellow-500 transition">About</a>
            <a href="/contact" class="hover:text-yellow-500 transition">Contact</a>

            {{-- CTA Button --}}
            <a href="/agent/login"
                class="bg-yellow-500 text-white px-5 py-2 rounded-full shadow hover:bg-yellow-600 transition">
                + Add Property
            </a>
        </nav>

        {{-- Mobile Button --}}
        <button id="menuBtn" class="md:hidden text-gray-800 text-2xl">
            ☰
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="hidden md:hidden bg-white shadow-lg">
        <div class="flex flex-col p-6 gap-4 text-gray-700 font-medium">
            <a href="/" class="hover:text-yellow-500">Home</a>
            <a href="/properties" class="hover:text-yellow-500">Properties</a>
            <a href="/about" class="hover:text-yellow-500">About</a>
            <a href="/contact" class="hover:text-yellow-500">Contact</a>
            <a href="/agent" class="bg-yellow-500 text-white text-center py-2 rounded-full">
                + Add Property
            </a>
        </div>
    </div>
</header>

{{-- Spacer for fixed header --}}
<div class="h-32 md:h-28"></div>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
