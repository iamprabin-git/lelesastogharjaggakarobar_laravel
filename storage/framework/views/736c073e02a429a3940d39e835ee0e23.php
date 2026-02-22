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

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 max-w-6xl grid grid-cols-1 lg:grid-cols-4 gap-8">

            
            <div class="lg:col-span-3 space-y-8 border border-gray-400 rounded-lg p-6">

                <h1 class="text-4xl font-bold text-gray-900 mb-2">
                    <?php echo e($blog->title); ?>

                </h1>

                <p class="text-gray-500 text-sm mb-4">
                    By <span class="font-semibold">
                        <?php echo e($blog->author ?? 'Admin'); ?>

                    </span> |
                    <?php echo e($blog->created_at->format('M d, Y')); ?>

                </p>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($blog->image): ?>
                    <img src="<?php echo e(asset('storage/' . $blog->image)); ?>" class="w-full h-64 object-contain rounded-lg mb-6">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="prose max-w-none text-gray-700">
                    <?php echo $blog->content; ?>

                </div>

                

            </div>

            
            <div class="lg:col-span-1 space-y-8">

                
                <div class="bg-white shadow rounded-lg p-6 text-center sticky top-20">

                    <img src="<?php echo e($blog->author_photo ? asset('storage/' . $blog->author_photo) : asset('images/avatar.png')); ?>"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">

                    <h4 class="font-bold text-lg">
                        <?php echo e($blog->author ?? 'Admin'); ?>

                    </h4>

                    <p class="text-gray-500 text-sm mt-2">
                        <?php echo e($blog->author_bio ?? 'Real estate expert sharing latest updates.'); ?>

                    </p>

                    
                    <div class="mt-6 border-t pt-4">
                        <h5 class="font-semibold mb-3 text-gray-700">Share This Article</h5>

                        <div class="flex justify-center gap-3">

                            
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->fullUrl())); ?>"
                                target="_blank"
                                class="bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700">
                                <i class="fab fa-facebook-f"></i>
                            </a>

                            
                            <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->fullUrl())); ?>&text=<?php echo e(urlencode($blog->title)); ?>"
                                target="_blank"
                                class="bg-sky-500 text-white px-3 py-2 rounded text-sm hover:bg-sky-600">
                                <i class="fab fa-messenger"></i>
                            </a>

                            
                            <a href="https://api.whatsapp.com/send?text=<?php echo e(urlencode($blog->title . ' ' . request()->fullUrl())); ?>"
                                target="_blank"
                                class="bg-green-500 text-white px-3 py-2 rounded text-sm hover:bg-green-600">
                                <i class="fab fa-whatsapp"></i>
                            </a>

                        </div>
                    </div>
                </div>


                


            </div>



        </div>
        <div class="container mx-auto max-w-6xl">
    <h3 class="text-2xl font-bold mb-2 pt-10">Related Blogs</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedBlogs ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                
                <div class="relative overflow-hidden h-48">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($related->image): ?>
                        <img src="<?php echo e(Storage::url($related->image)); ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             alt="<?php echo e($related->title); ?>">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                            No image
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <div class="absolute top-3 left-3 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                        ID: <?php echo e($related->id); ?>

                    </div>
                </div>

                
                <div class="p-5">
                    <h4 class="font-semibold text-lg mb-2">
                        <a href="<?php echo e(route('blogs.show', $related->slug)); ?>"
                           class="text-gray-800 hover:text-yellow-600 transition-colors">
                            <?php echo e($related->title); ?>

                        </a>
                    </h4>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        <?php echo e(\Illuminate\Support\Str::limit($related->excerpt, 80)); ?>

                    </p>

                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-xs text-gray-400">
                            <?php echo e($related->created_at->format('M d, Y')); ?>

                        </span>
                        <a href="<?php echo e(route('blogs.show', $related->slug)); ?>"
                           class="text-yellow-600 hover:text-yellow-700 text-sm font-medium inline-flex items-center gap-1">
                            Read more
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/frontend/blogs/show.blade.php ENDPATH**/ ?>