{{--@php--}}
{{--extract(Oanna::forwardedAttributes($attributes, [--}}
{{--    'tooltipPosition',--}}
{{--    'tooltipKbd',--}}
{{--    'tooltip',--}}
{{--]));--}}
{{--@endphp--}}

@php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); @endphp
@php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); @endphp
@php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); @endphp

@props([
    'tooltipPosition' => 'top',
    'tooltipKbd' => null,
    'tooltip' => null,
])

@if ($tooltip)
    <oanna:tooltip :content="$tooltip" :position="$tooltipPosition" :kbd="$tooltipKbd">
        {{ $slot }}
    </oanna:tooltip>
@else
    {{ $slot }}
@endif
