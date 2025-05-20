@php $containerClass = $containerClass ??= $attributes->get('container:class') @endphp
@php $badgeVariant = $badgeVariant ??= $attributes->get('badge:variant') @endphp

@props([
    "type" => "text",
    "class" => "",
    "label" => null,
    "badge" => null,
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

<div class="form-group form-group--textarea {{ $containerClass }}">
    @if (! is_null($label))
        <label for="{{ $attributes->get('id') }}">
            {{ $label }} @if ($required)<sup>*</sup>@endif
            @if ($badge)
                <oanna:badge :name="$badge" :variant="$badgeVariant" />
            @endif
        </label>
    @endif

    <textarea {{ $attributes }} class="{{ $attributes->get('class') }} @error($target)is-invalid @enderror">

    </textarea>

    <oanna:form.error :name="$target" />
</div>
