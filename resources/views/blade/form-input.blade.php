@props([
    'class' => 'col-md-8',
])
<!-- form-input blade component -->
<div {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>