@props([
    'checked' => null,
])
@if (!empty($checked))
    <oanna-option {{ $attributes }} @if($checked) data-active @endif data-oanna-select-option>
        <oanna:icon icon="check" data-oanna-option-icon />

        {{ $slot }}
    </oanna-option>
@else
    <option {{ $attributes }} data-oanna-select-option>
        {{ $slot }}
    </option>
@endif
