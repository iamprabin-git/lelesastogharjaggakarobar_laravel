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
    <div class="container mx-auto px-6 max-w-4xl">

        <!-- Section Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900">Terms & Conditions</h1>
            <p class="text-gray-600 mt-2">
                Rules and guidelines for using Lele Sasto Ghar Jagga Karobar
            </p>
        </div>

        <!-- Terms Content -->
        <div class="bg-white shadow-lg rounded-xl p-8 prose max-w-none text-gray-700">

            <h2>Introduction</h2>
            <p>Welcome to Lele Sasto Ghar Jagga Karobar. By accessing our website (<a href="https://lelesastogharjaggakarobar.com" class="text-blue-600 hover:underline">https://lelesastogharjaggakarobar.com</a>), you agree to comply with these Terms & Conditions. If you do not agree, please do not use our website.</p>

            <h2>Use of Website</h2>
            <ul>
                <li>You must be at least 18 years old to use this website.</li>
                <li>You agree to use our website for lawful purposes only.</li>
                <li>You are responsible for maintaining the confidentiality of any account you create.</li>
            </ul>

            <h2>Property Listings</h2>
            <p>All property information, images, and details on our website are provided for informational purposes. While we strive to provide accurate information, Lele Sasto Ghar Jagga Karobar does not guarantee that all listings are accurate, complete, or current.</p>

            <h2>User Responsibilities</h2>
            <ul>
                <li>You agree not to misuse our website, including uploading malicious content or spamming.</li>
                <li>Any inquiries, bookings, or transactions you make are your responsibility.</li>
                <li>We reserve the right to suspend or terminate accounts that violate these terms.</li>
            </ul>

            <h2>Intellectual Property</h2>
            <p>All content, including text, images, logos, and software on our website, is owned by Lele Sasto Ghar Jagga Karobar or its licensors. You may not reproduce, distribute, or use any content without prior written permission.</p>

            <h2>Third-Party Links</h2>
            <p>Our website may include links to third-party websites. We are not responsible for the content, privacy policies, or practices of these third-party sites. Please read their terms and privacy policies carefully.</p>

            <h2>Limitation of Liability</h2>
            <p>Lele Sasto Ghar Jagga Karobar is not liable for any damages, losses, or expenses arising from your use of the website, property transactions, or reliance on any information provided. Use the website at your own risk.</p>

            <h2>Changes to Terms</h2>
            <p>We may update these Terms & Conditions from time to time. Any changes will be posted on this page. Continued use of the website constitutes your acceptance of the updated terms.</p>

            <h2>Governing Law</h2>
            <p>These Terms & Conditions are governed by the laws of Nepal. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of Nepali courts.</p>

            <h2>Contact Us</h2>
            <p>If you have questions regarding these Terms & Conditions, please contact us at <a href="mailto:info@lelesastogharjaggakarobar.com" class="text-blue-600 hover:underline">info@lelesastogharjaggakarobar.com</a>.</p>

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
<?php /**PATH G:\lelesastogharjagga_laravel_new\lelesastogharjaggakarobar_laravel\resources\views/frontend/terms.blade.php ENDPATH**/ ?>