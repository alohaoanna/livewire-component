@php
extract(OANNA::forwardedAttributes($attributes, [
    'tooltipPosition',
    'tooltipKbd',
    'tooltip',
]));
@endphp

@php $tooltip = $tooltip ??= $attributes->get('tooltip'); @endphp

@props([
    'tooltipPosition' => 'top',
    'tooltipKbd' => null,
    'tooltip' => null,
])

@if ($tooltip)
    <oanna:tooltip :content="$tooltip">
        {{ $slot }}
    </oanna:tooltip>
@else
    {{ $slot }}
@endif
