@props([
    'label' => null,
    'required' => false,
    'badge' => null,
])

@php
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (! $attributes->has('id')) {
        $attributes->offsetSet('id', $target);
    }
@endphp

<div class="form-group form-group--switch">

    <oanna:input.container>
        <input type="checkbox" role="switch" {{ $attributes }} @if($required) required @endif />

        <oanna:input.label :for="$attributes->get('id')" :content="$label" />
    </oanna:input.container>

    <oanna:input.error :name="$target" />

</div>

