@php $containerClass = $containerClass ??= $attributes->get('container:class') @endphp

@props([
    "class" => "",
    "label" => null,
])

@php
    $required = $attributes->has('required') && $attributes->get('required');
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (! $attributes->has('id')) {
        $attributes->offsetSet("id", $target);
    }

    if (! $attributes->has('name')) {
        $attributes->offsetSet("name", $target);
    }
@endphp

<div class="form-group form-group--switch {{ $containerClass }}">
    <input type="checkbox" role="switch" {{ $attributes }} class="{{ $attributes->get('class') }} @error($target)is-invalid @enderror" />

    @if (! is_null($label))
        <label for="{{ $attributes->get('id') }}">
            {{ $label }} @if ($required)<sup>*</sup>@endif
        </label>
    @endif

    <oanna:form.error :name="$target" />
</div>
