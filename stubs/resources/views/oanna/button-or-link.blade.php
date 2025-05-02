@php
extract(Oanna::forwardedAttributes($attributes, [
    'type',
    'current',
    'href',
    'as',
]));
@endphp

@props([
    'type' => 'button',
    'current' => null,
    'href' => null,
    'as' => null,
])

@if ($as === 'div' && ! $href)
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@elseif ($as === 'a' || $href)
    <a href="{!! e($href) !!}" {{ $attributes }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $type) }}>
        {{ $slot }}
    </button>
@endif
