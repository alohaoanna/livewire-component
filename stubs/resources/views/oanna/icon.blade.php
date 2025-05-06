@props([
    "icon",
    "variant" => "solid", // solid, regular, light, thin, brands
    "style" => null, // null, duotone
    "suffix" => null,
    "class" => null,
])

@php
    $isFontawesome = ! is_null(config('oanna.icon.fontawesome'));
    if ($isFontawesome) {
        $fontawesomeClass = "fa-{$variant} ";

        if (! is_null($style)) {
            $fontawesomeClass .= "fa-{$style} ";
        }

        $fontawesomeClass .= "fa-{$icon}";

        $class .=  " " . $fontawesomeClass;
    }
    else {
        $path = config('oanna.icon.sprite') . "#" . $icon;
    }
@endphp

@if ($isFontawesome)
    <i class="{{ $class }}" data-oanna-icon @if ($suffix) data-oanna-suffix @endif></i>
@else
    <svg data-oanna-icon @if ($suffix) data-oanna-suffix @endif>
        <use xlink:href="{{ $path }}"></use>
    </svg>
@endif

