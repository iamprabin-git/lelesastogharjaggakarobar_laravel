<x-frontend-layout>

<section class="container mx-auto py-12">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT SIDE: Images & Video --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Swiper Carousel --}}
            @if($property->images && count($property->images))
            <div class="swiper mySwiper rounded-lg overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach($property->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/'.$image) }}" class="w-full h-96 object-cover rounded-lg">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            @else
                <img src="{{ asset('images/placeholder.png') }}" class="w-full h-96 object-cover rounded-lg">
            @endif

            {{-- YouTube Video --}}
            @if($property->youtube_link)
            <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                <iframe class="w-full h-full"
                        src="{{ $property->youtube_link }}"
                        title="YouTube video"
                        frameborder="0"
                        allowfullscreen></iframe>
            </div>
            @endif

            {{-- Description --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-4">Property Description</h2>
                <p class="text-gray-700 leading-relaxed">{{ $property->description }}</p>
            </div>

            {{-- Google Map --}}
            @if($property->map_link)
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-4">Location</h2>
                <iframe src="{{ $property->map_link }}"
                        class="w-full h-96 rounded-lg"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            @endif

            {{-- Amenities --}}
            @if($property->amenities && $property->amenities->count())
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-4">Amenities</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($property->amenities as $amenity)
                        <div class="flex items-center space-x-2">
                            <span class="text-blue-600 font-semibold">{{ $amenity->name }}</span>
                            @if($amenity->pivot->distance)
                                <span class="text-gray-500 text-sm">({{ $amenity->pivot->distance }} {{ $amenity->pivot->unit }})</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- RIGHT SIDE: Property & Agent Info --}}
        <div class="space-y-6">

            {{-- Property Summary --}}
            <div class="bg-white p-6 rounded-lg shadow space-y-2">
                <h1 class="text-3xl font-bold">{{ $property->title }}</h1>
                <p class="text-gray-600">{{ $property->location }}, {{ $property->city }}</p>
                <p class="text-blue-600 text-2xl font-bold">Rs. {{ number_format($property->price) }}</p>
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm capitalize">{{ $property->type }}</span>

                <div class="mt-2 text-gray-500 text-sm">
                    <p>Bedrooms: {{ $property->bedrooms ?? 'N/A' }}</p>
                    <p>Bathrooms: {{ $property->bathrooms ?? 'N/A' }}</p>
                    <p>Area: {{ $property->area ?? 'N/A' }} sq.ft</p>
                </div>
            </div>

            {{-- Agent Info --}}
            @if($property->agent)
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Agent Info</h2>
                <div class="flex items-center space-x-4">
                    <img src="{{ $property->agent->avatar ? asset('storage/'.$property->agent->avatar) : asset('images/avatar.png') }}"
                         class="w-16 h-16 object-cover rounded-full">
                    <div>
                        <p class="font-semibold">{{ $property->agent->name }}</p>
                        <p class="text-gray-500">{{ $property->agent->phone }}</p>
                        <p class="text-gray-500">{{ $property->agent->email }}</p>
                        <div class="flex space-x-2 mt-2">
                            @if($property->agent->facebook) <a href="{{ $property->agent->facebook }}" target="_blank"><i class="fab fa-facebook text-blue-600"></i></a> @endif
                            @if($property->agent->twitter) <a href="{{ $property->agent->twitter }}" target="_blank"><i class="fab fa-twitter text-blue-400"></i></a> @endif
                            @if($property->agent->instagram) <a href="{{ $property->agent->instagram }}" target="_blank"><i class="fab fa-instagram text-pink-500"></i></a> @endif
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <form action="{{ route('agent.contact', $property->agent->id) }}" method="POST" class="mt-4 space-y-3">
                    @csrf
                    <input type="text" name="name" placeholder="Your Name" class="w-full p-2 border rounded">
                    <input type="email" name="email" placeholder="Your Email" class="w-full p-2 border rounded">
                    <textarea name="message" placeholder="Your Message" class="w-full p-2 border rounded"></textarea>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Send Message</button>
                </form>
            </div>
            @endif

            {{-- Related Properties --}}
            @if($relatedProperties && $relatedProperties->count())
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Related Properties</h2>
                <div class="space-y-4">
                    @foreach($relatedProperties as $rel)
                        <a href="{{ route('properties.show', $rel->id) }}" class="flex items-center space-x-4">
                            <img src="{{ isset($rel->images[0]) ? asset('storage/'.$rel->images[0]) : asset('images/placeholder.png') }}" class="w-20 h-20 object-cover rounded">
                            <div>
                                <p class="font-semibold">{{ $rel->title }}</p>
                                <p class="text-gray-500 text-sm">{{ $rel->location }}, {{ $rel->city }}</p>
                                <p class="text-blue-600 font-bold text-sm">Rs. {{ number_format($rel->price) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

    </div>

</section>

{{-- Swiper JS --}}
@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper(".mySwiper", {
      loop: true,
      pagination: { el: ".swiper-pagination", clickable: true },
      navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
  });
</script>
@endpush

</x-frontend-layout>
