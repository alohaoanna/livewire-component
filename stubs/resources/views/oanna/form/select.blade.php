@props([
    "class" => "",
    "label" => null,
])

@php
    $required = $attributes->has('required') && $attributes->get('required');
    $target = $attributes->whereStartsWith('wire:click')->first();

    if (! $attributes->has('id')) {
        $attributes->merge(["id" => $target]);
    }

    if (! $attributes->has('name')) {
        $attributes->merge(["name" => $target]);
    }
@endphp

<div class="form-group form-group--select {{ $attributes->get('class:container') }}">
    @if (! is_null($label))
        <label for="{{ $id }}">
            {{ $label }} @if ($required)<sup>*</sup>@endif
        </label>
    @endif

    <div class="container">
        <select {{ $attributes }} class="{{ $class }} @error($target)is-invalid @enderror">
            {!! $slot !!}
        </select>

        <div class="icon">
            <oanna:icon icon="angles-up-down" variant="regular" />
        </div>
    </div>

    @error($target)
        <p>{{ $message }}</p>
    @enderror
</div>
