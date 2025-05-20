@props([
	'name' => null,
])

@php
    $name ??= (\Illuminate\Support\Str::uuid() . '-' . time());
@endphp

<div data-oanna-lightbox-group {{ $attributes }}>
    {{ $slot }}

    <oanna:modal :$name variant="lightbox">
        <button x-on:click="window.Livewire?.first().dispatch('lightbox-dicrement', {'name': @js($name)})" type="button">
            <oanna:icon icon="arrow" />
        </button>

        <div data-oanna-lightbox-group-container>
            {{ $slot }}
        </div>

        <button x-on:click="window.Livewire?.first().dispatch('lightbox-increment', {'name': @js($name)})" type="button">
            <oanna:icon icon="arrow" />
        </button>
    </oanna:modal>
</div>
