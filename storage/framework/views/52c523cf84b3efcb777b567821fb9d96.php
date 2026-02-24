<?php
    $team = \App\Models\TeamMember::where('is_active', true)->get();
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($team->count()): ?>
    <style>
        .team-card {
            perspective: 1000px;
        }
        .card-inner {
            position: relative;
            width: 100%;
            height: 480px; /* Slightly taller for better spacing */
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }
        .team-card:hover .card-inner {
            transform: rotateY(180deg);
        }
        .card-front, .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .card-front {
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .card-back {
            background: linear-gradient(145deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            transform: rotateY(180deg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        /* Ribbon */
        .ribbon {
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            overflow: hidden;
        }
        .ribbon span {
            position: absolute;
            display: block;
            width: 225px;
            padding: 8px 0;
            background-color: #f97316;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
            right: -25px;
            top: 30px;
            transform: rotate(45deg);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        /* Social icons on back */
        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s;
        }
        .social-icon:hover {
            background: white;
            color: #4f46e5;
            transform: scale(1.1);
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
    </style>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 text-center">

            <h2 class="text-4xl font-bold mb-14">Meet Our Team</h2>

            <div class="grid md:grid-cols-4 gap-6">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="team-card">

                        <div class="card-inner">

                            
                            <div class="card-front">

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->ribbon_text ?? false): ?>
                                    <div class="ribbon"><span><?php echo e($member->ribbon_text); ?></span></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->photo): ?>
                                    <img src="<?php echo e(Storage::url($member->photo)); ?>"
                                         class="w-50 h-60 rounded-full object-cover mb-4 border-4 border-gray-200"
                                         alt="<?php echo e($member->name); ?>">
                                <?php else: ?>
                                    <div class="w-32 h-32 rounded-full bg-gray-300 mb-4 flex items-center justify-center text-gray-600 text-4xl font-bold">
                                        <?php echo e(substr($member->name, 0, 1)); ?>

                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <h3 class="text-2xl font-bold text-gray-900"><?php echo e($member->name); ?></h3>
                                <p class="text-indigo-600 font-semibold mt-1"><?php echo e($member->position); ?></p>

                                
                                <div class="mt-4 text-sm text-gray-600 space-y-1">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->email): ?>
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fa-regular fa-envelope"></i>
                                            <span><?php echo e($member->email); ?></span>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->phone): ?>
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fa-regular fa-phone"></i>
                                            <span><?php echo e($member->phone); ?></span>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="card-back">

                                <h3 class="text-xl font-bold mb-2"><?php echo e($member->name); ?></h3>
                                <p class="text-indigo-200 font-medium mb-4"><?php echo e($member->position); ?></p>

                                <p class="text-sm leading-relaxed mb-6">
                                    <?php echo e($member->bio ?? 'Experienced professional dedicated to helping you find your dream property.'); ?>

                                </p>

                                
                                <div class="w-full text-left mb-6 space-y-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->email): ?>
                                        <div class="contact-item">
                                            <i class="fa-regular fa-envelope w-5"></i>
                                            <a href="mailto:<?php echo e($member->email); ?>" class="hover:underline truncate"><?php echo e($member->email); ?></a>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->phone): ?>
                                        <div class="contact-item">
                                            <i class="fa-regular fa-phone w-5"></i>
                                            <a href="tel:<?php echo e($member->phone); ?>" class="hover:underline"><?php echo e($member->phone); ?></a>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div class="flex justify-center gap-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->facebook): ?>
                                        <a href="<?php echo e($member->facebook); ?>" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->instagram): ?>
                                        <a href="<?php echo e($member->instagram); ?>" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->linkedin): ?>
                                        <a href="<?php echo e($member->linkedin); ?>" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->tiktok): ?>
                                        <a href="<?php echo e($member->tiktok); ?>" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-tiktok"></i>
                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->whatsapp): ?>
                                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $member->whatsapp)); ?>" target="_blank" class="social-icon">
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
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/components/team.blade.php ENDPATH**/ ?>