@php $keepOpen ??= $attributes->get('keep-open') @endphp

@props([
    'class' => '',
    'keepOpen' => false,
])

<div class="dropdown__menu {{ $class }}"
     {{ $attributes }}
     @if($keepOpen) data-keep-open @endif
     popover="manual"
     wire:ignore.self wire:cloak>
    {{ $slot }}
</div>
