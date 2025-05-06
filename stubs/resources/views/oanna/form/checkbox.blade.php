@props([
    "class" => "",
    "label" => null,
])

@php
    $required = $attributes->has('required') && $attributes->get('required');
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (! $attributes->has('id')) {
        $attributes->offsetSet(["id" => $target]);
    }

    if (! $attributes->has('name')) {
        $attributes->offsetSet(["name" => $target]);
    }
@endphp

<div class="form-group form-group--checkbox {{ $attributes->get('container:class') }}">
    <input type="checkbox" {{ $attributes }} class="{{ $class }} @error($target)is-invalid @enderror" />

    @if (! is_null($label))
        <label for="{{ $target }}">
            {{ $label }} @if ($required)<sup>*</sup>@endif
        </label>
    @endif

    <oanna:form.error :name="$target" />
</div>
