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
            <h1 class="text-4xl font-bold text-gray-900">Privacy Policy</h1>
            <p class="text-gray-600 mt-2">
                How we collect, use, and protect your information at Lele Sasto Ghar Jagga Karobar
            </p>
        </div>

        <!-- Policy Content -->
        <div class="bg-white shadow-lg rounded-xl p-8 prose max-w-none text-gray-700">

            <h2>Introduction</h2>
            <p>At Lele Sasto Ghar Jagga Karobar, accessible from <a href="https://lelesastogharjagga.com.np" class="text-blue-600 hover:underline">our website</a>, one of our top priorities is the privacy of our visitors. This Privacy Policy explains the types of information we collect and how we use it.</p>

            <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with respect to the information they share or collect. It does not apply to information collected offline or through other channels.</p>

            <h2>Consent</h2>
            <p>By using our website, you consent to this Privacy Policy and agree to its terms.</p>

            <h2>Information We Collect</h2>
            <p>We may collect personal information in the following ways:</p>
            <ul>
                <li>When you contact us directly, we may receive your name, email address, phone number, and message content.</li>
                <li>When you register an account, we may request your name, company, address, email, and phone number.</li>
            </ul>

            <h2>How We Use Your Information</h2>
            <p>Your information may be used to:</p>
            <ul>
                <li>Provide, operate, and maintain our website</li>
                <li>Improve, personalize, and expand our website</li>
                <li>Understand and analyze how you use our website</li>
                <li>Develop new products, services, features, and functionality</li>
                <li>Communicate with you for customer service, updates, or marketing purposes</li>
                <li>Send emails and newsletters</li>
                <li>Prevent fraud and ensure security</li>
            </ul>

            <h2>Log Files</h2>
            <p>We follow standard procedures using log files. These files log visitors when they access our site, collecting information such as IP addresses, browser type, ISP, date and time, referring/exit pages, and clicks. This information is used to analyze trends and improve our services. It is not linked to personally identifiable information.</p>

            <h2>Cookies and Web Beacons</h2>
            <p>We use cookies to enhance your browsing experience by storing preferences and tracking pages you visit. You can disable cookies in your browser settings.</p>

            <h2>Third-Party Privacy Policies</h2>
            <p>Lele Sasto Ghar Jagga Karobar may display ads using third-party advertising networks. We do not have control over these cookies or technologies. Please consult each third-party’s Privacy Policy for more details.</p>

            <h2>CCPA Privacy Rights</h2>
            <p>California consumers have the right to request disclosure, deletion, or restriction of personal information collected by us. Contact us to exercise these rights.</p>

            <h2>GDPR Data Protection Rights</h2>
            <p>If you are a resident of the European Economic Area, you have the following rights:</p>
            <ul>
                <li>Right to access your personal data</li>
                <li>Right to correct inaccurate or incomplete data</li>
                <li>Right to erasure under certain conditions</li>
                <li>Right to restrict processing</li>
                <li>Right to object to processing</li>
                <li>Right to data portability</li>
            </ul>

            <h2>Children’s Information</h2>
            <p>We do not knowingly collect personal information from children under 13. Parents or guardians should contact us if they suspect any collection of such information.</p>

            <h2>Changes to This Privacy Policy</h2>
            <p>We may update this Privacy Policy periodically. Any changes will be posted on this page, effective immediately.</p>

            <h2>Contact Us</h2>
            <p>If you have questions about this Privacy Policy, please contact us at <a href="mailto:info.lelesastogharjaggakarobar@gmail.com" class="text-blue-600 hover:underline">info.lelesastogharjaggakarobar@gmail.com</a>.</p>

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
<?php /**PATH G:\lelesastogharjagga_laravel_new\lelesastogharjaggakarobar_laravel\resources\views/frontend/privacy_policy.blade.php ENDPATH**/ ?>