<x-frontend-layout>
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 max-w-6xl grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- LEFT COLUMN --}}
            <div class="lg:col-span-3 space-y-8 border border-gray-400 rounded-lg p-6">

                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    {{ $blog->title }}
                </h1>

                <p class="text-gray-500 text-sm mb-4">
                    By <span class="font-semibold">
                        {{ $blog->author ?? 'Admin' }}
                    </span> |
                    {{ $blog->created_at->format('M d, Y') }}
                </p>

                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" class="w-full h-64 object-cover rounded-lg mb-6">
                @endif

                <div class="prose max-w-none text-gray-700">
                    {!! $blog->content !!}
                </div>

                {{-- Related Blogs --}}

            </div>

            {{-- RIGHT COLUMN --}}
            <div class="lg:col-span-1 space-y-8">

                {{-- AUTHOR CARD --}}
                <div class="bg-white shadow rounded-lg p-6 text-center sticky top-20">

                    <img src="{{ $blog->author_photo ? asset('storage/' . $blog->author_photo) : asset('images/avatar.png') }}"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">

                    <h4 class="font-bold text-lg">
                        {{ $blog->author ?? 'Admin' }}
                    </h4>

                    <p class="text-gray-500 text-sm mt-2">
                        {{ $blog->author_bio ?? 'Real estate expert sharing latest updates.' }}
                    </p>

                    {{-- SOCIAL SHARE --}}
                    <div class="mt-6 border-t pt-4">
                        <h5 class="font-semibold mb-3 text-gray-700">Share This Article</h5>

                        <div class="flex justify-center gap-3">

                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank"
                                class="bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700">
                                <i class="fab fa-facebook-f"></i>
                            </a>

                            {{-- Twitter --}}
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}"
                                target="_blank"
                                class="bg-sky-500 text-white px-3 py-2 rounded text-sm hover:bg-sky-600">
                                <i class="fab fa-messenger"></i>
                            </a>

                            {{-- WhatsApp --}}
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . request()->fullUrl()) }}"
                                target="_blank"
                                class="bg-green-500 text-white px-3 py-2 rounded text-sm hover:bg-green-600">
                                <i class="fab fa-whatsapp"></i>
                            </a>

                        </div>
                    </div>
                </div>


                {{-- RELATED PROPERTIES --}}


            </div>



        </div>
        <div class="container mx-auto max-w-6xl">
                    <h3 class="text-2xl font-bold mb-2 pt-10">Related Blogs</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($relatedBlogs ?? [] as $related)
                            <div class="bg-white shadow rounded-lg overflow-hidden">
                                @if ($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}"
                                        class="w-full h-45 object-cover">
                                @endif

                                <div class="p-4">
                                    <h4 class="font-semibold">
                                        <a href="{{ route('blogs.show', $related->slug) }}"
                                            class="hover:text-yellow-500">
                                            {{ $related->title }}
                                        </a>
                                    </h4>

                                    <p class="text-gray-500 text-sm mt-1">
                                        {{ \Illuminate\Support\Str::limit($related->excerpt, 60) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

    </section>
</x-frontend-layout>
