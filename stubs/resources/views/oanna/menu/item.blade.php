@php $iconTrailing = $iconTrailing ??= $attributes->get('icon:trailing'); @endphp
@php $iconLeading = $iconLeading ??= $attributes->get('icon:leading'); @endphp
@php $iconClasses = $iconClasses ??= $attributes->get('icon:class'); @endphp
@php $iconSize = $iconSize ??= $attributes->get('icon:size'); @endphp
@php $iconVariant = $iconVariant ??= $attributes->get('icon:variant'); @endphp

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

    $isTypeSubmitAndNotDisabledOnRender = ! $attributes->has('disabled');

    $isJsMethod = str_starts_with($attributes->whereStartsWith('wire:click')->first() ?? '', '$js.');

    $loading ??= $loading ?? ($isTypeSubmitAndNotDisabledOnRender || $attributes->whereStartsWith('wire:click')->isNotEmpty() && ! $isJsMethod);

    if ($loading && ! $isJsMethod && $attributes->whereStartsWith('wire:click')->first()) {
        $attributes = $attributes->merge(['wire:loading.attr' => 'data-oanna-menu-loading']);

        // We need to add `wire:target` here because without it the loading indicator won't be scoped
        // by method params, causing multiple buttons with the same method but different params to
        // trigger each other's loading indicators...
        if (! $attributes->has('wire:target') && $target = $attributes->whereStartsWith('wire:click')->first()) {
            $attributes = $attributes->merge(['wire:target' => $target], escape: false);
        }
    }

    if ($kbd) $suffix = $kbd;
@endphp

<oanna:button-or-link :$attributes data-oanna-menu-item data-variant="{{ $variant }}">
    @if (is_string($iconLeading) && $iconLeading !== '')
        <oanna:icon :icon="$iconLeading" :class="$iconClasses" :variant="$iconVariant" :size="$iconSize" />
    @else
        {{ $iconLeading }}
    @endif

    {{ $slot }}

    <div data-oanna-menu-loader>
        <oanna:icon icon="loading" size="s" />
    </div>

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
        <oanna:icon :icon="$iconTrailing" :variant="$iconVariant" :size="$iconSize" :class="$iconClasses" />
    @elseif ($iconTrailing)
        {{ $iconTrailing }}
    @endif

    {{ $submenu ?? '' }}
</oanna:button-or-link>
