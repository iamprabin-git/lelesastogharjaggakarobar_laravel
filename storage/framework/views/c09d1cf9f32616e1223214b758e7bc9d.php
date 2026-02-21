<?php
    $team = \App\Models\TeamMember::where('is_active', true)->get();
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($team->count()): ?>
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 text-center">

            <h2 class="text-4xl font-bold mb-14">Meet Our Team</h2>

            <div class="grid md:grid-cols-3 gap-10">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="group [perspective:1000px]">

                        <div
                            class="relative h-[420px] w-full transition-transform duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">

                            
                            <div
                                class="absolute inset-0 bg-white rounded-3xl shadow-xl p-8 flex flex-col items-center justify-center [backface-visibility:hidden]">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->photo): ?>
                                    <img src="<?php echo e(asset('storage/' . $member->photo)); ?>"
                                        class="w-35 h-45 rounded object-cover mb-4" alt="<?php echo e($member->name); ?>">
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <h3 class="text-2xl font-bold text-gray-900">
                                    <?php echo e($member->name); ?>

                                </h3>

                                <p class="text-primary font-semibold mt-2">
                                    <?php echo e($member->position); ?>

                                </p>

                            </div>



                            
                            <div
                                class="absolute inset-0 bg-primary text-white rounded-3xl shadow-xl p-8 flex flex-col justify-center items-center text-center [transform:rotateY(180deg)] [backface-visibility:hidden]">

                                
                                <p class="text-sm mb-6 leading-relaxed">
                                    <?php echo e($member->bio); ?>

                                </p>

                                
                                <div class="space-y-2 mb-6 text-sm">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->phone): ?>
                                        <p>
                                            <i class="fa-solid fa-phone"></i> <a href="tel:<?php echo e($member->phone); ?>" class="hover:underline">
                                                <?php echo e($member->phone); ?>

                                            </a>
                                        </p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->email): ?>
                                        <p> email
                                            <i class="fa-solid fa-envelope"></i> <a href="mailto:<?php echo e($member->email); ?>" class="hover:underline">
                                                <?php echo e($member->email); ?>

                                            </a>
                                        </p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </div>

                                
                                <div class="flex justify-center items-center gap-4  border border-primary/30 rounded-full p-4">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->facebook): ?>
                                        <a href="<?php echo e($member->facebook); ?>" target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->instagram): ?>
                                        <a href="<?php echo e($member->instagram); ?>" target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->linkedin): ?>
                                        <a href="<?php echo e($member->linkedin); ?>" target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->tiktok): ?>
                                        <a href="<?php echo e($member->tiktok); ?>" target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-tiktok"></i>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->whatsapp): ?>
                                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $member->whatsapp)); ?>"
                                            target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </div>

                            </div>


                        </div>

                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            </div>

        </div>
    </section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH G:\lelesastogharjagga_laravel_new\lelesastogharjaggakarobar_laravel\resources\views/components/team.blade.php ENDPATH**/ ?>