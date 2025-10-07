@props([
    'name',
    'class' => "icon",
    'path' => null,
])

<svg {{ $attributes }} class="{{ $class }}">
    <use xlink:href="{{ ($path ?? config('oanna.icon.sprite')) . "#" . $name }}"></use>
</svg>
