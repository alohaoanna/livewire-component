@props([
    'variant' => 'default',
    'suffix' => null,
    'value' => null,
    'kbd' => null,
])

@php
    if ($kbd) $suffix = $kbd;
@endphp

<oanna:button-or-link :$attributes data-oanna-menu-item>
    {{ $slot }}

    @if ($suffix)
        @if (is_string($suffix))
            <div class="{{ $suffixClasses }}">
                {{ $suffix }}
            </div>
        @else
            {{ $suffix }}
        @endif
    @endif

    {{ $submenu ?? '' }}
</oanna:button-or-link>
