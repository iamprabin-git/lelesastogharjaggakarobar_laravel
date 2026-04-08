<x-frontend-layout>

<section class="container mx-auto px-4 py-8 md:py-14">

    <div class="grid grid-cols-1 gap-10 lg:grid-cols-12">

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
            <div class="rounded-xl border border-zinc-200 bg-white p-4 shadow dark:border-zinc-700 dark:bg-zinc-900">

            <span class="bg-green-500 text-white px-3 py-1 rounded text-sm capitalize mb-4 inline-block">Property_ID: {{ $property->id }}</span>
            <!-- Rent/Buy Badge -->
            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm capitalize mb-4 inline-block">{{ $property->type }}</span>
            <span class="bg-blue-600 text-white px-3 py-1 rounded text-sm mb-4 inline-block"> {{ $property->availability }}</span>
            <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
            <h1 class="mb-2 text-2xl font-bold text-zinc-900 dark:text-zinc-50 md:text-3xl">{{ $property->title }}</h1>
            <p class="mb-4 text-xl font-bold text-blue-600 dark:text-blue-400 md:text-2xl">Rs. {{ number_format($property->price, 0) }}</p>
            </div>
            <div class="flex items-start gap-4 p-2 md:p-4">
            <i class="fa-solid fa-location-dot mt-1 text-zinc-500"></i>
            <p class="text-zinc-600 dark:text-zinc-400">{{ $property->location ?? $property->city }}, {{ $property->state }}, {{ $property->country }}</p></div>




            <!-- Social Share -->
            <div class="mb-6 flex flex-wrap gap-2 rounded-lg border border-zinc-200 p-2 dark:border-zinc-700">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 rounded bg-blue-600 px-3 py-2 text-sm text-white"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="https://www.messenger.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($property->title) }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 rounded bg-blue-700 px-3 py-2 text-sm text-white"><i class="fa-brands fa-facebook-messenger"></i> Messenger</a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($property->title) }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 rounded bg-zinc-800 px-3 py-2 text-sm text-white dark:bg-zinc-700"><i class="fab fa-twitter"></i> X</a>
                <a href="https://wa.me/?text={{ urlencode($property->title . ' ' . request()->fullUrl()) }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 rounded bg-green-600 px-3 py-2 text-sm text-white"><i class="fab fa-whatsapp"></i> WhatsApp</a>
            </div>

            <div class="mb-6 flex flex-wrap items-center gap-3 pt-4 text-sm text-zinc-700 dark:text-zinc-300 md:text-base">
                <p><i class="fa-solid fa-bed"></i> {{ $property->bedrooms }} Bedrooms</p>
                <p><i class="fa-solid fa-bath"></i> {{ $property->bathrooms }} Bathrooms</p>
                <p><i class="fa-solid fa-ruler-combined"></i> {{ $property->area }} sq.ft</p>
                <!-- Amenities -->
            @if($property->amenities && $property->amenities->count())
                <h3 class="text-lg font-semibold mb-2">Amenities</h3>
                <ul class="grid grid-cols-2 gap-2 mb-4">
                    @foreach($property->amenities as $amenity)
                        <li class="rounded bg-zinc-100 px-2 py-1 text-sm dark:bg-zinc-800">
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
            <h3 class="mb-2 text-lg font-semibold text-zinc-900 dark:text-zinc-100">Description</h3>
            <div class="prose prose-zinc mb-4 max-w-none leading-relaxed dark:prose-invert">{!! $property->description !!}</div>


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
        $embedUrl = \App\Models\Property::youtubeEmbedUrl($property->youtube_link);
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
        <p class="text-rose-600 dark:text-rose-400">Invalid YouTube link.</p>
    @endif
