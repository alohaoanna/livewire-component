@php $containerClasses ??= $attributes->get('container:class'); @endphp

@props([
	'src',
	'type',
	'alt' => null,
	'name' => null,
])

@php
    $name ??= (\Illuminate\Support\Str::uuid() . '-' . time());
@endphp

<div class="{{ $containerClasses }}" data-oanna-lightbox wire:ignore>
    <button x-on:click="$oanna.modal('{{ $name }}').show()" {{ $attributes }} data-oanna-lightbox-container>
        {{ $slot }}
    </button>

    <oanna:modal :$name variant="lightbox">
        @if ($type == \App\Enums\AttachmentType::IMAGE)
            <img src="{{ $src }}" alt="Image {{ $src }}" />
        @else
            <video alt="{{ $alt }}" controls>
                <source src="{{ $src }}" />
            </video>
        @endif
    </oanna:modal>
</div>
