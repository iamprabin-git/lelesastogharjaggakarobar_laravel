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


<section class="min-h-screen bg-cover bg-center flex items-center justify-center"
    style="background-image: url('/images/bg.jpg');">

    
    <div class="absolute inset-0 bg-black/60"></div>

    
    <div class="relative z-10 max-w-5xl w-full bg-white rounded-xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        
        <div class="hidden md:block bg-contain"
            style="background-image: url('/images/agency.png');">
        </div>

        
        <div class="p-8 md:p-12">

            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">
                Agent Registration
            </h1>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <li><?php echo e($error); ?></li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form action="<?php echo e(route('agent.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    
                    <div>
                        <label class="block font-medium mb-1">Name</label>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400"
                            required>
                    </div>

                    
                    <div>
                        <label class="block font-medium mb-1">Email</label>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400"
                            required>
                    </div>

                    
                    <div>
                        <label class="block font-medium mb-1">Phone</label>
                        <input type="text" name="phone" value="<?php echo e(old('phone')); ?>"
                            class="w-full border rounded p-2">
                    </div>

                    
<div> <label class="block font-medium mb-1">Password</label> <input type="password" name="password" class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400" required> </div>

<div> <label class="block font-medium mb-1">Confirm Password</label> <input type="password" name="password_confirmation" class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400" required> </div>

                    
                    <div>
                        <label class="block font-medium mb-1">Avatar</label>
                        <input type="file" name="avatar"
                            class="w-full border rounded p-2 bg-white">
                    </div>

                </div>

                
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        Submit Agent Request
                    </button>
                </div>

            </form>

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
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/frontend/agent_form.blade.php ENDPATH**/ ?>