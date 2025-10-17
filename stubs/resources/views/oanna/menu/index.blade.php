@props([
    'class' => '',
])

<div class="dropdown__menu {{ $class }}" {{ $attributes }} popover="manual" wire:ignore.self wire:cloak>
    {{ $slot }}
</div>
