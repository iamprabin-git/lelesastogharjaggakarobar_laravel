<x-frontend-layout>

<section class="py-10 bg-gray-50">
    <div class="container mx-auto px-6">

        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900">Frequently Asked Questions</h2>
            <p class="text-gray-600 mt-4">
                Common questions about buying, selling, and renting real estate in Nepal
            </p>
        </div>

        <!-- FAQ Grid: 2 columns -->
        <div x-data="{ openIndex: null }" class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @forelse($faqs as $index => $faq)
                <div class="bg-white shadow rounded-lg overflow-hidden">

                    <!-- Question Button -->
                    <button
                        @click="openIndex === {{ $index }} ? openIndex = null : openIndex = {{ $index }}"
                        class="w-full text-left px-6 py-4 flex justify-between items-center focus:outline-none">
                        <span class="font-semibold text-gray-800">{{ $faq->question }}</span>
                        <i class="fa-solid"
                           :class="openIndex === {{ $index }} ? 'fa-minus' : 'fa-plus'"></i>
                    </button>

                    <!-- Answer with slide down/up animation -->
                    <div x-show="openIndex === {{ $index }}"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 max-h-0"
                         x-transition:enter-end="opacity-100 max-h-96"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 max-h-96"
                         x-transition:leave-end="opacity-0 max-h-0"
                         class="px-6 pb-4 text-gray-700 overflow-hidden">
                        {!! nl2br(strip_tags($faq->answer, '<strong><a>')) !!}
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-2">No FAQs available at the moment.</p>
            @endforelse

        </div>
    </div>
</section>

</x-frontend-layout>
