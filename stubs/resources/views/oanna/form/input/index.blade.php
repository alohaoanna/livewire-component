@php $iconTrailing = $iconTrailing ??= $attributes->pluck('icon:trailing'); @endphp
@php $iconLeading = $iconLeading ??= $attributes->pluck('icon:leading'); @endphp
@php $iconVariant = $iconVariant ??= $attributes->pluck('icon:variant'); @endphp
@php $iconSize = $iconSize ??= $attributes->pluck('icon:size'); @endphp
@php $containerClass = $containerClass ??= $attributes->get('container:class') @endphp

@props([
    "type" => "text",
    'iconTrailing' => null,
    'iconLeading' => null,
    'iconVariant' => null,
    'iconSize' => null,
    "class" => "",
    "label" => null,
    'icon' => null,
    'showable' => null,
    'dirty' => null,
    'prefix' => null,
    'suffix' => null,
])

@php
    $iconLeading = $icon ??= $iconLeading;

    $required = $attributes->has('required') && $attributes->get('required');
    $target = $attributes->whereStartsWith('wire:model')->first();

    if (! $attributes->has('id')) {
        $attributes->offsetSet("id", $target);
    }

    if (! $attributes->has('name')) {
        $attributes->offsetSet("name", $target);
    }
@endphp

<div class="form-group {{ $containerClass }}" @if($showable) x-data="{ type: @js($type) }" @endif>
    @if (! is_null($label))
        <oanna:form.label {{ $attributes }}>{{$label}}</oanna:form.label>
    @endif

    <div data-input-container>
        @if($prefix)
            <oanna-prefix data-oanna-input-prefix>
                {{ $prefix }}
            </oanna-prefix>
        @endif

        <div data-input-container>
            @if (is_string($iconLeading) && $iconLeading !== '')
                <oanna:icon :icon="$iconLeading" :variant="$iconVariant" :size="$iconSize" data-oanna-icon-leading />
            @else
                {{ $iconLeading }}
            @endif

            <input @if($showable)x-bind:type="type" @else type="{{ $type }}" @endif {{ $attributes }} class="{{ $attributes->get('class') }} @error($target)is-invalid @enderror" />

            @if ($showable)
                <oanna:icon icon="eye" size="xs" x-on:click="type == 'password' ? type = 'text' : type = 'password'" data-oanna-icon-trailing />
            @elseif (is_string($iconTrailing) && $iconTrailing !== '')
                <oanna:icon :icon="$iconTrailing" :variant="$iconVariant" :size="$iconSize" data-oanna-icon-trailing />
            @elseif ($iconTrailing)
                {{ $iconTrailing }}
            @endif
        </div>

        @if($suffix)
            <oanna-suffix data-oanna-input-suffix>
                {{ $suffix }}
            </oanna-suffix>
        @endif
    </div>

    <oanna:form.error :name="$target" />
</div>
