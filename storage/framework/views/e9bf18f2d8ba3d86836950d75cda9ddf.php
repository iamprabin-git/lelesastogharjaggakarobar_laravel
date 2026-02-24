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




<div class="container mx-auto px-6 py-12">

    
    <section class="py-10">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-12">Find Your Dream Property</h2>
        <?php if (isset($component)) { $__componentOriginalbc846bbd52f1beb6a4145b9c17c8e049 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc846bbd52f1beb6a4145b9c17c8e049 = $attributes; } ?>
<?php $component = App\View\Components\PropertySearch::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('property-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\PropertySearch::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc846bbd52f1beb6a4145b9c17c8e049)): ?>
<?php $attributes = $__attributesOriginalbc846bbd52f1beb6a4145b9c17c8e049; ?>
<?php unset($__attributesOriginalbc846bbd52f1beb6a4145b9c17c8e049); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc846bbd52f1beb6a4145b9c17c8e049)): ?>
<?php $component = $__componentOriginalbc846bbd52f1beb6a4145b9c17c8e049; ?>
<?php unset($__componentOriginalbc846bbd52f1beb6a4145b9c17c8e049); ?>
<?php endif; ?>
    </div>
</section>


    
   <div class="grid md:grid-cols-3 gap-8">

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $latestProperties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
    <a href="<?php echo e(route('properties.show', $property)); ?>"
       class="group block bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">

        
        <div class="relative overflow-hidden">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($property->images)): ?>
                <img src="<?php echo e(asset('storage/'.$property->images[0])); ?>"
                     class="h-60 w-full object-cover transition-transform duration-500 group-hover:scale-110">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->is_featured ?? false): ?>
                <span class="absolute top-4 left-0 bg-yellow-400 text-black text-xs px-3 py-1 rounded-r-full font-semibold">
                    Featured
                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <span class="absolute top-4 left-4 bg-black/70 text-white text-xs px-3 py-1 rounded-full">
                Property_ID-<?php echo e(str_pad($property->id, 5, '0', STR_PAD_LEFT)); ?>

            </span>

            
            <span class="absolute top-4 right-4
                <?php echo e($property->type == 'rent' ? 'bg-blue-600' : 'bg-green-600'); ?>

                text-white text-xs px-3 py-1 rounded-full capitalize">
                <?php echo e($property->type); ?>

            </span>

            
            <span class="absolute bottom-4 left-4
                <?php echo e($property->availability == 'available' ? 'bg-green-500' : 'bg-red-500'); ?>

                text-white text-xs px-3 py-1 rounded-full capitalize">
                <?php echo e($property->availability); ?>

            </span>

            
            <button class="absolute bottom-4 right-4 text-red-500 text-lg hover:scale-110 transition">
                <i class="fa-regular fa-heart"></i>
            </button>

        </div>

        <div class="p-6">

            
            <h3 class="text-xl font-bold mb-2 text-center">
                <?php echo e($property->title); ?>

            </h3>

            
            <div class="flex justify-between text-sm text-gray-600 mb-4">
                <p class="text-gray-500">
                    <i class="fa-solid fa-location-dot mr-1"></i>
                    <?php echo e($property->location ?? $property->city); ?>

                </p>
                <p class="text-primary font-bold text-lg">
                    Rs. <?php echo e(number_format($property->price)); ?>

                </p>
            </div>

            
            <div class="flex gap-4 text-sm text-gray-600 mb-4">
                <span><?php echo e($property->bedrooms ?? 0); ?> <i class="fa-solid fa-bed ml-1"></i></span>
                <span><?php echo e($property->bathrooms ?? 0); ?> <i class="fa-solid fa-bath ml-1"></i></span>
                <span><?php echo e($property->area ?? 0); ?> <i class="fa-solid fa-chart-area ml-1"></i></span>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->agent): ?>
                <div class="flex items-center gap-3 mt-4">
                    <p class="text-sm text-gray-500"> Agent : </p>
                    <p class="text-sm font-semibold"><?php echo e($property->agent->name); ?></p>

                    </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    </a>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    <p>No properties found.</p>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>

    
    <div class="mt-12">
        <?php echo e($latestProperties->links()); ?>

    </div>

</div>

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
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/frontend/properties/index.blade.php ENDPATH**/ ?>