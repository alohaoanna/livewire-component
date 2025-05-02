@props([
    "type" => "text",
    "class" => "",
    "label" => null,
])

@php
    $required = $attributes->has('required') && $attributes->get('required');
    $target = $attributes->whereStartsWith('wire:click')->first();
@endphp

<div class="form-group {{ $attributes->get('class:container') }}">
    @if (! is_null($label))
        <label for="{{ $target }}">
            {{ $label }} @if ($required)<sup>*</sup>@endif
        </label>
    @endif

    <input type="{{ $type }}" {{ $attributes }} class="{{ $class }} @error($target)is-invalid @enderror" />

    @error($target)
    <p>{{ $message }}</p>
    @enderror
</div>
