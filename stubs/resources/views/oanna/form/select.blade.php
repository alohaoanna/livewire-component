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

<div class="form-group form-group--select {{ $attributes->get('container:class') }}">
    @if (! is_null($label))
        <label for="{{ $target }}">
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

    <oanna:form.error :name="$target" />
</div>
