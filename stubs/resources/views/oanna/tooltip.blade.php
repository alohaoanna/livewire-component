@props([
    'interactive' => null,
    'position' => 'top',
    'align' => 'center',
    'content' => null,
    'kbd' => null,
    'toggleable' => null,
])

@php
    // Support adding the .self modifier to the wire:model directive...
    if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
        unset($attributes[$wireModel->directive]);

        $wireModel->directive .= '.self';

        $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
    }
@endphp

@if ($toggleable)
    <oanna-dropdown position="{{ $position }} {{ $align }}" {{ $attributes }} data-flux-tooltip>
        {{ $slot }}

        @if ($content !== null)
            <flux:tooltip.content :$kbd>{{ $content }}</flux:tooltip.content>
        @endif
    </oanna-dropdown>
@else
    <oanna-tooltip position="{{ $position }} {{ $align }}" {{ $attributes }} data-flux-tooltip @if ($interactive) interactive @endif>
        {{ $slot }}

        @if ($content !== null)
            <flux:tooltip.content :$kbd>{{ $content }}</flux:tooltip.content>
        @endif
    </oanna-tooltip>
@endif
