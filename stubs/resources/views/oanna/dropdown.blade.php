@props([
    'position' => 'bottom',
    'align' => 'start',
])

<oanna-dropdown data-oanna-dropdown data-position="{{ $position }} {{ $align }}" {{ $attributes }} wire:ignore>
    {{ $slot }}
</oanna-dropdown>
