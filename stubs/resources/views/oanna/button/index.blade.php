@props([
    'type' => "button",
    'loading' => true,
    'class' => "button",
])

@php
    $action = $attributes->whereStartsWith('wire:click')->first();
@endphp

@if ($attributes->has('href'))
    <a
        {{ $attributes }}
        class="{{ $class }}"
    >
        {{ $slot }}

        @if ($loading)
            <oanna:icon.loader />
        @endif
    </a>
@else
    <button
        {{ $attributes }}
        type="{{ $type }}"
        class="{{ $class }}"
        @if($loading) wire:loading.attr="data-loading" wire:target="{{ $action }}" @endif
    >
        {{ $slot }}

        @if ($loading)
            <oanna:icon.loader />
        @endif
    </button>
@endif
