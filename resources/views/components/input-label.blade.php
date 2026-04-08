@props(['value'])

<label {{ $attributes->merge(['class' => 'text-foreground block text-sm font-medium']) }}>
    {{ $value ?? $slot }}
</label>
