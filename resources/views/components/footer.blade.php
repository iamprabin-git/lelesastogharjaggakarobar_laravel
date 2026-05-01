@php
    $company = \App\Models\Company::where('status', true)->first();
@endphp

<footer class="bg-gray-300 text-black dark:bg-gray-800 dark:text-white">

    {{-- Main Footer Content --}}
    <div class="container mx-auto grid grid-cols-1 gap-6 px-6 py-10 md:grid-cols-2 lg:grid-cols-4">

        {{-- Column 1: Company Info --}}
        <div class="pt-10">
            <div class="mb-4 flex items-center gap-3">
                @if ($company?->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}"
                        class="h-16 w-16 rounded-full border-2 border-black/20 object-cover dark:border-white/35">
                @endif
                <h2 class="text-2xl font-bold tracking-wide text-black dark:text-white">
                    {{ $company?->name ?? 'RealEstate' }}
                </h2>
            </div>

            <p class="text-sm leading-relaxed text-black/75 dark:text-white/80">
                We provide trusted real estate services including buying, selling, and renting properties with complete
                transparency and professionalism.
            </p>

            {{-- Social Icons --}}
            <div class="mt-6 flex flex-wrap gap-2">
                @if ($company?->facebook)
                    <a href="{{ $company->facebook }}" target="_blank" rel="noreferrer"
                        class="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                @endif

                @if ($company?->instagram)
                    <a href="{{ $company->instagram }}" target="_blank" rel="noreferrer"
                        class="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20">
                        <i class="fab fa-instagram"></i>
                    </a>
                @endif

                @if ($company?->viber)
                    <a href="{{ $company->viber }}" target="_blank" rel="noreferrer"
                        class="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                @endif

                @if ($company?->youtube)
                    <a href="{{ $company->youtube }}" target="_blank" rel="noreferrer"
                        class="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20">
                        <i class="fab fa-youtube"></i>
                    </a>
                @endif

                @if ($company?->tiktok)
                    <a href="{{ $company->tiktok }}" target="_blank" rel="noreferrer"
                        class="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20">
                        <i class="fab fa-tiktok"></i>
                    </a>
                @endif
                @if ($company?->whatsapp)
                    <a href="{{ $company->whatsapp }}" target="_blank" rel="noreferrer"
                        class="rounded-full bg-black/10 p-2 text-black transition-colors hover:bg-black/15 dark:bg-white/10 dark:text-white dark:hover:bg-white/20">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                @endif
            </div>
        </div>

        {{-- Column 2: Quick Links --}}
        <div class="pt-10">
            <h3 class="mb-6 border-b border-black/20 pb-2 text-xl font-semibold text-black dark:border-white/25 dark:text-white">
                About Company
            </h3>

            <ul class="space-y-3 text-sm text-black/85 dark:text-white/85">
                <li><a href="/" class="transition-colors hover:text-black dark:hover:text-white">Home</a></li>
                <li><a href="/properties" class="transition-colors hover:text-black dark:hover:text-white">Properties</a></li>
                <li><a href="{{ route('properties.sold') }}" class="transition-colors hover:text-black dark:hover:text-white">Sold properties</a></li>
                <li><a href="{{ route('agents.index') }}" class="transition-colors hover:text-black dark:hover:text-white">Agent list</a></li>
                <li><a href="/agent-form" class="transition-colors hover:text-black dark:hover:text-white">Become an agent</a></li>
                <li><a href="/about" class="transition-colors hover:text-black dark:hover:text-white">About Us</a></li>
                <li><a href="/contact" class="transition-colors hover:text-black dark:hover:text-white">Contact</a></li>
            </ul>
        </div>

        {{-- Column 3: Property Types --}}
        <div class="pt-10">
            <h3 class="mb-6 border-b border-black/20 pb-2 text-xl font-semibold text-black dark:border-white/25 dark:text-white">
                Quick Links
            </h3>

            <ul class="space-y-3 text-sm text-black/85 dark:text-white/85">
                <li><a href="/faqs" class="transition-colors hover:text-black dark:hover:text-white">FAQs</a></li>
                <li><a href="/blogs" class="transition-colors hover:text-black dark:hover:text-white">Blog</a></li>
                <li><a href="/pricing" class="transition-colors hover:text-black dark:hover:text-white">Pricing</a></li>
                <li><a href="/home-loan" class="transition-colors hover:text-black dark:hover:text-white">Home Loan</a></li>
                <li><a href="/privacy-policy" class="transition-colors hover:text-black dark:hover:text-white">Privacy Policy</a></li>
                <li><a href="/terms" class="transition-colors hover:text-black dark:hover:text-white">Terms & Conditions</a></li>
            </ul>
        </div>

        {{-- Column 4: Contact + Newsletter --}}
        <div class="pt-10">
            <h3 class="mb-6 border-b border-black/20 pb-2 text-xl font-semibold text-black dark:border-white/25 dark:text-white">
                Contact Us
            </h3>

            <ul class="space-y-3 text-sm text-black/85 dark:text-white/85">
                <li class="flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-black dark:text-white" aria-hidden="true"></i>
                    {{ $company->address ?? 'Your Address Here' }}
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-solid fa-phone text-black dark:text-white" aria-hidden="true"></i>
                    {{ $company?->phone ?? '+977-9765726294' }} (What's App only)
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-solid fa-envelope text-black dark:text-white" aria-hidden="true"></i>
                    {{ $company?->email ?? 'info@realestate.com' }}
                </li>
            </ul>

            <div class="mt-6 rounded-2xl border border-black/20 p-6 dark:border-white/25">
                <h4 class="mb-3 font-semibold text-black dark:text-white">Join Our WhatsApp Community</h4>
                <a href="https://chat.whatsapp.com/YOUR_GROUP_INVITE_LINK" target="_blank" rel="noopener noreferrer"
                    class="flex w-full items-center justify-center rounded-md bg-green-600 p-3 font-medium text-white transition hover:bg-green-700">
                    <i class="fab fa-whatsapp mr-2 text-xl"></i>
                    Join WhatsApp Community
                </a>
            </div>
        </div>

    </div>

    {{-- Bottom Footer --}}
    <div
        class="container mx-auto flex flex-col items-center justify-between gap-3 border-t border-black/15 px-4 py-3 text-sm text-black/70 dark:border-white/15 dark:text-white/70 md:flex-row">

        <div class="text-center md:text-left">
            © {{ date('Y') }} {{ $company?->name ?? 'RealEstate' }}. All rights reserved.
        </div>

        <div class="text-center md:text-right">
            Developed by
            <a href="https://dangolprabin.com.np" target="_blank" rel="noopener noreferrer"
                class="cursor-pointer font-semibold text-black underline-offset-4 hover:underline dark:text-white">
                Prabin Dangol
            </a>
        </div>

    </div>

</footer>
