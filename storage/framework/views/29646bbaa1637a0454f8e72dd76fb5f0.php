<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? config('app.name', 'Laravel')); ?></title>

    <script>
        (function () {
            try {
                var k = 're_theme';
                var t = localStorage.getItem(k);
                if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        })();
    </script>
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/legacy.ts']); ?>
</head>
<body class="flex h-full items-center justify-center bg-background p-4 font-sans antialiased text-foreground sm:p-6 lg:p-8">
    <div class="w-full max-w-lg">
        <!-- Card -->
        <div class="overflow-hidden rounded-2xl border border-border bg-card text-card-foreground shadow-xl ring-1 ring-zinc-200/80 backdrop-blur-sm dark:ring-zinc-800">
            <!-- Header / Branding -->
            <div class="border-b border-border px-8 pt-10 pb-6 text-center">
                <a href="<?php echo e(url('/')); ?>">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="mx-auto h-12 w-auto" />
                </a>
                <h1 class="mt-6 text-2xl font-bold tracking-tight text-foreground">
                    <?php echo e($title ?? 'Welcome'); ?>

                </h1>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($subtitle)): ?>
                    <p class="mt-2 text-muted-foreground">
                        <?php echo e($subtitle); ?>

                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Form Content -->
            <div class="p-8 sm:p-10">
                <?php echo e($slot); ?>

            </div>
        </div>

        <!-- Footer links -->
        <div class="mt-8 text-center text-sm text-muted-foreground">
            © <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?> •
            <a href="#" class="text-primary hover:underline">Privacy</a> •
            <a href="#" class="text-primary hover:underline">Terms</a>
        </div>
    </div>
</body>
</html>
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/layouts/guest.blade.php ENDPATH**/ ?>