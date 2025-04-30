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

<div class="form-group form-group--checkbox {{ $attributes->get('class:container') }}">
    <input type="checkbox" {{ $attributes }} class="{{ $class }} @error($target)is-invalid @enderror" />

    <?php if (! is_null($label)); ?>
        <label for="{{ $id }}">
            {{ $label }} <?php if ($required); ?><sup>*</sup><?php endif; ?>
        </label>
    <?php endif; ?>

    @error($target)
        <p>{{ $message }}</p>
    @enderror
</div>
