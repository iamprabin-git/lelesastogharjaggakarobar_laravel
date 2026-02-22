
<?php if (isset($component)) { $__componentOriginalff6de83cb070587833d4f86022c57961 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff6de83cb070587833d4f86022c57961 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.about','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('about'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff6de83cb070587833d4f86022c57961)): ?>
<?php $attributes = $__attributesOriginalff6de83cb070587833d4f86022c57961; ?>
<?php unset($__attributesOriginalff6de83cb070587833d4f86022c57961); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff6de83cb070587833d4f86022c57961)): ?>
<?php $component = $__componentOriginalff6de83cb070587833d4f86022c57961; ?>
<?php unset($__componentOriginalff6de83cb070587833d4f86022c57961); ?>
<?php endif; ?>




<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/frontend/about.blade.php ENDPATH**/ ?>