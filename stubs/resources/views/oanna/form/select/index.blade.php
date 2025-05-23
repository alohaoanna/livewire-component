@php $containerClass = $containerClass ??= $attributes->get('container:class') @endphp

@props([
    "class" => "",
    "variant" => null,
    "label" => null,
    "placeholder" => null,
    "searchable" => null,
    "multiple" => null,
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

    $id = $this->getId();
@endphp

<div class="form-group form-group--select {{ $containerClass }}"
     data-livewire-id="{{ $id }}"
     @if ($variant == "listbox" || $searchable || $multiple) wire:select @endif
     @if($variant == "listbox") data-oanna-select data-target="{{ $target }}" @endif
     @if($searchable) data-oanna-select-searchable @endif
     @if($multiple) data-oanna-select-multiple @endif>
    @if (! is_null($label))
        <label for="{{ $attributes->get('id') }}">
            {{ $label }} @if ($required)<sup>*</sup>@endif
        </label>
    @endif

    @if ($variant == "listbox" || $searchable || $multiple)
        <oanna-select class="container">
            @if (isset($button))
                {{ $button }}
            @else
                <oanna:form.select.button :$attributes :placeholder="$placeholder" />
            @endif
        </oanna-select>

        <oanna-options data-oanna-select-options popover="manual" wire:ignore>
            @if ($searchable)
                @if (isset($search))
                    {{ $search }}
                @else
                    <oanna:form.select.search>
                        <oanna:icon icon="magnifying-glass" variant="regular" size="s" />

                        Search...
                    </oanna:form.select.search>
                @endif

                <oanna:separator />
            @endif

            {{ $slot }}
        </oanna-options>
    @else
        <oanna-select class="container">
            <select {{ $attributes }} class="{{ $attributes->get('class') }} @error($target)is-invalid @enderror">
                @if ($placeholder)
                    <oanna:form.option :value="null">
                        {{ $placeholder }}
                    </oanna:form.option>
                @endif

                {!! $slot !!}
            </select>

            <div class="icon">
                <oanna:icon icon="angles-up-down" variant="regular" />
            </div>
        </oanna-select>
    @endif

    <oanna:form.error :name="$target" />
</div>
