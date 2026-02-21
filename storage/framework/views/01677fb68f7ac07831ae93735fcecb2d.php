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


<section class="container mx-auto py-14">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

        <!-- LEFT SIDE: Main + Thumbnail Swiper -->
        <div class="lg:col-span-8 space-y-6">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->images && count($property->images)): ?>
                <!-- Main Swiper -->
                <div class="swiper mainSwiper">
                    <div class="swiper-wrapper">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $property->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div class="swiper-slide">
                                <img src="<?php echo e(asset('storage/' . $image)); ?>" class="w-full h-96 object-cover rounded-lg">
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <!-- Thumbnail Swiper -->
                <div class="swiper thumbSwiper mt-2">
                    <div class="swiper-wrapper gap-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $property->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div class="swiper-slide cursor-pointer">
                                <img src="<?php echo e(asset('storage/' . $image)); ?>" class="w-20 h-20 object-cover rounded border border-gray-300">
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <img src="<?php echo e(asset('images/placeholder.png')); ?>" class="w-full h-96 object-cover rounded-lg">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Title and Price -->
            <div class="border border-gray-200 p-4 rounded-xl shadow">

            <span class="bg-green-500 text-white px-3 py-1 rounded text-sm capitalize mb-4 inline-block">Property_ID: <?php echo e($property->id); ?></span>
            <!-- Rent/Buy Badge -->
            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm capitalize mb-4 inline-block"><?php echo e($property->type); ?></span>
            <span class="bg-blue-600 text-white px-3 py-1 rounded text-sm mb-4 inline-block"> <?php echo e($property->availability); ?></span>
            <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold mb-2"><?php echo e($property->title); ?></h1>
            <p class="text-2xl text-blue-600 font-bold mb-4">Rs. <?php echo e(number_format($property->price, 0)); ?></p>
            </div>
            <div class="flex items-center gap-4 p-4">
            <i class="fa-solid fa-location-dot"></i>
            <p class="text-gray-600 mb-2"><?php echo e($property->location ?? $property->city); ?>, <?php echo e($property->state); ?>, <?php echo e($property->country); ?></p></div>




            <!-- Social Share -->
            <div class="flex border border-gray-200 rounded-lg p-2 gap-3 mb-6">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->fullUrl())); ?>" target="_blank" class="bg-blue-600 text-white px-3 py-1 rounded flex items-center gap-1"><i class="fab fa-facebook-f"></i> Share</a>
                <a href="https://www.messenger.com/shareArticle?mini=true&url=<?php echo e(urlencode(request()->fullUrl())); ?>&title=<?php echo e(urlencode($property->title)); ?>" target="_blank" class="bg-blue-700 text-white px-3 py-1 rounded flex items-center gap-1"><i class="fa-brands fa-facebook-messenger"></i> Share</a>
                <a href="https://instagram.com/intent/tweet?url=<?php echo e(urlencode(request()->fullUrl())); ?>&text=<?php echo e(urlencode($property->title)); ?>" target="_blank" class="bg-red-400 text-white px-3 py-1 rounded flex items-center gap-1"><i class="fab fa-instagram"></i> share</a>
                <a href="https://wa.me/?text=<?php echo e(urlencode($property->title . ' ' . request()->fullUrl())); ?>" target="_blank" class="bg-green-500 text-white px-3 py-1 rounded flex items-center gap-1"><i class="fab fa-whatsapp"></i> WhatsApp</a>
            </div>

            <div class="flex items-center pt-4 gap-3 mb-6">
                <p class="text-gray-700"><i class="fa-solid fa-bed"></i> <?php echo e($property->bedrooms); ?> Bedrooms</p>
                <p class="text-gray-700"><i class="fa-solid fa-bath"></i> <?php echo e($property->bathrooms); ?> Bathrooms</p>
                <p class="text-gray-700"><i class="fa-solid fa-ruler-combined"></i> <?php echo e($property->area); ?> sq.ft</p>
                <!-- Amenities -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->amenities && $property->amenities->count()): ?>
                <h3 class="text-lg font-semibold mb-2">Amenities</h3>
                <ul class="grid grid-cols-2 gap-2 mb-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $property->amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <li class="bg-gray-100 px-2 py-1 rounded text-sm">
                            <?php echo e($amenity->name); ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($amenity->pivot->distance)): ?>
                                (<?php echo e($amenity->pivot->distance); ?> <?php echo e($amenity->pivot->unit); ?>)
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>


            </div>

            <!-- Description -->
            <h3 class="text-lg font-semibold mb-2">Description</h3>
            <p class="text-gray-700 leading-relaxed mb-4"><?php echo $property->description; ?></p>


              <!-- Google Map -->

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->latitude && $property->longitude): ?>

                <div class="mt-6 h-64 md:h-96 rounded-lg overflow-hidden">

                    <iframe class="w-full h-full"
                        src="https://maps.google.com/maps?q=<?php echo e($property->latitude); ?>,<?php echo e($property->longitude); ?>&z=15&output=embed"
                        frameborder="0" allowfullscreen></iframe>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



            <!-- YouTube Video -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->youtube_link): ?>
                <div class="mt-6">
                    <iframe class="w-full h-64 md:h-96 rounded-lg"
                        src="<?php echo e(\Str::replace('watch?v=', 'embed/', $property->youtube_link)); ?>"
                        title="<?php echo e($property->title); ?>" frameborder="0" allowfullscreen></iframe>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        </div>

        <!-- RIGHT SIDE: Agent + Contact Form -->
        <div class="lg:col-span-4 space-y-6">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->agent): ?>
                <div class="border p-4 py-6 rounded-lg shadow sticky top-20">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">Contact Agent</h3>

                    <!-- Agent Photo -->
                    <img src="<?php echo e($property->agent->avatar ? asset('storage/' . $property->agent->avatar) : asset('images/avatar.png')); ?>"
                         alt="<?php echo e($property->agent->name); ?>"
                         class="w-24 h-24 rounded-full mb-4 object-cover">

                    <!-- Agent Info -->
                    <p><strong><?php echo e($property->agent->name); ?></strong></p>
                    <p>Email: <?php echo e($property->agent->email); ?></p>
                    <p>Phone: <?php echo e($property->agent->phone); ?></p>

                    <!-- Social Links -->
                    <div class="flex gap-3 my-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->agent->facebook): ?><a href="<?php echo e($property->agent->facebook); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->agent->twitter): ?><a href="<?php echo e($property->agent->twitter); ?>" target="_blank"><i class="fab fa-twitter"></i></a><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->agent->linkedin): ?><a href="<?php echo e($property->agent->linkedin); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($property->agent->instagram): ?><a href="<?php echo e($property->agent->instagram); ?>" target="_blank"><i class="fab fa-instagram"></i></a><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Contact Form -->
                    <form method="POST" action="<?php echo e(route('agent.contact', $property->agent->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="name" placeholder="Your Name" class="border p-2 w-full mb-2" required>
                        <input type="email" name="email" placeholder="Your Email" class="border p-2 w-full mb-2" required>
                        <textarea name="message" placeholder="Message" class="border p-2 w-full mb-2" required></textarea>

                        <!-- First Time Buyer -->
                        <div class="mb-4">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="first_time_buyer" value="yes">
                                <span class="font-medium">Are you a first-time buyer?</span>
                            </label>
                        </div>

                        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">Send Message</button>
                    </form>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    </div>

    <!-- Related Properties -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedProperties && $relatedProperties->count()): ?>
    <h2 class="text-2xl font-bold my-6">Related Properties</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedProperties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>

            <a href="<?php echo e(route('properties.show', $rel)); ?>"
               class="block relative bg-white rounded-xl shadow hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden">

                <img src="<?php echo e(isset($rel->images[0])
                        ? asset('storage/' . $rel->images[0])
                        : asset('images/placeholder.png')); ?>"
                     class="w-full h-48 object-cover">

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <?php echo e($rel->title); ?>

                    </h3>

                    <p class="text-gray-600 text-sm">
                        <?php echo e($rel->location ?? $rel->city); ?>

                    </p>

                    <p class="text-blue-600 font-bold text-lg mt-2">
                        Rs. <?php echo e(number_format($rel->price, 0)); ?>

                    </p>
                </div>

            </a>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    var thumbSwiper = new Swiper(".thumbSwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var mainSwiper = new Swiper(".mainSwiper", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: thumbSwiper,
        },
    });
</script>

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
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/frontend/properties/show.blade.php ENDPATH**/ ?>