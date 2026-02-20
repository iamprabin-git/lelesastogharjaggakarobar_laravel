<x-frontend-layout>
<section class="py-10 rounded-3xl">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-4">Find Your Dream Property</h2>
        <x-property-search />
        {{-- Properties Grid Here --}}
    </div>
</section>


<!-- Agent Registration Section -->
<section class="container py-20 text-center space-y-10">
    <h1 class="text-2xl font-bold">Agent Registration</h1>
    <p>Please fill out the form below to register as an agent.</p>

    <a href="/agent-form" class="inline-block bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition">
        Register as Agent
    </a>
</section>



<!-- ABOUT SECTION -->
@php
    $about = \App\Models\AboutSection::first();
@endphp

@if($about)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 gap-12 items-center">

            {{-- Left Image --}}
            @if($about->about_image)
            <div class="relative">
                <img
                    src="{{ asset('storage/'.$about->about_image) }}"
                    class="rounded-3xl shadow-2xl w-full h-125 object-cover">

                {{-- Experience Badge --}}
                <div class="absolute -bottom-6 -right-6 bg-primary text-white px-6 py-4 rounded-2xl shadow-xl">
                    <h3 class="text-2xl font-bold">
                        {{ $about->experience_years }}+
                    </h3>
                    <p class="text-sm">Years Experience</p>
                </div>
            </div>
            @endif

            {{-- Right Content --}}
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    {{ $about->hero_title }}
                </h2>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    {{ \Illuminate\Support\Str::limit($about->hero_description, 250) }}
                </p>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-6 mb-8">

                    <div class="text-center bg-white p-6 rounded-2xl shadow-md">
                        <h3 class="text-2xl font-bold text-primary">
                            {{ $about->properties_sold }}+
                        </h3>
                        <p class="text-sm text-gray-500">
                            Properties Sold
                        </p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-2xl shadow-md">
                        <h3 class="text-2xl font-bold text-primary">
                            {{ $about->happy_clients }}+
                        </h3>
                        <p class="text-sm text-gray-500">
                            Happy Clients
                        </p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-2xl shadow-md">
                        <h3 class="text-2xl font-bold text-primary">
                            {{ $about->experience_years }}+
                        </h3>
                        <p class="text-sm text-gray-500">
                            Years Experience
                        </p>
                    </div>

                </div>

                {{-- Read More Button --}}
                <a href="{{ route('about') }}"
                   class="inline-block bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-xl font-semibold shadow-lg transition duration-300">
                    Read More →
                </a>

            </div>

        </div>

    </div>
</section>
@endif


<!-- Latest Properties Section -->
<section class="container mx-auto py-15 px-6">
    <h2 class="text-2xl font-bold mb-4 p-3 bg-green-600 text-white text-center">Latest Properties</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($latestProperties as $property)
            <div class="relative bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                <!-- Rent/Buy Badge -->
                <div class="absolute top-3 left-3 bg-blue-600 text-white text-xs px-3 py-1 rounded-full capitalize">
                    {{ $property->type }}
                </div>

                <!-- Property ID -->
                <div class="absolute top-3 right-3 bg-black/70 text-white text-xs px-3 py-1 rounded">
                    ID: {{ $property->id }}
                </div>

                <!-- Property Image -->
                <img src="{{ isset($property->images[0]) ? asset('storage/'.$property->images[0]) : asset('images/placeholder.png') }}"
                     alt="{{ $property->title }}"
                     class="w-full h-48 object-cover">

                <!-- Card Body -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-1">{{ $property->title }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $property->location ?? $property->city }}</p>
                    <p class="text-blue-600 font-bold text-lg">
                        Rs. {{ number_format($property->price, 2) }}
                        <span class="text-sm text-gray-500"></span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-6">
    <a href="/properties"
       class="inline-block bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition">
        See all latest properties
    </a>
</div>

</section>
<!-- ================= CALL TO ACTION ================= -->
<section class="py-20 bg-primary text-white text-center">
    <div class="container mx-auto px-6">

        <h2 class="text-4xl font-bold mb-6">
            Ready to Find Your Dream Property?
        </h2>

        <p class="mb-8 text-lg">
            Let our expert team guide you every step of the way.
        </p>

        <a href="{{ route('contact') }}"
           class="bg-white text-primary px-8 py-4 rounded-full font-semibold shadow-lg hover:bg-gray-100 transition">
            Contact Us
        </a>

    </div>
</section>
{{-- advertisement section here --}}
<x-advertisement />

{{-- google reviews section here --}}
@if(isset($reviews) && $reviews->count())
<section class="py-24 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <div class="flex justify-center items-center gap-3 mb-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg"
                     class="h-8" alt="Google Logo">

                <span class="text-3xl font-bold text-gray-800">
                    {{ number_format($averageRating, 1) }}
                </span>

                <span class="text-yellow-400 text-xl">
                    {{ str_repeat('★', round($averageRating)) }}
                </span>
            </div>

            <p class="text-gray-600">
                Based on {{ $totalReviews }} Google Reviews
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($reviews as $review)
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                    <div class="text-yellow-400 mb-4 text-lg">
                        {{ str_repeat('★', $review->rating) }}
                    </div>

                    <p class="text-gray-600 mb-6 line-clamp-4">
                        "{{ $review->text }}"
                    </p>

                    <div class="flex items-center gap-4">
                        <img src="{{ $review->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($review->author_name) }}"
                             class="w-12 h-12 rounded-full object-cover"
                             alt="{{ $review->author_name }}">

                        <div>
                            <h4 class="font-semibold text-gray-900">
                                {{ $review->author_name }}
                            </h4>
                            <p class="text-sm text-gray-500">Google Review</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-14">
            <a href="https://www.google.com/maps"
               target="_blank"
               class="inline-block bg-yellow-500 text-white px-8 py-3 rounded-xl font-semibold hover:bg-yellow-600 transition">
                View All Reviews on Google
            </a>
        </div>
    </div>
</section>
@endif



</x-frontend-layout>