@endif


        </div>

        <!-- RIGHT SIDE: Agent + Contact Form -->
        <div class="lg:col-span-4 space-y-6">

            @if($property->agent)
                <div class="sticky top-24 rounded-lg border border-zinc-200 bg-white p-4 py-6 shadow dark:border-zinc-700 dark:bg-zinc-900">
                    <h3 class="mb-4 flex items-center gap-2 text-lg font-semibold">Contact Agent</h3>

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
                    <form method="POST" action="{{ route('agent.contact', $property->agent->id) }}" class="space-y-2">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" class="mb-1 w-full rounded border border-zinc-300 bg-white p-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-950 dark:text-zinc-100" required>
                        @error('name')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" class="mb-1 w-full rounded border border-zinc-300 bg-white p-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-950 dark:text-zinc-100" required>
                        @error('email')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                        <textarea name="message" placeholder="Message" rows="4" class="mb-1 w-full rounded border border-zinc-300 bg-white p-2 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-950 dark:text-zinc-100" required>{{ old('message') }}</textarea>
                        @error('message')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror
                        @error('property_id')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror

                        <div class="mb-2">
                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" name="first_time_buyer" value="yes" @checked(old('first_time_buyer'))>
                                <span>First-time buyer?</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full rounded bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700">Send Message</button>
                    </form>
                </div>
            @endif

        </div>
    </div>

    <!-- Property reviews (approved) -->
    <div class="mt-12 rounded-xl border border-zinc-200 bg-white p-6 shadow dark:border-zinc-700 dark:bg-zinc-900">
        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-50">Reviews</h2>
            @if($reviewCount > 0)
                <p class="text-amber-600 dark:text-amber-400">
                    <span class="font-semibold">{{ number_format($reviewAverage, 1) }}</span> / 5
                    ({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})
                </p>
            @endif
        </div>

        @if($approvedReviews->isEmpty())
            <p class="text-zinc-600 dark:text-zinc-400">No approved reviews yet.</p>
        @else
            <ul class="space-y-4">
                @foreach($approvedReviews as $rev)
                    <li class="rounded-lg border border-zinc-100 p-4 dark:border-zinc-800">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $rev->user->name ?? 'User' }}</span>
                            <span class="text-amber-500">{{ str_repeat('★', (int) $rev->rating) }}{{ str_repeat('☆', 5 - (int) $rev->rating) }}</span>
                        </div>
                        <p class="mt-2 text-zinc-700 dark:text-zinc-300">{{ $rev->comment }}</p>
                        <p class="mt-1 text-xs text-zinc-500">{{ $rev->created_at->format('M j, Y') }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

        @auth
            @if($userReview)
                <div class="mt-6 rounded-lg border border-amber-200 bg-amber-50 p-4 text-sm text-amber-900 dark:border-amber-900 dark:bg-amber-950/40 dark:text-amber-100">
                    @if($userReview->status === 'approved')
                        Your review is live on this page.
                    @elseif($userReview->status === 'rejected')
                        Your review was not approved. Contact support if you have questions.
                    @else
                        Your review is pending admin approval.
                    @endif
                </div>
            @else
                <h3 class="mt-8 text-lg font-semibold text-zinc-900 dark:text-zinc-50">Write a review</h3>
                <form method="POST" action="{{ route('properties.reviews.store', $property) }}" class="mt-3 max-w-xl space-y-3">
                    @csrf
                    <div>
                        <label class="mb-1 block text-sm font-medium">Rating</label>
                        <select name="rating" class="w-full rounded border border-zinc-300 bg-white p-2 dark:border-zinc-600 dark:bg-zinc-950 dark:text-zinc-100" required>
                            @foreach ([5 => '5 — Excellent', 4 => '4 — Good', 3 => '3 — Average', 2 => '2 — Below average', 1 => '1 — Poor'] as $val => $label)
                                <option value="{{ $val }}" @selected((int) old('rating') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('rating')<p class="mt-1 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium">Comment</label>
                        <textarea name="comment" rows="4" minlength="10" maxlength="2000" class="w-full rounded border border-zinc-300 bg-white p-2 dark:border-zinc-600 dark:bg-zinc-950 dark:text-zinc-100" required placeholder="At least 10 characters">{{ old('comment') }}</textarea>
                        @error('comment')<p class="mt-1 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="rounded-lg bg-amber-500 px-5 py-2 text-white hover:bg-amber-600">Submit review</button>
                </form>
            @endif
        @else
            <p class="mt-6 text-sm text-zinc-600 dark:text-zinc-400">
                <a href="{{ route('login') }}" class="font-medium text-amber-600 underline hover:text-amber-700 dark:text-amber-400">Sign in</a>
                to leave a review.
            </p>
        @endauth
    </div>

    <!-- Related Properties -->
    @if($relatedProperties && $relatedProperties->count())
    <h2 class="my-6 text-2xl font-bold text-zinc-900 dark:text-zinc-50">Related Properties</h2>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach($relatedProperties as $rel)

            <a href="{{ route('properties.show', $rel) }}"
               class="relative block overflow-hidden rounded-xl bg-white shadow transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:bg-zinc-900">

                <img src="{{ isset($rel->images[0])
                        ? asset('storage/' . $rel->images[0])
                        : asset('images/placeholder.png') }}"
                     class="w-full h-48 object-cover">

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-100">
                        {{ $rel->title }}
                    </h3>

                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        {{ $rel->location ?? $rel->city }}
                    </p>

                    <p class="mt-2 text-lg font-bold text-blue-600 dark:text-blue-400">
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
