@props([
    'content',
    'position' => 'top',
    'class' => null,
    'clickable' => false,
])

<div class="tooltipContainer {{ $class }}" data-tooltip-position="{{ $position }}" @if($clickable) data-tooltip-clickable @endif>
    {{ $slot }}

    <div class="tooltipContainer__tooltip" popover="manual" wire:ignore wire:cloak>
        {!! $content !!}
    </div>
</div>
