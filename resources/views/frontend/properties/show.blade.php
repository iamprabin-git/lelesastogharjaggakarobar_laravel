<x-frontend-layout>

<section class="container mx-auto py-14">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

        <!-- LEFT SIDE: Main + Thumbnail Swiper -->
        <div class="lg:col-span-8 space-y-6">

            @if($property->images && count($property->images))
                <!-- Main Swiper -->
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        @foreach($property->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image) }}" class="w-full h-96 object-cover rounded-lg">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <!-- Thumbnail Swiper -->
                <div class="swiper thumbSwiper mt-2">
                    <div class="swiper-wrapper gap-3">
                        @foreach($property->images as $image)
                            <div class="swiper-slide cursor-pointer">
                                <img src="{{ asset('storage/' . $image) }}" class="w-20 h-20 object-cover rounded border border-gray-300">
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <img src="{{ asset('images/placeholder.png') }}" class="w-full h-96 object-cover rounded-lg">
            @endif

            <!-- Title and Price -->
            <div class="border border-gray-200 p-4 rounded-xl shadow">

            <span class="bg-green-500 text-white px-3 py-1 rounded text-sm capitalize mb-4 inline-block">Property_ID: {{ $property->id }}</span>
            <!-- Rent/Buy Badge -->
            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm capitalize mb-4 inline-block">{{ $property->type }}</span>
            <span class="bg-blue-600 text-white px-3 py-1 rounded text-sm mb-4 inline-block"> {{ $property->availability }}</span>
            <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold mb-2">{{ $property->title }}</h1>
            <p class="text-2xl text-blue-600 font-bold mb-4">Rs. {{ number_format($property->price, 0) }}</p>
            </div>
            <div class="flex items-center gap-4 p-4">
            <i class="fa-solid fa-location-dot"></i>
            <p class="text-gray-600 mb-2">{{ $property->location ?? $property->city }}, {{ $property->state }}, {{ $property->country }}</p></div>




            <!-- Social Share -->
            <div class="flex border border-gray-200 rounded-lg p-2 gap-3 mb-6">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="bg-blue-600 text-white px-3 py-1 rounded flex items-center gap-1"><i class="fab fa-facebook-f"></i> Share</a>
                <a href="https://www.messenger.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($property->title) }}" target="_blank" class="bg-blue-700 text-white px-3 py-1 rounded flex items-center gap-1"><i class="fa-brands fa-facebook-messenger"></i> Share</a>
                <a href="https://instagram.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($property->title) }}" target="_blank" class="bg-red-400 text-white px-3 py-1 rounded flex items-center gap-1"><i class="fab fa-instagram"></i> share</a>
                <a href="https://wa.me/?text={{ urlencode($property->title . ' ' . request()->fullUrl()) }}" target="_blank" class="bg-green-500 text-white px-3 py-1 rounded flex items-center gap-1"><i class="fab fa-whatsapp"></i> WhatsApp</a>
            </div>

            <div class="flex items-center pt-4 gap-3 mb-6">
                <p class="text-gray-700"><i class="fa-solid fa-bed"></i> {{ $property->bedrooms }} Bedrooms</p>
                <p class="text-gray-700"><i class="fa-solid fa-bath"></i> {{ $property->bathrooms }} Bathrooms</p>
                <p class="text-gray-700"><i class="fa-solid fa-ruler-combined"></i> {{ $property->area }} sq.ft</p>
                <!-- Amenities -->
            @if($property->amenities && $property->amenities->count())
                <h3 class="text-lg font-semibold mb-2">Amenities</h3>
                <ul class="grid grid-cols-2 gap-2 mb-4">
                    @foreach($property->amenities as $amenity)
                        <li class="bg-gray-100 px-2 py-1 rounded text-sm">
                            {{ $amenity->name }}
                            @if(isset($amenity->pivot->distance))
                                ({{ $amenity->pivot->distance }} {{ $amenity->pivot->unit }})
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
            </div>


            </div>

            <!-- Description -->
            <h3 class="text-lg font-semibold mb-2">Description</h3>
            <p class="text-gray-700 leading-relaxed mb-4">{!! $property->description !!}</p>


              <!-- Google Map -->

            @if($property->latitude && $property->longitude)

                <div class="mt-6 h-64 md:h-96 rounded-lg overflow-hidden">

                    <iframe class="w-full h-full"
                        src="https://maps.google.com/maps?q={{ $property->latitude }},{{ $property->longitude }}&z=15&output=embed"
                        frameborder="0" allowfullscreen></iframe>
                </div>
            @endif



            <!-- YouTube Video -->
            @if($property->youtube_link)
    @php
        // Helper to extract YouTube video ID from any URL format
        function getYouTubeEmbedUrl($url) {
            // Regex patterns for different YouTube URL formats
            $patterns = [
                '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                '/youtube\.com\/shorts\/([^"&?\/\s]{11})/',
            ];

            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $url, $match)) {
                    return 'https://www.youtube.com/embed/' . $match[1];
                }
            }
            return null; // Invalid URL
        }
        $embedUrl = getYouTubeEmbedUrl($property->youtube_link);
    @endphp

    @if($embedUrl)
        <div class="mt-6">
            <iframe class="w-full h-64 md:h-96 rounded-lg"
                src="{{ $embedUrl }}"
                title="{{ $property->title }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    @else
        <p class="text-red-500">Invalid YouTube link.</p>
    @endif
