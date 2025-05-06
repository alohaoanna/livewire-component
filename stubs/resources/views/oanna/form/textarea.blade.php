@props([
    "type" => "text",
    "class" => "",
    "label" => null,
])

@php
    $required = $attributes->has('required') && $attributes->get('required');
    $target = $attributes->whereStartsWith('wire:click')->first();
@endphp

<div class="form-group {{ $attributes->get('container:class') }}">
    @if (! is_null($label))
        <label for="{{ $target }}">
            {{ $label }} @if ($required)<sup>*</sup>@endif
        </label>
    @endif

    <textarea {{ $attributes }} class="{{ $class }} @error($target)is-invalid @enderror">

    </textarea>

    <oanna:form.error :name="$target" />
</div>
