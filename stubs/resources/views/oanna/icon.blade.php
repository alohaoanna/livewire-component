@props([
    "icon",
    "variant" => "solid", // solid, regular, light, thin, brands
    "style" => null, // null, duotone
])

@php
    $isFontawesome = ! is_null(config('oanna.icon.fontawesome'));
    if ($isFontawesome) {
        $class = "fa-{$variant} ";

        if (! is_null($style)) {
            $class .= "fa-{$style} ";
        }

        $class .= "fa-{$icon}";
    }
    else {
        $path = config('oanna.icon.sprite') . "#" . $icon;
    }
@endphp

@if ($isFontawesome)
    <i class="{{ $class }}" data-oanna-icon></i>
@else
    <svg data-oanna-icon>
        <use xlink:href="{{ $path }}"></use>
    </svg>
@endif

