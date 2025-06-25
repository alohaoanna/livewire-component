@props([
    "icon",
    "size" => "n",
    "variant" => "solid", // solid, regular, light, thin, brands
    "style" => null, // null, duotone
    "suffix" => null,
    "color" => null,
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
        $path = asset(config('oanna.icon.sprite') . $icon);
    }

    if (empty($color)) {
        $color = "#121212";
    }
@endphp

@if ($icon == "loading")
    <div data-loader data-size="{{ $size }}" {{ $attributes }}></div>
@else
    @if ($isFontawesome)
        <i class="{{ $class }}" data-size="{{ $size }}" {{ $attributes }} data-oanna-icon @if ($suffix) data-oanna-suffix @endif style="color: {{ $color }};"></i>
    @else
        <svg data-oanna-icon data-size="{{ $size }}" {{ $attributes }} @if ($suffix) data-oanna-suffix @endif style="fill: {{ $color }};">
            <use xlink:href="{{ $path }}"></use>
        </svg>
    @endif
@endif

