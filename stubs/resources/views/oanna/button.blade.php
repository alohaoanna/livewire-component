@props([
    'type' => 'button',
    'loading' => null,
    'size' => 'base',
    'variant' => 'default',
    'kbd' => null,
])

@php
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

    $attributes->set('class', $attributes->get('class') . " button button--{$variant}");

    $target = $attributes->whereStartsWith('wire:click')->first();
@endphp

<oanna:button-or-link :$attributes :$type>
    @if ($loading)
        <div class="absolute inset-0 flex items-center justify-center opacity-0" wire:loading.flex.remove wire:target="{{ $target }}">
            <oanna:icon icon="loading" />
        </div>
    @endif

    @if ($loading && ! $slot->isEmpty())
        <span>{{ $slot }}</span>
    @else
        {{ $slot }}
    @endif

    @if ($kbd)
        <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $kbd }}</div>
    @endif
</oanna:button-or-link>
