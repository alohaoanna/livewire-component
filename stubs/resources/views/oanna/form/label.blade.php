@php $badgeVariant = $badgeVariant ??= $attributes->get('badge:variant') @endphp
@php $badgeColor = $badgeColor ??= $attributes->get('badge:color') @endphp

@props([
    'id' => null,
    'badge' => null,
    'badgeVariant' => null,
    'badgeColor' => null,
    'required' => null,
    'dirty' => null,
])

<label for="{{ $id }}">
    {{ $slot }} @if ($required)<sup>*</sup>@endif

    @if($dirty)
        <oanna:badge name="modified" color="yellow" wire:dirty wire:target="{{ $target }}" />
    @endif

    @if ($badge)
        <oanna:badge :name="$badge" :variant="$badgeVariant" :color="$badgeColor" />
    @endif
</label>
