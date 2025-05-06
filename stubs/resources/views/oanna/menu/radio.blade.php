@php $iconTrailing = $iconTrailing ??= $attributes->pluck('icon:trailing'); @endphp
@php $iconClasses = $iconClasses ??= $attributes->pluck('icon:class'); @endphp

@props([
    'iconTrailing' => null,
    'variant' => 'default',
    'indent' => false,
    'suffix' => null,
    'label' => null,
    'kbd' => null,
])

@php
    if ($kbd) $suffix = $kbd;
    $target = $attributes->whereStartsWith('wire:model')->first();
@endphp

<label for="{{ $target }}" {{ $attributes }} data-oanna-menu-item-has-icon data-oanna-menu-radio>
    <div class="w-7">
        <div class="hidden group-data-checked/menu-radio:block">
            <oanna:icon icon="check" :class="$iconClasses" data-oanna-menu-item-icon />
        </div>
    </div>

    <input type="radio" id="{{ $target }}" name="{{ $target }}" {{ $attributes }} class="hidden" />

    {{ $label ?? $slot }}

    @if ($suffix)
        <div class="ms-auto opacity-50 text-xs">
            {{ $suffix }}
        </div>
    @endif

    @if (is_string($iconTrailing) && $iconTrailing !== '')
        <oanna:icon :icon="$iconTrailing" :class="$iconClasses" data-oanna-menu-item-icon />
    @elseif ($iconTrailing)
        {{ $iconTrailing }}
    @endif
</label>
