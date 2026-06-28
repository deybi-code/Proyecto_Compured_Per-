@props(['value'])
<label {{ $attributes->merge(['class' => 'cp-label']) }}>
    {{ $value ?? $slot }}
</label>
