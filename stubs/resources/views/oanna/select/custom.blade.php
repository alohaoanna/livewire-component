@php $selectedSuffix ??= $attributes->get('selected-suffix'); @endphp
@php $maxItemLimit ??= $attributes->get('max-item-limit'); @endphp

@props([
    'label' => null,
    'required' => false,
    'multiple' => false,
    'selectedSuffix' => false,
    'maxItemLimit' => 3,
    'clearable' => false,
])

@php
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (! $attributes->has('id')) {
        $attributes->offsetSet('id', $target);
    }
@endphp

<div class="form-group from-group--select-custom"
     data-select="{{ $target }}"
     data-livewire-id="{{ $this->getId() }}"
     data-select-suffix="{{ $selectedSuffix }}"
     data-select-item-limit="{{ $maxItemLimit }}"
     data-select-placeholder="{{ $attributes->get('placeholder') }}"
     @if($multiple) data-select-multiple @endif>

    <oanna:input.label :for="$attributes->get('id')" :content="$label" />

    <oanna:input.container>

        <div class="select-custom">
            <oanna:dropdown>
                <button class="select-custom__input" wire:ignore wire:cloak>
                    {{ $attributes->get('placeholder') }}
                </button>

                <oanna:menu>
                    {{ $slot }}
                </oanna:menu>
            </oanna:dropdown>
        </div>

        @if ($clearable)
            <x-slot:iconTrailing>
                @if ($clearable)
                    <oanna:icon name="close" data-select-clear />
                @endif
            </x-slot:iconTrailing>
        @endif

    </oanna:input.container>

    <oanna:input.error :name="$target" />

</div>
