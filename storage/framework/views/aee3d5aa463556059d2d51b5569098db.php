<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($advertisements->count()): ?>
<div class="relative w-full my-10">

    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Advertisements</h2>
        <p class="text-gray-500 dark:text-gray-400 mt-2">Sponsored promotions</p>
    </div>

    <!-- Swiper Container -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $advertisements->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adsChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="swiper-slide">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4 md:px-8">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $adsChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div class="relative overflow-hidden rounded-xl shadow-lg bg-white dark:bg-gray-800 transition-all duration-300 hover:shadow-2xl hover:scale-[1.02]">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ad->link): ?>
                                    <a href="<?php echo e($ad->link); ?>" target="_blank" rel="noopener noreferrer" class="block w-full h-full">
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ad->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $ad->image)); ?>"
                                             alt="<?php echo e($ad->title ?? 'Advertisement'); ?>"
                                             class="w-full h-64 md:h-80 lg:h-96 object-cover transition-transform duration-500 hover:scale-110">
                                    <?php else: ?>
                                        <!-- Fallback if no image -->
                                        <div class="w-full h-64 md:h-80 lg:h-96 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">
                                            Ad Placeholder
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ad->link): ?>
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        </div>

        <!-- Pagination (dots) -->
        <div class="swiper-pagination mt-6"></div>

        <!-- Navigation buttons -->
        <div class="swiper-button-prev text-blue-600 bg-white/70 w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:bg-white"></div>
        <div class="swiper-button-next text-blue-600 bg-white/70 w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:bg-white"></div>

    </div>

</div>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH G:\lelesastogharjagga_laravel_new\lelesastogharjaggakarobar_laravel\resources\views/components/advertisement.blade.php ENDPATH**/ ?>