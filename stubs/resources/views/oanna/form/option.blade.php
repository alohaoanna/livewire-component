@props([
    'checked' => null,
])

<oanna-option {{ $attributes }} @if($checked) data-active @endif data-oanna-select-option>
    <oanna:icon icon="check" data-oanna-option-icon />

    {{ $slot }}
</oanna-option>
