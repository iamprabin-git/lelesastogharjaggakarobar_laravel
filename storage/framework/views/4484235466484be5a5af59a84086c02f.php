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
    $about = \App\Models\AboutSection::first();
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($about): ?>

<!-- ================= HERO SECTION ================= -->
<section class="relative bg-gray-900 text-white py-28">
    <div class="absolute inset-0">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($about->hero_image): ?>
            <img src="<?php echo e(asset('storage/'.$about->hero_image)); ?>"
                 class="w-full h-full object-cover opacity-40">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="relative container mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6">
            <?php echo e($about->hero_title); ?>

        </h1>
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200">
            <?php echo e($about->hero_description); ?>

        </p>
    </div>
</section>


<!-- ================= COMPANY STORY ================= -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($about->about_image): ?>
        <div>
            <img src="<?php echo e(asset('storage/'.$about->about_image)); ?>"
                 class="rounded-3xl shadow-2xl w-full">
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div>
            <h2 class="text-4xl font-bold mb-6 text-gray-900">
                Building Dreams with Trust & Excellence
            </h2>

            <div class="prose max-w-none text-gray-600">
                <?php echo $about->mission; ?>

            </div>
        </div>

    </div>
</section>


<!-- ================= STATS SECTION ================= -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6 text-center">

        <h2 class="text-4xl font-bold mb-12">
            Our Achievements
        </h2>

        <div class="grid md:grid-cols-3 gap-12">

            <div class="bg-white shadow-lg rounded-2xl p-10 hover:shadow-2xl transition">
                <h3 class="text-5xl font-bold text-primary mb-4">
                    <?php echo e($about->experience_years); ?>+
                </h3>
                <p class="text-gray-600 text-lg">Years of Experience</p>
            </div>

            <div class="bg-white shadow-lg rounded-2xl p-10 hover:shadow-2xl transition">
                <h3 class="text-5xl font-bold text-primary mb-4">
                    <?php echo e($about->properties_sold); ?>+
                </h3>
                <p class="text-gray-600 text-lg">Properties Sold</p>
            </div>

            <div class="bg-white shadow-lg rounded-2xl p-10 hover:shadow-2xl transition">
                <h3 class="text-5xl font-bold text-primary mb-4">
                    <?php echo e($about->happy_clients); ?>+
                </h3>
                <p class="text-gray-600 text-lg">Happy Clients</p>
            </div>

        </div>
    </div>
</section>


<!-- ================= MISSION & VISION TABS ================= -->
<section class="py-20 bg-white border border-gray-200 rounded-xl shadow">
    <div class="container mx-auto px-6 max-w-4xl">

        <!-- Section Header -->
        <div class="text-center mb-12 ">
            <h2 class="text-4xl font-bold text-gray-900">
                Our Purpose & Direction
            </h2>
            <p class="text-gray-600 mt-4">
                What drives our company forward
            </p>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-6">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center"
                id="missionVisionTab"
                data-tabs-toggle="#missionVisionTabContent"
                role="tablist">

                <!-- Mission Tab -->
                <li class="me-2" role="presentation">
                    <button
                        class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600 group"
                        id="mission-tab"
                        data-tabs-target="#mission"
                        type="button"
                        role="tab">

                        <svg class="w-4 h-4 me-2 group-hover:text-blue-600"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        Mission
                    </button>
                </li>

                <!-- Vision Tab -->
                <li class="me-2" role="presentation">
                    <button
                        class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-blue-600 hover:border-blue-600 group"
                        id="vision-tab"
                        data-tabs-target="#vision"
                        type="button"
                        role="tab">

                        <svg class="w-4 h-4 me-2 group-hover:text-blue-600"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A2 2 0 0122 9.618v4.764a2 2 0 01-2.447 1.894L15 14M4 6h16M4 12h16M4 18h16" />
                        </svg>

                        Vision
                    </button>
                </li>

            </ul>
        </div>

        <!-- Tab Content -->
        <div id="missionVisionTabContent">

            <!-- Mission Content -->
            <div class="hidden p-6 bg-gray-50 rounded-xl shadow"
                 id="mission"
                 role="tabpanel">
                <div class="prose max-w-none text-gray-700">
                    <?php echo $about->mission; ?>

                </div>
            </div>

            <!-- Vision Content -->
            <div class="hidden p-6 bg-gray-50 rounded-xl shadow"
                 id="vision"
                 role="tabpanel">
                <div class="prose max-w-none text-gray-700">
                    <?php echo $about->vision; ?>

                </div>
            </div>

        </div>

    </div>
</section>




<!-- ================= WHY CHOOSE US ================= -->
<section class="py-20 bg-gray-900 text-white">
    <div class="container mx-auto px-6 text-center">

        <h2 class="text-4xl font-bold mb-12">
            Why Choose Us
        </h2>

        <div class="grid md:grid-cols-3 gap-10">

            <div class="bg-gray-800 p-8 rounded-2xl hover:bg-gray-700 transition">
                <h4 class="text-2xl font-semibold mb-4">Trusted Expertise</h4>
                <p class="text-gray-400">
                    <?php echo e($about->experience_years); ?> years of real estate excellence.
                </p>
            </div>

            <div class="bg-gray-800 p-8 rounded-2xl hover:bg-gray-700 transition">
                <h4 class="text-2xl font-semibold mb-4">Client Focused</h4>
                <p class="text-gray-400">
                    Over <?php echo e($about->happy_clients); ?> satisfied clients.
                </p>
            </div>

            <div class="bg-gray-800 p-8 rounded-2xl hover:bg-gray-700 transition">
                <h4 class="text-2xl font-semibold mb-4">Proven Results</h4>
                <p class="text-gray-400">
                    Successfully sold <?php echo e($about->properties_sold); ?> properties.
                </p>
            </div>

        </div>
    </div>
</section>



<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<?php if (isset($component)) { $__componentOriginal7f1876299503f07db6a030e4a0fb9c5d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f1876299503f07db6a030e4a0fb9c5d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.team','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('team'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f1876299503f07db6a030e4a0fb9c5d)): ?>
<?php $attributes = $__attributesOriginal7f1876299503f07db6a030e4a0fb9c5d; ?>
<?php unset($__attributesOriginal7f1876299503f07db6a030e4a0fb9c5d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f1876299503f07db6a030e4a0fb9c5d)): ?>
<?php $component = $__componentOriginal7f1876299503f07db6a030e4a0fb9c5d; ?>
<?php unset($__componentOriginal7f1876299503f07db6a030e4a0fb9c5d); ?>
<?php endif; ?>

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
<?php /**PATH G:\lelesastogharjagga_laravel_new\lelesastogharjaggakarobar_laravel\resources\views/components/about.blade.php ENDPATH**/ ?>