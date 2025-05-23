@php $iconTrailing = $iconTrailing ??= $attributes->pluck('icon:trailing'); @endphp
@php $iconLeading = $iconLeading ??= $attributes->pluck('icon:leading'); @endphp
@php $iconVariant = $iconVariant ??= $attributes->pluck('icon:variant'); @endphp
@php $iconSize = $iconSize ??= $attributes->pluck('icon:size'); @endphp

@props([
    'iconTrailing' => null,
    'variant' => 'filled',
    'iconLeading' => null,
    'iconVariant' => null,
    'iconSize' => null,
    'type' => 'button',
    'loading' => null,
    'size' => 'base',
    'square' => null,
    'inset' => null,
    'icon' => null,
    'kbd' => null,
])

@php
    $iconLeading = $icon ??= $iconLeading;

    // Button should be a square if it has no text contents...
    $square ??= $slot->isEmpty();

    $isTypeSubmitAndNotDisabledOnRender = $type === 'submit' && ! $attributes->has('disabled');

    $isJsMethod = str_starts_with($attributes->whereStartsWith('wire:click')->first() ?? '', '$js.');

    $loading ??= $loading ?? ($isTypeSubmitAndNotDisabledOnRender || $attributes->whereStartsWith('wire:click')->isNotEmpty() && ! $isJsMethod);

    if ($loading && $type !== 'submit' && ! $isJsMethod) {
        $attributes = $attributes->merge(['wire:loading.attr' => 'data-oanna-loading']);

        // We need to add `wire:target` here because without it the loading indicator won't be scoped
        // by method params, causing multiple buttons with the same method but different params to
        // trigger each other's loading indicators...
        if (! $attributes->has('wire:target') && $target = $attributes->whereStartsWith('wire:click')->first()) {
            $attributes = $attributes->merge(['wire:target' => $target], escape: false);
        }
    }

    $attributes->offsetSet('data-oanna-button', '');
    $attributes->offsetSet('data-button-variant', $variant);
@endphp

<oanna:with-tooltip :$attributes>
    <oanna:button-or-link :$type :$attributes data-oanna-button>
        @if ($loading)
            <div data-oanna-loader>
                <div data-loader></div>
            </div>
        @endif


        @if (is_string($iconLeading) && $iconLeading !== '')
            <oanna:icon :icon="$iconLeading" :class="$iconClasses" />
        @else
            {{ $iconLeading }}
        @endif

        @if ($loading && ! $slot->isEmpty())
            <span>{{ $slot }}</span>
        @else
            {{ $slot }}
        @endif

        @if ($kbd)
            <div data-oanna-kbd>{{ $kbd }}</div>
        @endif

        @if (is_string($iconTrailing) && $iconTrailing !== '')
            <oanna:icon :icon="$iconTrailing" :class="$iconClasses" />
        @elseif ($iconTrailing)
            {{ $iconTrailing }}
        @endif
    </oanna:button-or-link>
</oanna:with-tooltip>
