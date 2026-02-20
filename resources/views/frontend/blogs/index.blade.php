<x-frontend-layout>

{{-- HERO SECTION --}}
<section class="relative bg-gray-900 text-white py-32">
    <div class="absolute inset-0">
        <img src="{{ asset('images/bg.jpg') }}" class="w-full h-full object-cover opacity-40" alt="Blog Hero">
    </div>

    <div class="relative container mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">Our Blog</h1>
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200">
            Latest updates and articles about real estate in Nepal
        </p>
    </div>
</section>

{{-- BLOG LIST --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($blogs as $blog)
                <div class="bg-white shadow rounded-lg overflow-hidden relative">

                    {{-- ID Badge --}}
                    <span class="absolute top-4 left-4 bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        #{{ $blog->id }}
                    </span>

                    {{-- Blog Image --}}
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-6">
                        {{-- Author --}}
                        <p class="text-sm text-gray-500 mb-2">
                            By <span class="font-semibold">{{ $blog->author->name ?? 'Admin' }}</span>
                        </p>

                        {{-- Title --}}
                        <h3 class="font-bold text-xl mb-2">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="hover:text-yellow-500">
                                {{ $blog->title }}
                            </a>
                        </h3>

                        {{-- Excerpt --}}
                        <p class="text-gray-600 mb-4">{{ $blog->excerpt }}</p>

                        {{-- Read More --}}
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="text-yellow-500 font-semibold">
                            Read More →
                        </a>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">No blogs found.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $blogs->links() }}
        </div>
    </div>
</section>

</x-frontend-layout>
