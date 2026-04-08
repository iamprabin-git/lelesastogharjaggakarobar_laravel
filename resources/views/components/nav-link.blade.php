@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center border-b-2 border-primary px-1 pt-1 text-sm font-medium leading-5 text-primary transition duration-150 ease-in-out focus:border-primary focus:outline-none dark:text-primary'
            : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium leading-5 text-zinc-600 transition duration-150 ease-in-out hover:border-zinc-300 hover:text-zinc-900 focus:border-zinc-300 focus:text-zinc-900 focus:outline-none dark:text-zinc-400 dark:hover:border-zinc-600 dark:hover:text-zinc-100 dark:focus:border-zinc-600';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
