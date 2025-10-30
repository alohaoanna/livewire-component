@php $keepOpen ??= $attributes->get('keep-open') @endphp

@props([
    'class' => '',
    'loading' => true,
    'selected' => false,
    'keepOpen' => false,
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
            @if($keepOpen) data-keep-open @endif
            @if($loading) wire:loading.attr="data-loading" wire:target="{{ $action }}" @endif
    >
        {{ $slot }}

        @if ($loading)
            <oanna:icon.loader />
        @endif
    </button>
@endif
