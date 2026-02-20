<x-frontend-layout>

@php
$company = \App\Models\Company::where('status', true)->first();
@endphp

<!-- ================= HERO SECTION ================= -->
<section class="relative bg-gray-900 text-white py-28">
    <div class="absolute inset-0">
        <img src="/images/contact-hero.jpg"
             class="w-full h-full object-cover opacity-40"
             alt="Contact Hero">
    </div>

    <div class="relative container mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6">
            Contact Us
        </h1>
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200">
            We are here to help you find your dream property.
        </p>
    </div>
</section>

<!-- ================= CONTACT SECTION ================= -->
<section class="container mx-auto px-6 py-20 grid grid-cols-1 lg:grid-cols-2 gap-16">

    <!-- LEFT SIDE -->
    <div class="space-y-8">

        <!-- Address -->
        <div class="bg-white shadow-lg rounded-2xl p-6 flex gap-5 hover:shadow-xl transition">
            <div class="text-yellow-500 text-2xl">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Office Address</h3>
                <p class="text-gray-600">
                    {{ $company->address ?? 'Your office address here' }}
                </p>
            </div>
        </div>

        <!-- Phone -->
        <div class="bg-white shadow-lg rounded-2xl p-6 flex gap-5 hover:shadow-xl transition">
            <div class="text-yellow-500 text-2xl">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Phone Number</h3>
                <p class="text-gray-600">
                    {{ $company->phone ?? '+977-9765726294' }}
                </p>
                <span class="text-sm text-gray-500">(WhatsApp message only)</span>
            </div>
        </div>

        <!-- Email -->
        <div class="bg-white shadow-lg rounded-2xl p-6 flex gap-5 hover:shadow-xl transition">
            <div class="text-yellow-500 text-2xl">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Email Address</h3>
                <p class="text-gray-600">
                    {{ $company->email ?? 'info@realestate.com' }}
                </p>
            </div>
        </div>

        <!-- Social Icons -->
        <div class="flex flex-wrap gap-4 pt-4">
            @foreach(['facebook','instagram','viber','tiktok','youtube','whatsapp'] as $social)
                @if($company?->$social)
                    <a href="{{ $company->$social }}" target="_blank"
                       class="bg-gray-200 p-3 rounded-full hover:bg-yellow-500 hover:text-white transition">
                        <i class="fa-brands fa-{{ $social }}"></i>
                    </a>
                @endif
            @endforeach
        </div>

    </div>

    <!-- RIGHT SIDE - FORM -->
    <div class="bg-white shadow-2xl rounded-2xl p-10">

        <h2 class="text-3xl font-bold mb-8 text-gray-800">
            Send Us a Message
        </h2>

        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-2 font-medium">Full Name</label>
                <input type="text" name="name" required
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">
            </div>

            <div>
                <label class="block mb-2 font-medium">Email Address</label>
                <input type="email" name="email" required
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">
            </div>

            <div>
                <label class="block mb-2 font-medium">Phone Number</label>
                <input type="text" name="phone"
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">
            </div>

            <div>
                <label class="block mb-2 font-medium">Message</label>
                <textarea name="message" rows="4" required
                          class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none"></textarea>
            </div>

            <button type="submit"
                    class="w-full bg-yellow-500 text-white py-3 rounded-xl font-semibold hover:bg-yellow-600 transition duration-300">
                Send Message
            </button>
        </form>

    </div>

</section>

<!-- ================= GOOGLE MAP ================= -->
<section>
    <iframe
        src="https://maps.google.com/maps?q={{ urlencode($company->address ?? 'lele, lalitpur') }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
        class="w-full h-96"
        loading="lazy">
    </iframe>
</section>

</x-frontend-layout>
