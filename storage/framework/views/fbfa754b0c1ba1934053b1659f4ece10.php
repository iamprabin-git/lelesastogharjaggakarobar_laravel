<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['active']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['active']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$classes = ($active ?? false)
            ? 'inline-flex items-center border-b-2 border-primary px-1 pt-1 text-sm font-medium leading-5 text-primary transition duration-150 ease-in-out focus:border-primary focus:outline-none dark:text-primary'
            : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium leading-5 text-zinc-600 transition duration-150 ease-in-out hover:border-zinc-300 hover:text-zinc-900 focus:border-zinc-300 focus:text-zinc-900 focus:outline-none dark:text-zinc-400 dark:hover:border-zinc-600 dark:hover:text-zinc-100 dark:focus:border-zinc-600';
?>

<a <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</a>
<?php /**PATH G:\lelesastogharagga_laravel\realestate\resources\views/components/nav-link.blade.php ENDPATH**/ ?>