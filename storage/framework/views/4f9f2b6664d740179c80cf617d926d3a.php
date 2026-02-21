<?php if (isset($component)) { $__componentOriginal292c42cda3271405dc664835e31595e3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal292c42cda3271405dc664835e31595e3 = $attributes; } ?>
<?php $component = App\View\Components\FrontendLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FrontendLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


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

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="bg-white shadow rounded-lg overflow-hidden">

                    <!-- Question Button -->
                    <button
                        @click="openIndex === <?php echo e($index); ?> ? openIndex = null : openIndex = <?php echo e($index); ?>"
                        class="w-full text-left px-6 py-4 flex justify-between items-center focus:outline-none">
                        <span class="font-semibold text-gray-800"><?php echo e($faq->question); ?></span>
                        <i class="fa-solid"
                           :class="openIndex === <?php echo e($index); ?> ? 'fa-minus' : 'fa-plus'"></i>
                    </button>

                    <!-- Answer with slide down/up animation -->
                    <div x-show="openIndex === <?php echo e($index); ?>"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 max-h-0"
                         x-transition:enter-end="opacity-100 max-h-96"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 max-h-96"
                         x-transition:leave-end="opacity-0 max-h-0"
                         class="px-6 pb-4 text-gray-700 overflow-hidden">
                        <?php echo nl2br(strip_tags($faq->answer, '<strong><a>')); ?>

                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <p class="text-center text-gray-500 col-span-2">No FAQs available at the moment.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    </div>
</section>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal292c42cda3271405dc664835e31595e3)): ?>
<?php $attributes = $__attributesOriginal292c42cda3271405dc664835e31595e3; ?>
<?php unset($__attributesOriginal292c42cda3271405dc664835e31595e3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal292c42cda3271405dc664835e31595e3)): ?>
<?php $component = $__componentOriginal292c42cda3271405dc664835e31595e3; ?>
<?php unset($__componentOriginal292c42cda3271405dc664835e31595e3); ?>
<?php endif; ?>
<?php /**PATH G:\lelesastogharjagga_laravel_new\lelesastogharjaggakarobar_laravel\resources\views/frontend/faqs.blade.php ENDPATH**/ ?>