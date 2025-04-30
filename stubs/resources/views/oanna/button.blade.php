@php $iconTrailing = $iconTrailing ??= $attributes->pluck('icon:trailing'); @endphp
@php $iconLeading = $iconLeading ??= $attributes->pluck('icon:leading'); @endphp
@php $iconVariant = $iconVariant ??= $attributes->pluck('icon:variant'); @endphp

@props([
    'iconTrailing' => null,
    'iconLeading' => null,
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

    $target = $attributes->whereStartsWith('wire:click')->first();
@endphp

<oanna:button-or-link>
    <?php if ($loading): ?>
    <div class="absolute inset-0 flex items-center justify-center opacity-0" wire:loading.flex.remove wire:target="{{ $target }}">
        <oanna:icon icon="loading" :variant="$iconVariant" :class="$iconClasses" />
    </div>
    <?php endif; ?>

    <?php if (is_string($iconLeading) && $iconLeading !== ''): ?>
    <oanna:icon :icon="$iconLeading" :variant="$iconVariant" :class="$iconClasses" />
    <?php elseif ($iconLeading): ?>
    {{ $iconLeading }}
    <?php endif; ?>

    <?php if ($loading && ! $slot->isEmpty()): ?>
    {{-- If we have a loading indicator, we need to wrap it in a span so it can be a target of *:opacity-0... --}}
    <span>{{ $slot }}</span>
    <?php else: ?>
    {{ $slot }}
    <?php endif; ?>

    <?php if ($kbd): ?>
    <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $kbd }}</div>
    <?php endif; ?>

    <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
    {{-- Adding the extra margin class inline on the icon component below was causing a double up, so it needs to be added here first... --}}
        <?php $iconClasses->add($square ? '' : '-ms-1'); ?>
    <flux:icon :icon="$iconTrailing" :variant="$iconVariant" :class="$iconClasses" />
    <?php elseif ($iconTrailing): ?>
    {{ $iconTrailing }}
    <?php endif; ?>
</oanna:button-or-link>
