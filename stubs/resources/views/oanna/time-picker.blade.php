@php $iconTrailing ??= $attributes->get('icon:trailing') @endphp

@props([
    'label' => null,
    'required' => false,
    'prefix' => null,
    'suffix' => null,
    'badge' => null,
    'icon' => null,
    'iconTrailing' => null,
    'showable' => true,
    'clearable' => false,
    'step' => 30,
    'min' => null,
    'max' => null,
    'unavailable' => null,
])

@php
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (! $attributes->has('id')) {
        $attributes->offsetSet('id', $target);
    }

    if (! empty($min)) {
        list($hours, $minutes) = explode(":", $min);
        $min = ((int)$hours * 60) + (int)$minutes;
    }

    if (! empty($max)) {
        list($hours, $minutes) = explode(":", $max);
        $max = ((int)$hours * 60) + (int)$minutes;
    }
@endphp

<div class="form-group form-group--timepicker">

    <oanna:input.label :for="$attributes->get('id')" :content="$label"/>

    <oanna:input.container
        x-data="{ show: false }"
        :prefix="$prefix"
        :suffix="$suffix"
    >

        @if (! empty($icon))
            <x-slot:icon>
                <oanna:icon :name="$icon"/>
            </x-slot:icon>
        @endif

        <oanna:dropdown>
            <input type="text" {{ $attributes }} @if($required) required @endif />

            <oanna:menu>
                @for($i = 0; $i < 1440; $i += intval($step))
                    @php
                        $hours = floor($i / 60);
                        $remainingMinutes = $i % 60;

                        $value = sprintf("%02d:%02d", $hours, $remainingMinutes);
                    @endphp

                    @if ((!empty($min) && $i < $min) || (!empty($max) && $i > $max))
                        @continue
                    @elseif(str_contains($unavailable, $value))
                        <oanna:menu.item data-disabled>
                            {{ $value }}
                        </oanna:menu.item>
                    @else
                        <oanna:menu.item x-on:click="$wire.set('{{ $target }}', '{{ $value }}');">
                            {{ $value }}
                        </oanna:menu.item>
                    @endif
                @endfor
            </oanna:menu>
        </oanna:dropdown>

        @if (! empty($iconTrailing) || $clearable)
            <x-slot:iconTrailing>
                @if ($clearable)
                    <oanna:icon name="close" x-on:click="$wire.set('{{ $target }}', null)" />
                @else
                    <oanna:icon :name="$iconTrailing"/>
                @endif
            </x-slot:iconTrailing>
        @endif

    </oanna:input.container>

    <oanna:input.error :name="$target"/>

</div>

