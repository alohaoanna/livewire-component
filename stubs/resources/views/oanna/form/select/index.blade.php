@php $containerClass = $containerClass ??= $attributes->get('container:class') @endphp
@php $searchPlaceholder = $searchPlaceholder ??= $attributes->get('search:placeholder') @endphp

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
@endphp

<div class="form-group form-group--select {{ $containerClass }}"
     @if ($variant == "listbox" || $searchable || $multiple) wire:select="{{ $target }}" @endif
     @if($searchable) data-oanna-select-searchable @endif
     @if($multiple) data-oanna-select-multiple @endif>
    @if (! is_null($label))
        <oanna:form.label {{ $attributes }}>{{$label}}</oanna:form.label>
    @endif

    @if ($variant == "listbox" || $searchable || $multiple)
        <oanna-select class="container">
            @if (isset($button))
                {{ $button }}
            @else
                <oanna:form.select.button :$attributes :placeholder="$placeholder" />
            @endif
        </oanna-select>

        <oanna-options data-oanna-select-options popover="manual" wire:ignore.self>
            @if ($searchable)
                @if (isset($search))
                    {{ $search }}
                @else
                    <oanna:form.select.search>
                        <oanna:icon icon="magnifying-glass" variant="regular" size="s" />

                        {{ $searchPlaceholder ?? 'Search...' }}
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
