@php $iconTrailing ??= $attributes->get('icon:trailing') @endphp

@props([
    'type' => "text",
    'label' => null,
    'required' => false,
    'prefix' => null,
    'suffix' => null,
    'badge' => null,
    'icon' => null,
    'iconTrailing' => null,
    'showable' => true,
])

@php
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (! $attributes->has('id')) {
        $attributes->offsetSet('id', $target);
    }

    if ($type == 'password' && $showable) {
        $iconTrailing = 'eye';
    }
@endphp

<div class="form-group">

    <x-input.label :for="$attributes->get('id')" :content="$label" />

    <x-input.container
        x-data="{ show: false }"
        :prefix="$prefix"
        :suffix="$suffix"
    >

        @if (! empty($icon))
            <x-slot:icon>
                <x-icon :name="$icon" />
            </x-slot:icon>
        @endif

        @if ($type == 'password' && $showable)
            <input x-bind:type="show ? 'text' : 'password'" {{ $attributes }} />
        @else
            <input type="{{ $type }}" {{ $attributes }} />
        @endif

        @if (! empty($iconTrailing))
            @if ($type == 'password' && $showable)
                <x-slot:iconTrailing>
                    <x-icon :name="$iconTrailing" x-on:click="show = !show" />
                </x-slot:iconTrailing>
            @else
                <x-slot:iconTrailing>
                    <x-icon :name="$iconTrailing" />
                </x-slot:iconTrailing>
            @endif
        @endif

    </x-input.container>

    <x-input.error :name="$target" />

</div>

