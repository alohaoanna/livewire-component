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
    <?php if (! is_null($label)); ?>
    <label for="">
        {{ $label }} <?php if ($required); ?><sup>*</sup><?php endif; ?>
    </label>
    <?php endif; ?>

    <input type="{{ $type }}" {{ $attributes }} class="{{ $class }} @error($target)is-invalid @enderror" />

    @error($target)
        <p>{{ $message }}</p>
    @enderror
</div>
