@props([
    'orientation' => null,
    'vertical' => false,
    'variant' => null,
    'faint' => false,
    'text' => null,
])

@php
$orientation ??= $vertical ? 'vertical' : 'horizontal';
@endphp

<div data-orientation="{{ $orientation }}" role="none" {{ $attributes }} data-oanna-separator></div>
