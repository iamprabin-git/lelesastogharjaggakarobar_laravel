<x-frontend-layout>



<div class="container mx-auto px-6 py-12">

    {{-- FILTER SECTION --}}
    <section class="py-10">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-12">Find Your Dream Property</h2>
        <x-property-search />
    </div>
</section>


    {{-- PROPERTY GRID --}}
   <div class="grid md:grid-cols-3 gap-8">

@forelse($latestProperties as $property)
    <a href="{{ route('properties.show', $property) }}"
       class="group block bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">

        {{-- Image --}}
        <div class="relative overflow-hidden">
            @if(!empty($property->images))
                <img src="{{ asset('storage/'.$property->images[0]) }}"
                     class="h-60 w-full object-cover transition-transform duration-500 group-hover:scale-110">
            @endif

            {{-- Featured Ribbon --}}
            @if($property->is_featured ?? false)
                <span class="absolute top-4 left-0 bg-yellow-400 text-black text-xs px-3 py-1 rounded-r-full font-semibold">
                    Featured
                </span>
            @endif

            {{-- Property ID --}}
            <span class="absolute top-4 left-4 bg-black/70 text-white text-xs px-3 py-1 rounded-full">
                Property_ID-{{ str_pad($property->id, 5, '0', STR_PAD_LEFT) }}
            </span>

            {{-- Property Type --}}
            <span class="absolute top-4 right-4
                {{ $property->type == 'rent' ? 'bg-blue-600' : 'bg-green-600' }}
                text-white text-xs px-3 py-1 rounded-full capitalize">
                {{ $property->type }}
            </span>

            {{-- Status Badge --}}
            <span class="absolute bottom-4 left-4
                {{ $property->availability == 'available' ? 'bg-green-500' : 'bg-red-500' }}
                text-white text-xs px-3 py-1 rounded-full capitalize">
                {{ $property->availability }}
            </span>

            {{-- Wishlist Heart --}}
            <button class="absolute bottom-4 right-4 text-red-500 text-lg hover:scale-110 transition">
                <i class="fa-regular fa-heart"></i>
            </button>

        </div>

        <div class="p-6">

            {{-- Property Title --}}
            <h3 class="text-xl font-bold mb-2 text-center">
                {{ $property->title }}
            </h3>

            {{-- Location & Price --}}
            <div class="flex justify-between text-sm text-gray-600 mb-4">
                <p class="text-gray-500">
                    <i class="fa-solid fa-location-dot mr-1"></i>
                    {{ $property->location ?? $property->city }}
                </p>
                <p class="text-primary font-bold text-lg">
                    Rs. {{ number_format($property->price) }}
                </p>
            </div>

            {{-- Property Stats --}}
            <div class="flex gap-4 text-sm text-gray-600 mb-4">
                <span>{{ $property->bedrooms ?? 0 }} <i class="fa-solid fa-bed ml-1"></i></span>
                <span>{{ $property->bathrooms ?? 0 }} <i class="fa-solid fa-bath ml-1"></i></span>
                <span>{{ $property->area ?? 0 }} <i class="fa-solid fa-chart-area ml-1"></i></span>
            </div>

            {{-- Agent Info --}}
            @if($property->agent)
                <div class="flex items-center gap-3 mt-4">
                    <p class="text-sm text-gray-500"> Agent : </p>
                    <p class="text-sm font-semibold">{{ $property->agent->name }}</p>

                    </div>

            @endif

        </div>
    </a>

@empty
    <p>No properties found.</p>
@endforelse

</div>

    {{-- PAGINATION --}}
    <div class="mt-12">
        {{ $latestProperties->links() }}
    </div>

</div>

</x-frontend-layout>
