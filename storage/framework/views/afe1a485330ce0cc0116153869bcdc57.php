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

<section class="py-10 rounded-3xl">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-4">Find Your Dream Property</h2>
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


<!-- Agent Registration Section -->
<section class="container py-20 text-center space-y-10">
    <h1 class="text-2xl font-bold">Agent Registration</h1>
    <p>Please fill out the form below to register as an agent.</p>

    <a href="/agent-form" class="inline-block bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition">
        Register as Agent
    </a>
</section>



<!-- ABOUT SECTION -->
<?php
    $about = \App\Models\AboutSection::first();
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($about): ?>
<section class="py-20 bg-gray-50 mt-10">
    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 gap-12 items-center">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($about->about_image): ?>
            <div class="relative">
                <img
                    src="<?php echo e(asset('storage/'.$about->about_image)); ?>"
                    class="rounded-3xl shadow-2xl w-full h-125 object-cover">

                
                <div class="absolute -bottom-6 -right-6 bg-primary text-white px-6 py-4 rounded-2xl shadow-xl">
                    <h3 class="text-2xl font-bold">
                        <?php echo e($about->experience_years); ?>+
                    </h3>
                    <p class="text-sm">Years Experience</p>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    <?php echo e($about->hero_title); ?>

                </h2>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    <?php echo e(\Illuminate\Support\Str::limit($about->hero_description, 250)); ?>

                </p>

                
                <div class="grid grid-cols-3 gap-6 mb-8">

                    <div class="text-center bg-white p-6 rounded-2xl shadow-md">
                        <h3 class="text-2xl font-bold text-primary">
                            <?php echo e($about->properties_sold); ?>+
                        </h3>
                        <p class="text-sm text-gray-500">
                            Properties Sold
                        </p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-2xl shadow-md">
                        <h3 class="text-2xl font-bold text-primary">
                            <?php echo e($about->happy_clients); ?>+
                        </h3>
                        <p class="text-sm text-gray-500">
                            Happy Clients
                        </p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-2xl shadow-md">
                        <h3 class="text-2xl font-bold text-primary">
                            <?php echo e($about->experience_years); ?>+
                        </h3>
                        <p class="text-sm text-gray-500">
                            Years Experience
                        </p>
                    </div>

                </div>

                
                <a href="<?php echo e(route('about')); ?>"
                   class="inline-block bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-xl font-semibold shadow-lg transition duration-300">
                    Read More →
                </a>

            </div>

        </div>

    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<!-- Latest Properties Section -->
<section class="container mx-auto py-15 px-6">
    <h2 class="text-2xl font-bold mb-4 p-3 bg-green-600 text-white text-center">Latest Properties</h2>

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
    <div class="text-center mt-6">
    <a href="/properties"
       class="inline-block bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition">
        See all latest properties
    </a>
</div>

</section>
<!-- ================= CALL TO ACTION ================= -->
<section class="py-20 bg-primary text-white text-center">
    <div class="container mx-auto px-6">

        <h2 class="text-4xl font-bold mb-6">
            Ready to Find Your Dream Property?
        </h2>

        <p class="mb-8 text-lg">
            Let our expert team guide you every step of the way.
        </p>

        <a href="<?php echo e(route('contact')); ?>"
           class="bg-white text-primary px-8 py-4 rounded-full font-semibold shadow-lg hover:bg-gray-100 transition">
            Contact Us
        </a>

    </div>
</section>

<?php if (isset($component)) { $__componentOriginale2f88d9d611696248221bc470383ba2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2f88d9d611696248221bc470383ba2c = $attributes; } ?>
<?php $component = App\View\Components\Advertisement::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('advertisement'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Advertisement::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2f88d9d611696248221bc470383ba2c)): ?>
<?php $attributes = $__attributesOriginale2f88d9d611696248221bc470383ba2c; ?>
<?php unset($__attributesOriginale2f88d9d611696248221bc470383ba2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2f88d9d611696248221bc470383ba2c)): ?>
<?php $component = $__componentOriginale2f88d9d611696248221bc470383ba2c; ?>
<?php unset($__componentOriginale2f88d9d611696248221bc470383ba2c); ?>
<?php endif; ?>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($reviews) && $reviews->count()): ?>
<section class="py-24 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <div class="flex justify-center items-center gap-3 mb-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg"
                     class="h-8" alt="Google Logo">

                <span class="text-3xl font-bold text-gray-800">
                    <?php echo e(number_format($averageRating, 1)); ?>

                </span>

                <span class="text-yellow-400 text-xl">
                    <?php echo e(str_repeat('★', round($averageRating))); ?>

                </span>
            </div>

            <p class="text-gray-600">
                Based on <?php echo e($totalReviews); ?> Google Reviews
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
                    <div class="text-yellow-400 mb-4 text-lg">
                        <?php echo e(str_repeat('★', $review->rating)); ?>

                    </div>

                    <p class="text-gray-600 mb-6 line-clamp-4">
                        "<?php echo e($review->text); ?>"
                    </p>

                    <div class="flex items-center gap-4">
                        <img src="<?php echo e($review->profile_photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($review->author_name)); ?>"
                             class="w-12 h-12 rounded-full object-cover"
                             alt="<?php echo e($review->author_name); ?>">

                        <div>
                            <h4 class="font-semibold text-gray-900">
                                <?php echo e($review->author_name); ?>

                            </h4>
                            <p class="text-sm text-gray-500">Google Review</p>
                        </div>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <div class="text-center mt-14">
            <a href="https://www.google.com/maps"
               target="_blank"
               class="inline-block bg-yellow-500 text-white px-8 py-3 rounded-xl font-semibold hover:bg-yellow-600 transition">
                View All Reviews on Google
            </a>
        </div>
    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



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
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/frontend/home.blade.php ENDPATH**/ ?>