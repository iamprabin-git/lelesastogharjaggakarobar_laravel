@php
$company = \App\Models\Company::where('status', true)->first();
@endphp

<footer class="text-white mt-20"
        style="background: linear-gradient(135deg, {{ $company->primary_color ?? '#111827' }}, {{ $company->secondary_color ?? '#1f2937' }});">

    {{-- Main Footer Content --}}
    <div class="container mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

        {{-- Column 1: Company Info --}}
        <div>
            <div class="flex items-center gap-3 mb-4">
                @if($company?->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}"
                         class="h-16 w-16 rounded-full object-cover border-2 border-white">
                @endif
                <h2 class="text-2xl font-bold tracking-wide">
                    {{ $company->name ?? 'RealEstate' }}
                </h2>
            </div>

            <p class="text-gray-200 leading-relaxed text-sm">
                We provide trusted real estate services including buying, selling, and renting properties with complete transparency and professionalism.
            </p>

            {{-- Social Icons --}}
            <div class="flex gap-4 mt-6 border rounded-lg p-1">
                @if($company?->facebook)
                    <a href="{{ $company->facebook }}" target="_blank"
                       class="bg-blue bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                @endif

                @if($company?->instagram)
                    <a href="{{ $company->instagram }}" target="_blank"
                       class="bg-red bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                @endif

                @if($company?->viber)
                    <a href="{{ $company->viber }}" target="_blank"
                       class="bg-white bg-opacity-20 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                @endif

                @if($company?->youtube)
                    <a href="{{ $company->youtube }}" target="_blank"
                       class="bg-red bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif

                @if($company?->tiktok)
                 <a href="{{ $company->tiktok }}" target="_blank"
                       class="bg-red bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-tiktok"></i>
                    </a>
                @endif
                @if($company?->whatsapp)
                 <a href="{{ $company->whatsapp }}" target="_blank"
                       class="bg-red bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-tiktok"></i>
                    </a>
                @endif
            </div>
        </div>

        {{-- Column 2: Quick Links --}}
        <div>
            <h3 class="text-xl font-semibold mb-6 border-b border-white pb-2">
                About Company
            </h3>

            <ul class="space-y-3 text-gray-200 text-sm">
                <li><a href="/" class="hover:text-yellow-400 transition">Home</a></li>
                <li><a href="/properties" class="hover:text-yellow-400 transition">Properties</a></li>
                <li><a href="/agent-form" class="hover:text-yellow-400 transition">Agents</a></li>
                <li><a href="/about" class="hover:text-yellow-400 transition">About Us</a></li>
                <li><a href="/contact" class="hover:text-yellow-400 transition">Contact</a></li>
            </ul>
        </div>

        {{-- Column 3: Property Types --}}
        <div>
            <h3 class="text-xl font-semibold mb-6 border-b border-white pb-2">
                Quick Links
            </h3>

            <ul class="space-y-3 text-gray-200 text-sm">
                <li><a href="/faqs" class="hover:text-yellow-400 transition">FAQs</a></li>
                <li><a href="/blogs" class="hover:text-yellow-400 transition">Blog</a></li>
                <li><a href="/pricing" class="hover:text-yellow-400 transition">Pricing</a></li>
                <li><a href="/home-loan" class="hover:text-yellow-400 transition">Home Loan</a></li>
                <li><a href="/privacy-policy" class="hover:text-yellow-400 transition">Privacy Policy</a></li>
                <li><a href="/terms" class="hover:text-yellow-400 transition">Terms & Conditions</a></li>

            </ul>
        </div>

        {{-- Column 4: Contact + Newsletter --}}
        <div>
            <h3 class="text-xl font-semibold mb-6 border-b border-white pb-2">
                Contact Us
            </h3>

            <ul class="space-y-3 text-gray-200 text-sm">
                <li class="flex items-center gap-2"><i class="fa-solid fa-location-dot"></i> {{ $company->address ?? 'Your Address Here' }}</li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-phone"></i> {{ $company->phone ?? '+977-9765726294' }} (What's App only)</li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-envelope"></i>{{ $company->email ?? 'info@realestate.com' }}</li>
            </ul>

            {{-- Newsletter --}}
            <div class="mt-6">
                <h4 class="font-semibold mb-3">Subscribe Newsletter</h4>
                <form class="flex">
                    <input type="email" placeholder="Your email"
                           class="w-full px-3 py-2 rounded-l-md text-gray-800 focus:outline-none">
                    <button type="submit"
                            class="bg-yellow-500 px-4 rounded-r-md hover:bg-yellow-600 transition">
                        ➤
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- Bottom Footer --}}
    <div class="container mx-auto px-4 py-18 flex flex-col md:flex-row justify-between items-center text-sm text-gray-300 bg-gray-900 bg-opacity-50 rounded-t-lg">

        {{-- Left Side --}}
        <div class="text-center md:text-left">
            © {{ date('Y') }} {{ $company->name ?? 'RealEstate' }}. All rights reserved.
        </div>

        {{-- Right Side --}}
        <div class="text-center md:text-right">
            Developed by
            <span class="font-semibold hover:underline cursor-pointer">
                <a href="https://dangolprabin.com.np" target="_blank">Prabin Dangol</a>
            </span>
        </div>

    </div>

</footer>
