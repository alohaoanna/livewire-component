@props([
    'postition' => 'bottom',
    'align' => 'start',
    'disabled' => null,
])

<div wire:context data-oanna-context {{ $attributes }} data-position="{{ $postition . ' ' . $align }}" @if($disabled) data-disabled @endif>
    {{ $slot }}
</div>
