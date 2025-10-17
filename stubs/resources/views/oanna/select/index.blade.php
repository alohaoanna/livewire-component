@php $iconTrailing ??= $attributes->get('icon:trailing') @endphp

@props([
    'label' => null,
    'required' => false,
    'prefix' => null,
    'suffix' => null,
    'badge' => null,
    'icon' => null,
    'iconTrailing' => null,
])

@php
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (! $attributes->has('id')) {
        $attributes->offsetSet('id', $target);
    }
@endphp

<div class="form-group form-group--select">

    <oanna:input.label :for="$attributes->get('id')" :content="$label" />

    <oanna:input.container
        :prefix="$prefix"
        :suffix="$suffix"
    >

        @if (! empty($icon))
            <x-slot:icon>
                <oanna:icon :name="$icon" />
            </x-slot:icon>
        @endif

        <select {{ $attributes }}>
            {{ $slot }}
        </select>

        @if (! empty($iconTrailing))
            @if ($type == 'password' && $showable)
                <x-slot:iconTrailing>
                    <oanna:icon :name="$iconTrailing" x-on:click="show = !show" />
                </x-slot:iconTrailing>
            @else
                <x-slot:iconTrailing>
                    <oanna:icon :name="$iconTrailing" />
                </x-slot:iconTrailing>
            @endif
        @endif

    </oanna:input.container>

    <oanna:input.error :name="$target" />

</div>