@endif


        </div>

        <!-- RIGHT SIDE: Agent + Contact Form -->
        <div class="lg:col-span-4 space-y-6">

            @if($property->agent)
                <div class="border p-4 py-6 rounded-lg shadow sticky top-20">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">Contact Agent</h3>

                    <!-- Agent Photo -->
                    <img src="{{ $property->agent->avatar ? asset('storage/' . $property->agent->avatar) : asset('images/avatar.png') }}"
                         alt="{{ $property->agent->name }}"
                         class="w-24 h-24 rounded-full mb-4 object-cover">

                    <!-- Agent Info -->
                    <p><strong>{{ $property->agent->name }}</strong></p>
                    <p>Email: {{ $property->agent->email }}</p>
                    <p>Phone: {{ $property->agent->phone }}</p>

                    <!-- Social Links -->
                    <div class="flex gap-3 my-2">
                        @if($property->agent->facebook)<a href="{{ $property->agent->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>@endif
                        @if($property->agent->twitter)<a href="{{ $property->agent->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>@endif
                        @if($property->agent->linkedin)<a href="{{ $property->agent->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>@endif
                        @if($property->agent->instagram)<a href="{{ $property->agent->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>@endif
                    </div>

                    <!-- Contact Form -->
                    <form method="POST" action="{{ route('agent.contact', $property->agent->id) }}">
                        @csrf
                        <input type="text" name="name" placeholder="Your Name" class="border p-2 w-full mb-2" required>
                        <input type="email" name="email" placeholder="Your Email" class="border p-2 w-full mb-2" required>
                        <textarea name="message" placeholder="Message" class="border p-2 w-full mb-2" required></textarea>

                        <!-- First Time Buyer -->
                        <div class="mb-4">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="first_time_buyer" value="yes">
                                <span class="font-medium">Are you a first-time buyer?</span>
                            </label>
                        </div>

                        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">Send Message</button>
                    </form>
                </div>
            @endif

        </div>
    </div>

    <!-- Related Properties -->
    @if($relatedProperties && $relatedProperties->count())
    <h2 class="text-2xl font-bold my-6">Related Properties</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($relatedProperties as $rel)

            <a href="{{ route('properties.show', $rel) }}"
               class="block relative bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden">

                <img src="{{ isset($rel->images[0])
                        ? asset('storage/' . $rel->images[0])
                        : asset('images/placeholder.png') }}"
                     class="w-full h-48 object-cover">

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $rel->title }}
                    </h3>

                    <p class="text-gray-600 text-sm">
                        {{ $rel->location ?? $rel->city }}
                    </p>

                    <p class="text-blue-600 font-bold text-lg mt-2">
                        Rs. {{ number_format($rel->price, 0) }}
                    </p>
                </div>

            </a>

        @endforeach
    </div>
@endif


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    var thumbSwiper = new Swiper(".thumbSwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var mainSwiper = new Swiper(".mainSwiper", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: thumbSwiper,
        },
    });
</script>

</section>



</x-frontend-layout>
