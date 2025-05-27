@props([
    'target' => null,
    'badge' => null,
    'badgeVariant' => null,
    'badgeColor' => null,
    'required' => null,
    'dirty' => null,
])

<label {{ $attributes }}>
    {{ $slot }} @if ($required)<sup>*</sup>@endif

    @if($dirty)
        <oanna:badge name="modified" color="yellow" wire:dirty wire:target="{{ $target }}" />
    @endif

    @if ($badge)
        <oanna:badge :name="$badge" :variant="$badgeVariant" :color="$badgeColor" />
    @endif
</label>
