@if($advertisements->count())
<div class="relative w-full my-10">

    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Advertisements</h2>
        <p class="text-gray-500 mt-2">Sponsored promotions</p>
    </div>

    <!-- Swiper Container -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            @foreach($advertisements->chunk(2) as $adsChunk)
                <div class="swiper-slide">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4 md:px-8">

                        @foreach($adsChunk as $ad)
                            <div class="relative overflow-hidden rounded-xl shadow-lg bg-white transition-all duration-300 hover:shadow-2xl hover:scale-[1.02]">

                                @if($ad->link)
                                    <a href="{{ $ad->link }}" target="_blank" rel="noopener noreferrer" class="block w-full h-full">
                                @endif

                                    @if($ad->image)
                                        <img src="{{ asset('storage/' . $ad->image) }}"
                                             alt="{{ $ad->title ?? 'Advertisement' }}"
                                             class="w-full h-64 md:h-80 lg:h-96 object-cover transition-transform duration-500 hover:scale-110">
                                    @else
                                        <!-- Fallback if no image -->
                                        <div class="w-full h-64 md:h-80 lg:h-96 bg-gray-200 flex items-center justify-center text-gray-500">
                                            Ad Placeholder
                                        </div>
                                    @endif

                                @if($ad->link)
                                    </a>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>
            @endforeach

        </div>

        <!-- Pagination (dots) -->
        <div class="swiper-pagination mt-6"></div>

        <!-- Navigation buttons -->
        <div class="swiper-button-prev text-blue-600 bg-white/70 w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:bg-white"></div>
        <div class="swiper-button-next text-blue-600 bg-white/70 w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:bg-white"></div>

    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.mySwiper', {
        modules: [Autoplay, Navigation, Pagination],

        // Core settings
        loop: true,                  // Infinite loop
        autoplay: {
            delay: 4000,             // 4 seconds per slide (matches your original interval)
            disableOnInteraction: false, // Continue autoplay after user interaction
            pauseOnMouseEnter: true,
        },

        // Responsive slides per view
        slidesPerView: 1,            // Default: 1 slide (mobile)
        spaceBetween: 16,

        breakpoints: {
            768: {                   // md breakpoint
                slidesPerView: 2,
                spaceBetween: 24,
            },
        },

        // Modules config
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,    // Nice visual effect
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // Smooth transitions
        speed: 600,
        effect: 'slide',             // You can change to 'fade', 'cube', etc.
    });
});
</script>
@endpush
@endif
