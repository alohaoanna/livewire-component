@php $containerClass = $containerClass ??= $attributes->get('container:class') @endphp

@props([
    "class" => "",
    "label" => null,
    'dirty' => null,
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

<div class="form-group form-group--file {{ $containerClass }}">
    @if (! is_null($label))
        <oanna:form.label {{ $attributes }}>{{$label}}</oanna:form.label>
    @endif

    <input type="file" {{ $attributes }} class="{{ $attributes->get('class') }} @error($target)is-invalid @enderror" />

    <oanna:form.error :name="$target" />
</div>
