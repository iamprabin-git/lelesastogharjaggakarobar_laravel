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
    <div class="container mx-auto px-6 max-w-4xl text-center">

        
        <h1 class="text-4xl font-bold mb-4">Payment Options</h1>
        <p class="text-gray-600 mb-12">
            Choose your preferred payment method for property listing or subscription plan and Advertisement Plan.
        </p>

        <div x-data="{ open: false, type: '' }">

            
            <div class="flex justify-center gap-6">
                <button
                    @click="open = true; type = 'qr'"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg shadow font-semibold">
                    QR Payment
                </button>

                <button
                    @click="open = true; type = 'bank'"
                    class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-3 rounded-lg shadow font-semibold">
                    Bank Transfer
                </button>
            </div>

            
            <div x-show="open"
                 class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50"
                 x-transition>

                
                <div class="bg-white w-full max-w-2xl rounded-xl shadow-lg p-8 relative"
                     @click.away="open = false">

                    
                    <button @click="open = false"
                        class="absolute top-3 right-4 text-gray-500 hover:text-black text-2xl">
                        &times;
                    </button>

                    
                    <div x-show="type === 'qr'" x-transition>
                        <h2 class="text-2xl font-bold mb-6 text-center">Scan & Pay</h2>

                        <div class="flex flex-col md:flex-row items-center justify-center gap-8">
                            <div class="text-center">
                                <img src="<?php echo e(asset('images/qr1.jpg')); ?>"
                                     class="w-80 h-80 mx-auto mb-2 rounded shadow">

                            </div>
                            <div class="text-center">
                                <img src="<?php echo e(asset('images/qr2.jpg')); ?>"
                                     class="w-80 h-80 mx-auto mb-2 rounded shadow">

                            </div>

                        </div>
                        <p class="mt-6 text-gray-600 text-center">
                            After payment, send screenshot to
                            <span class="text-yellow-600 font-semibold">
                                info.lelesastogharjaggakarobar@gmail.com
                            </span>
                        </p>
                    </div>

                    
                    <div x-show="type === 'bank'" x-transition>
    <h2 class="text-2xl font-bold mb-8 text-center">Bank Transfer Details</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto border border-gray-600 rounded-xl p-6">
        <!-- Left Column - Bank 1 -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">

                <div class="space-y-4">
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Bank Name</p>
                        <p class="text-gray-900 dark:text-white">Lumbini Bikash Bank, Lele Branch</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Account Name</p>
                        <p class="text-gray-900 dark:text-white">Prabin Dangol</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Account Number</p>
                        <p class="text-gray-900 dark:text-white font-mono">0411020131907000001</p>
                    </div>
                </div>
            </div>

            <!-- Optional: Add more details or notes for this bank -->

        </div>

        <!-- Right Column - Bank 2 (Add your second bank here) -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">


                <div class="space-y-4">
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Wallet</p>
                        <p class="text-gray-900 dark:text-white">Esewa</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Account Name</p>
                        <p class="text-gray-900 dark:text-white">Prabin Dangol</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Esewa Number</p>
                        <p class="text-gray-900 dark:text-white font-mono">+977-9808083620</p>
                    </div>

                </div>
            </div>

        </div>
         <!-- Common instruction below both columns -->
    <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
                Please include your name/reference in the remarks section
            </p>

            <!-- Optional: Instructions for second bank -->
            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
                After transfer, send screenshot to WhatsApp: +977-9765726294
            </p>
    </div>


    <p class="mt-10 text-gray-600 dark:text-gray-400 text-center text-lg">
        After successful payment, please send the transaction screenshot to:
        <br class="md:hidden">
        <span class="text-yellow-600 font-semibold hover:underline">
            info.lelesastogharjaggakarobar@gmail.com
        </span>
    </p>
</div>
                </div>
            </div>

        </div>

    </div>
</section>


<section class="min-h-screen bg-gray-100 flex items-center">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-0 bg-white shadow-xl rounded-xl overflow-hidden">

            
            <div class="hidden md:block relative">
                <img src="<?php echo e(asset('images/payment-verification.png')); ?>"
                     alt="Payment"
                     class="w-full h-full object-contain">

            </div>

            
            <div class="p-10">

                <h2 class="text-3xl font-bold mb-4 text-center">Payment Verification</h2>

                <p class="text-gray-600 mb-6 text-center">
                    Submit your payment details below. Our team will verify and activate your plan.
                </p>

                <form action="<?php echo e(route('payment.store')); ?>"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-4">
                    <?php echo csrf_field(); ?>

                    <div>
                        <input type="text" name="plan_name" placeholder="Plan Name"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-yellow-400"
                            required>
                    </div>

                    <div>
                        <input type="number" name="amount" placeholder="Amount"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-yellow-400"
                            required>
                    </div>

                    <div>
                        <input type="text" name="transaction_id"
                            placeholder="Transaction ID (optional)"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-yellow-400">
                    </div>

                    <div>
                        <input type="file" name="screenshot"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-yellow-400"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-lg font-semibold transition">
                        Submit Payment
                    </button>
                </form>

                
                <div class="mt-8 text-center border-t pt-6">
                    <h3 class="text-lg font-semibold mb-2">Need Help?</h3>
                    <p class="text-gray-600 mb-4 text-sm">
                        If you have any questions about the payment process, contact our support team.
                    </p>
                    <a href="mailto:info.lelesastogharjaggakarobar@gmail.com"
                       class="inline-block bg-gray-900 hover:bg-gray-800 text-white px-5 py-2 rounded-lg text-sm">
                        Contact Support
                    </a>
                </div>

            </div>
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
<?php /**PATH G:\lelesastogharjagga_laravel_new\lelesastogharjaggakarobar_laravel\resources\views/frontend/qr.blade.php ENDPATH**/ ?>