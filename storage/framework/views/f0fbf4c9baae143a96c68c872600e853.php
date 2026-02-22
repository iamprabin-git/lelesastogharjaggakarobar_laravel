<?php
    $company = \App\Models\Company::where('status', true)->first();
?>

<footer class="text-white"
    style="background: linear-gradient(135deg, <?php echo e($company->primary_color ?? '#111827'); ?>, <?php echo e($company->secondary_color ?? '#1f2937'); ?>);">

    
    <div class="container mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        
        <div class="pt-10">
            <div class="flex items-center gap-3 mb-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->logo): ?>
                    <img src="<?php echo e(asset('storage/' . $company->logo)); ?>"
                        class="h-16 w-16 rounded-full object-cover border-2 border-white">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <h2 class="text-2xl font-bold tracking-wide">
                    <?php echo e($company->name ?? 'RealEstate'); ?>

                </h2>
            </div>

            <p class="text-gray-200 leading-relaxed text-sm">
                We provide trusted real estate services including buying, selling, and renting properties with complete
                transparency and professionalism.
            </p>

            
            <div class="flex gap-4 mt-6 border rounded-lg p-1">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->facebook): ?>
                    <a href="<?php echo e($company->facebook); ?>" target="_blank"
                        class="bg-blue bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->instagram): ?>
                    <a href="<?php echo e($company->instagram); ?>" target="_blank"
                        class="bg-red bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->viber): ?>
                    <a href="<?php echo e($company->viber); ?>" target="_blank"
                        class="bg-white bg-opacity-20 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->youtube): ?>
                    <a href="<?php echo e($company->youtube); ?>" target="_blank"
                        class="bg-red bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->tiktok): ?>
                    <a href="<?php echo e($company->tiktok); ?>" target="_blank"
                        class="bg-red bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-tiktok"></i>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->whatsapp): ?>
                    <a href="<?php echo e($company->whatsapp); ?>" target="_blank"
                        class="bg-red bg-opacity-50 p-2 rounded-full hover:bg-yellow-500 transition">
                        <i class="fab fa-tiktok"></i>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <div class="pt-10">
            <h3 class="text-xl font-semibold mb-6 border-b border-white pb-2">
                About Company
            </h3>

            <ul class="space-y-3 text-gray-200 text-sm">
                <li><a href="/" class="hover:text-yellow-400 transition">Home</a></li>
                <li><a href="/properties" class="hover:text-yellow-400 transition">Properties</a></li>
                <li><a href="/agent-form" class="hover:text-yellow-400 transition">Agents</a></li>
                <li><a href="/about" class="hover:text-yellow-400 transition">About Us</a></li>
                <li><a href="/contact" class="hover:text-yellow-400 transition">Contact</a></li>
            </ul>
        </div>

        
        <div class="pt-10">
            <h3 class="text-xl font-semibold mb-6 border-b border-white pb-2">
                Quick Links
            </h3>

            <ul class="space-y-3 text-gray-200 text-sm">
                <li><a href="/faqs" class="hover:text-yellow-400 transition">FAQs</a></li>
                <li><a href="/blogs" class="hover:text-yellow-400 transition">Blog</a></li>
                <li><a href="/pricing" class="hover:text-yellow-400 transition">Pricing</a></li>
                <li><a href="/home-loan" class="hover:text-yellow-400 transition">Home Loan</a></li>
                <li><a href="/privacy-policy" class="hover:text-yellow-400 transition">Privacy Policy</a></li>
                <li><a href="/terms" class="hover:text-yellow-400 transition">Terms & Conditions</a></li>

            </ul>
        </div>

        
        <div class="pt-10">
            <h3 class="text-xl font-semibold mb-6 border-b border-white pb-2">
                Contact Us
            </h3>

            <ul class="space-y-3 text-gray-200 text-sm">
                <li class="flex items-center gap-2"><i class="fa-solid fa-location-dot"></i>
                    <?php echo e($company->address ?? 'Your Address Here'); ?></li>
                <li class="flex items-center gap-2"><i class="fa-solid fa-phone"></i>
                    <?php echo e($company->phone ?? '+977-9765726294'); ?> (What's App only)</li>
                <li class="flex items-center gap-2"><i
                        class="fa-solid fa-envelope"></i><?php echo e($company->email ?? 'info@realestate.com'); ?></li>
            </ul>

            
            <div class="mt-6 border border-white rounded-2xl p-6">
                <h4 class="font-semibold mb-3">Join Our WhatsApp Community</h4>
                <a href="https://chat.whatsapp.com/YOUR_GROUP_INVITE_LINK" target="_blank" rel="noopener noreferrer"
                    class="flex items-center justify-center w-full bg-green-500 hover:bg-green-800 text-white font-medium p-3 rounded-md transition duration-200">
                    <i class="fab fa-whatsapp mr-2 text-xl"></i>
                    Join WhatsApp Community
                </a>
            </div>
        </div>

    </div>

    
    <div
        class="container mx-auto py-3 px-4 flex flex-col md:flex-row justify-between items-center text-sm text-gray-300 bg-gray-900 bg-opacity-50 rounded-t-lg">

        
        <div class="text-center md:text-left">
            © <?php echo e(date('Y')); ?> <?php echo e($company->name ?? 'RealEstate'); ?>. All rights reserved.
        </div>

        
        <div class="text-center md:text-right">
            Developed by
            <span class="font-semibold hover:underline cursor-pointer">
                <a href="https://dangolprabin.com.np" target="_blank">Prabin Dangol</a>
            </span>
        </div>

    </div>

</footer>
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/components/footer.blade.php ENDPATH**/ ?>