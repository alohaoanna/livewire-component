@php $containerClass = $containerClass ??= $attributes->get('container:class') @endphp

@props([
    "class" => "",
    "label" => null,
    "value" => null,
    "range" => null
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

    $value = $value ??= $this->{$target};
@endphp

<div class="form-group {{ $containerClass }}" wire:date-picker>
    @if (! is_null($label))
        <oanna:form.label {{ $attributes }}>{{$label}}</oanna:form.label>
    @endif

    <div data-input-container>
        <input type="date" {{ $attributes }} class="{{ $attributes->get('class') }} @error($target)is-invalid @enderror" />

        <oanna:icon icon="calendar" variant="regular" data-oanna-icon-trailing />
    </div>

    <div data-oanna-date-picker-calendar popover="manual" wire:ignore.self>
        <oanna:calendar :$value {{ $attributes }} />

        @if ($range)
            <oanna:calendar :$value {{ $attributes }} />
        @endif
    </div>

    <oanna:form.error :name="$target" />
</div>
