@php $iconTrailing = $iconTrailing ??= $attributes->pluck('icon:trailing'); @endphp
@php $iconLeading = $iconLeading ??= $attributes->pluck('icon:leading'); @endphp
@php $iconClasses = $iconClasses ??= $attributes->pluck('icon:class'); @endphp

@props([
    'iconTrailing' => null,
    'variant' => 'default',
    'iconLeading' => null,
    'iconClass' => null,
    'suffix' => null,
    'value' => null,
    'icon' => null,
    'kbd' => null,
])

@php
    $iconLeading = $icon ??= $iconLeading;

    if ($kbd) $suffix = $kbd;
@endphp

<oanna:button-or-link :$attributes data-oanna-menu-item data-variant="{{ $variant }}">
    @if (is_string($iconLeading) && $iconLeading !== '')
        <oanna:icon :icon="$iconLeading" :class="$iconClasses" />
    @else
        {{ $iconLeading }}
    @endif

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

    @if (is_string($iconTrailing) && $iconTrailing !== '')
        {{-- Adding the extra margin class inline on the icon component below was causing a double up, so it needs to be added here first... --}}
        <oanna:icon :icon="$iconTrailing" :variant="$iconVariant" :class="$iconClasses" />
    @elseif ($iconTrailing)
        {{ $iconTrailing }}
    @endif

    {{ $submenu ?? '' }}
</oanna:button-or-link>
