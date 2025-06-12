@php $iconTrailing = $iconTrailing ??= $attributes->pluck('icon:trailing'); @endphp
@php $iconVariant = $iconVariant ??= $attributes->pluck('icon:variant'); @endphp

@props([
    "iconVariant" => "solid", // solid, regular, light, thin, brands
    'iconTrailing' => null,
    'variant' => 'default', // default, opacity, border
    'color' => 'zinc',
    'inset' => null,
    'size' => 'm', // xs, s, m, l, xl
    'icon' => null,
    "name" => null,
])

@php
    $attributes->offsetSet('data-color', $color);
    $attributes->offsetSet('data-size', $size);
    $attributes->offsetSet('data-variant', $variant);

    if ($color == 'auto') {
        $colors = config('oanna.colors');
        $color = $colors[rand(0, (count($colors) - 1))];
    }
@endphp

<oanna:button-or-div :$attributes data-oanna-badge>
    @if (is_string($icon) && $icon !== '')
    <oanna:icon :$icon :variant="$iconVariant" data-oanna-badge-icon />
    @else
    {{ $icon }}
    @endif

    {{ $name ?? $slot }}

    @if ($iconTrailing)
    <div class="ps-1 flex items-center" data-oanna-badge-icon:trailing>
            @if (is_string($iconTrailing))
                <oanna:icon :icon="$iconTrailing" :variant="$iconVariant" />
            @else
                {{ $iconTrailing }}
            @endif
        </div>
    @endif
</oanna:button-or-div>
