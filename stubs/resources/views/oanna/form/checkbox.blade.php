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

@if ($attributes->has('role') && $attributes->get('role') == 'switch')
    <oanna:form.switch {{ $attributes }} :$label :$class />
@else
    <div class="form-group form-group--checkbox {{ $containerClass }}">
        <input type="checkbox" {{ $attributes }} class="{{ $attributes->get('class') }} @error($target)is-invalid @enderror" />

        @if (! is_null($label))
            <oanna:form.label {{ $attributes }}>{{$label}}</oanna:form.label>
        @endif

        <oanna:form.error :name="$target" />
</div>
@endif
