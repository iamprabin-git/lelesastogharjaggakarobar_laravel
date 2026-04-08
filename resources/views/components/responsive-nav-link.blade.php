@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full border-l-4 border-primary bg-primary/10 py-2 pe-4 ps-3 text-start text-base font-medium text-primary transition duration-150 ease-in-out focus:border-primary focus:bg-primary/[0.14] focus:outline-none dark:bg-primary/15 dark:text-primary'
            : 'block w-full border-l-4 border-transparent py-2 pe-4 ps-3 text-start text-base font-medium text-zinc-600 transition duration-150 ease-in-out hover:border-zinc-300 hover:bg-zinc-50 hover:text-zinc-900 focus:border-zinc-300 focus:bg-zinc-50 focus:text-zinc-900 focus:outline-none dark:text-zinc-400 dark:hover:border-zinc-600 dark:hover:bg-zinc-800/50 dark:hover:text-zinc-100 dark:focus:border-zinc-600';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
