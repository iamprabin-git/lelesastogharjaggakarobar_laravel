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



<section class="relative bg-gray-900 text-white py-32">
    <div class="absolute inset-0">
        <img src="<?php echo e(asset('images/bg.jpg')); ?>" class="w-full h-full object-cover opacity-40" alt="Blog Hero">
    </div>

    <div class="relative container mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">Our Blog</h1>
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200">
            Latest updates and articles about real estate in Nepal
        </p>
    </div>
</section>


<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="bg-white shadow rounded-lg overflow-hidden relative">

                    
                    <span class="absolute top-4 left-4 bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        #<?php echo e($blog->id); ?>

                    </span>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($blog->image): ?>
                        <img src="<?php echo e(asset('storage/' . $blog->image)); ?>" class="w-full h-48 object-cover">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="p-6">
                        
                        <p class="text-sm text-gray-500 mb-2">
                            By <span class="font-semibold"><?php echo e($blog->author->name ?? 'Admin'); ?></span>
                        </p>

                        
                        <h3 class="font-bold text-xl mb-2">
                            <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>" class="hover:text-yellow-500">
                                <?php echo e($blog->title); ?>

                            </a>
                        </h3>

                        
                        <p class="text-gray-600 mb-4"><?php echo e($blog->excerpt); ?></p>

                        
                        <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>" class="text-yellow-500 font-semibold">
                            Read More →
                        </a>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <p class="col-span-3 text-center text-gray-500">No blogs found.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="mt-8">
            <?php echo e($blogs->links()); ?>

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
<?php /**PATH G:\lelesastogharjagga_laravel_new\lelesastogharjaggakarobar_laravel\resources\views/frontend/blogs/index.blade.php ENDPATH**/ ?>