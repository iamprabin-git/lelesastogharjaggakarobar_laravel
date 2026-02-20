<x-frontend-layout>

<section class="relative text-white h-75 md:h-75 flex items-center">
    {{-- Background Image --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/price-hero.jpg') }}" class="w-full h-full object-cover opacity-90" alt="Hero Background">
    </div>

    {{-- Content --}}
    <div class="container mx-auto px-6 text-center relative max-w-3xl">
        {{-- Headline --}}
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            आफ्नो घर जग्गा 0% कमिसनमा तुरुन्त बिक्रि गर्नुहोस
        </h1>

        {{-- Description --}}
        <p class="text-gray-200 mb-6">
            Our personalised property promotion techniques & team of real estate experts will help you to sell or rent your properties instantly.
        </p>

        {{-- Customer Care --}}
        <p class="font-semibold">
            Customer Care:
            <a href="tel:9851155216" class="text-yellow-500 hover:underline">
                +977-9765726294 | Message us on whatsapp only
            </a>
        </p>
    </div>
</section>




{{-- Plans Section --}}
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-8">Advertisement Plans & Pricing</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Free Plan --}}
            <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between border-2 border-green-500">
                <h3 class="text-xl font-bold mb-2">Free Plan</h3>
                <p class="text-2xl font-semibold mb-4">Rs. 0</p>
                <ul class="text-gray-600 mb-4 text-left list-disc list-inside">
                    <li>1 month listing duration</li>
                    <li>Basic property listing</li>
                    <li>High quality images of property</li>
                    <li>Reach limited visitors</li>
                </ul>
                <a href="/qr"
                   class="mt-auto inline-block bg-green-500 text-white px-6 py-3 rounded font-semibold hover:bg-green-600">
                    Start my ads
                </a>
            </div>

            {{-- Featured Plan --}}
            <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between border-2 border-yellow-500">
                <h3 class="text-xl font-bold mb-2">Featured Plan</h3>
                <p class="text-2xl font-semibold mb-4">Rs. 6,000</p>
                <ul class="text-gray-600 mb-4 text-left list-disc list-inside">
                    <li>4 months listing duration</li>
                    <li>2 weeks Facebook sponsored promotion</li>
                    <li>High quality images of property</li>
                    <li>Walkthrough Video promotion</li>
                    <li>Potential customer referral / Access to Demands</li>
                    <li>Full Social media promotion</li>
                </ul>
                <a href="/qr"
                   class="mt-auto inline-block bg-yellow-500 text-white px-6 py-3 rounded font-semibold hover:bg-yellow-600">
                    Start my ads
                </a>
            </div>

            {{-- Premium Plan --}}
            <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between border-2 border-gray-300">
                <h3 class="text-xl font-bold mb-2">Premium Plan</h3>
                <p class="text-2xl font-semibold mb-4">Rs. 12,000</p>
                <ul class="text-gray-600 mb-4 text-left list-disc list-inside">
                    <li>Unlimited listing duration</li>
                    <li>1 month Facebook sponsored promotion</li>
                    <li>Inquiry handling & time management</li>
                    <li>Potential customer referral / Access to Demands</li>
                    <li>High quality images of property</li>
                    <li>Suitable for Urgent sale</li>
                    <li>Walkthrough Video promotion</li>
                    <li>Full Social media promotion</li>
                </ul>
                <a href="/qr"
                   class="mt-auto inline-block bg-yellow-500 text-white px-6 py-3 rounded font-semibold hover:bg-yellow-600">
                    Start my ads
                </a>
            </div>

            {{-- Pro Plan --}}
            <div class="bg-white shadow rounded-lg p-6 flex flex-col justify-between border-2 border-gray-300">
                <h3 class="text-xl font-bold mb-2">Pro Plan</h3>
                <p class="text-2xl font-semibold mb-4">Rs. 18,000</p>
                <ul class="text-gray-600 mb-4 text-left list-disc list-inside">
                    <li>Suitable for Agents / Agencies</li>
                    <li>Unlimited listing duration</li>
                    <li>1.5 months Facebook sponsored promotion</li>
                    <li>Inquiry handling & time management</li>
                    <li>Access to demands & recommendations</li>
                    <li>High quality images of property</li>
                    <li>Suitable for Urgent sale</li>
                    <li>Walkthrough Video promotion</li>
                    <li>Full Social media promotion</li>
                    <li>Suitable for high end & large properties</li>
                </ul>
                <a href="/qr"
                   class="mt-auto inline-block bg-yellow-500 text-white px-6 py-3 rounded font-semibold hover:bg-yellow-600">
                    Start my ads
                </a>
            </div>

        </div>
    </div>
</section>

</x-frontend-layout>
