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


<?php
$company = \App\Models\Company::where('status', true)->first();
?>

<!-- ================= HERO SECTION ================= -->
<section class="relative bg-gray-900 text-white py-28">
    <div class="absolute inset-0">
        <img src="/images/contact-hero.jpg"
             class="w-full h-full object-cover opacity-40"
             alt="Contact Hero">
    </div>

    <div class="relative container mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6">
            Contact Us
        </h1>
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200">
            We are here to help you find your dream property.
        </p>
    </div>
</section>

<!-- ================= CONTACT SECTION ================= -->
<section class="container mx-auto px-6 py-20 grid grid-cols-1 lg:grid-cols-2 gap-16">

    <!-- LEFT SIDE -->
    <div class="space-y-8">

        <!-- Address -->
        <div class="bg-white shadow-lg rounded-2xl p-6 flex gap-5 hover:shadow-xl transition">
            <div class="text-yellow-500 text-2xl">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Office Address</h3>
                <p class="text-gray-600">
                    <?php echo e($company->address ?? 'Your office address here'); ?>

                </p>
            </div>
        </div>

        <!-- Phone -->
        <div class="bg-white shadow-lg rounded-2xl p-6 flex gap-5 hover:shadow-xl transition">
            <div class="text-yellow-500 text-2xl">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Phone Number</h3>
                <p class="text-gray-600">
                    <?php echo e($company->phone ?? '+977-9765726294'); ?>

                </p>
                <span class="text-sm text-gray-500">(WhatsApp message only)</span>
            </div>
        </div>

        <!-- Email -->
        <div class="bg-white shadow-lg rounded-2xl p-6 flex gap-5 hover:shadow-xl transition">
            <div class="text-yellow-500 text-2xl">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Email Address</h3>
                <p class="text-gray-600">
                    <?php echo e($company->email ?? 'info@realestate.com'); ?>

                </p>
            </div>
        </div>

        <!-- Social Icons -->
        <div class="flex flex-wrap gap-4 pt-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['facebook','instagram','viber','tiktok','youtube','whatsapp']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->$social): ?>
                    <a href="<?php echo e($company->$social); ?>" target="_blank"
                       class="bg-gray-200 p-3 rounded-full hover:bg-yellow-500 hover:text-white transition">
                        <i class="fa-brands fa-<?php echo e($social); ?>"></i>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

    </div>

    <!-- RIGHT SIDE - FORM -->
    <div class="bg-white shadow-2xl rounded-2xl p-10">

        <h2 class="text-3xl font-bold mb-8 text-gray-800">
            Send Us a Message
        </h2>

        <form action="<?php echo e(route('contact.submit')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block mb-2 font-medium">Full Name</label>
                <input type="text" name="name" required
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">
            </div>

            <div>
                <label class="block mb-2 font-medium">Email Address</label>
                <input type="email" name="email" required
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">
            </div>

            <div>
                <label class="block mb-2 font-medium">Phone Number</label>
                <input type="text" name="phone"
                       class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">
            </div>

            <div>
                <label class="block mb-2 font-medium">Message</label>
                <textarea name="message" rows="4" required
                          class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none"></textarea>
            </div>

            <button type="submit"
                    class="w-full bg-yellow-500 text-white py-3 rounded-xl font-semibold hover:bg-yellow-600 transition duration-300">
                Send Message
            </button>
        </form>

    </div>

</section>

<!-- ================= GOOGLE MAP ================= -->
<section>
    <iframe
        src="https://maps.google.com/maps?q=<?php echo e(urlencode($company->address ?? 'lele, lalitpur')); ?>&t=&z=13&ie=UTF8&iwloc=&output=embed"
        class="w-full h-96"
        loading="lazy">
    </iframe>
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
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views\components/contact.blade.php ENDPATH**/ ?>