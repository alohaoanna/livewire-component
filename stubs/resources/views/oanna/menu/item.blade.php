@props([
    'class' => '',
    'loading' => true,
    'selected' => false,
])

@php
    $action = $attributes->whereStartsWith('wire:click')->first();
@endphp

@if ($attributes->has('href'))
    <a class="dropdown__item {{ $class }}" {{ $attributes }} @if ($selected) data-selected @endif>
        {{ $slot }}
    </a>
@else
    <button class="dropdown__item {{ $class }}"
            {{ $attributes }}
            @if ($selected) data-selected @endif
            @if($loading) wire:loading.attr="data-loading" wire:target="{{ $action }}" @endif
    >
        {{ $slot }}

        @if ($loading)
            <oanna:icon.loader />
        @endif
    </button>
@endif
