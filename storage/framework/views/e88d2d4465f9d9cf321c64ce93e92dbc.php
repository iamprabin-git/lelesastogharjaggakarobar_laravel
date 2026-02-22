<?php
    $company = \App\Models\Company::where('status', true)->first();
?>

<header class="w-full fixed top-0 z-50 transition-all duration-300 bg-white shadow-md" id="mainHeader">

    
    <div class="bg-green-400 text-white text-sm py-2 px-6 hidden md:flex justify-between items-center">
        <div class="flex items-center gap-6">
            <span><i class="fa-solid fa-phone"></i> <?php echo e($company->phone ?? '+977-9765726294'); ?></span>
            <span><i class="fa-solid fa-envelope"></i> <?php echo e($company->email ?? 'info.lelesastogharjaggakarobar@gmail.com'); ?></span>
        </div>

        <div class="flex items-center gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->facebook): ?>
                <a href="<?php echo e($company->facebook); ?>" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-facebook"></i></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->instagram): ?>
                <a href="<?php echo e($company->instagram); ?>" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-instagram"></i></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->youtube): ?>
                <a href="<?php echo e($company->youtube); ?>" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-youtube"></i></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->tiktok): ?>
                <a href="<?php echo e($company->tiktok); ?>" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-tiktok"></i></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->whatsapp): ?>
                <a href="<?php echo e($company->whatsapp); ?>" target="_blank" class="hover:text-yellow-400 transition"><i
                        class="fa-brands fa-whatsapp"></i></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <div class="container mx-auto flex justify-between items-center py-6 px-4">

        
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3 mb-4 hover:opacity-80 transition">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($company?->logo): ?>
                    <img src="<?php echo e(Storage::url($company->logo)); ?>"
                        class="h-16 w-16 rounded-full object-cover border-2 border-white" alt="<?php echo e($company->name); ?>">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <h2 class="text-2xl font-bold tracking-wide text-gray-900">
                    <?php echo e($company->name ?? 'RealEstate'); ?>

                </h2>
            </a>

        </div>

        
        <nav class="hidden md:flex items-center gap-8 font-medium text-gray-700">
            <a href="/" class="hover:text-yellow-500 transition">Home</a>
            <a href="/properties" class="hover:text-yellow-500 transition">Properties</a>
            <a href="/about" class="hover:text-yellow-500 transition">About</a>
            <a href="/contact" class="hover:text-yellow-500 transition">Contact</a>

            
            <a href="/agent/login"
                class="bg-yellow-500 text-white px-5 py-2 rounded-full shadow hover:bg-yellow-600 transition">
                + Add Property
            </a>
        </nav>

        
        <button id="menuBtn" class="md:hidden text-gray-800 text-2xl">
            ☰
        </button>
    </div>

    
    <div id="mobileMenu" class="hidden md:hidden bg-white shadow-lg">
        <div class="flex flex-col p-6 gap-4 text-gray-700 font-medium">
            <a href="/" class="hover:text-yellow-500">Home</a>
            <a href="/properties" class="hover:text-yellow-500">Properties</a>
            <a href="/about" class="hover:text-yellow-500">About</a>
            <a href="/contact" class="hover:text-yellow-500">Contact</a>
            <a href="/agent" class="bg-yellow-500 text-white text-center py-2 rounded-full">
                + Add Property
            </a>
        </div>
    </div>
</header>


<div class="h-32 md:h-28"></div>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/components/header.blade.php ENDPATH**/ ?>