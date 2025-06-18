@props([
	'content',
	'position' => 'top',
])

@php
    $name ??= (\Illuminate\Support\Str::uuid() . '-' . time());
@endphp

<oanna-tooltip wire:tooltip data-position="{{ $position }}" data-oanna-tooltip wire:ignore.self>
    {{ $slot }}

    <oanna:tooltip.content>
        {{ $content }}
    </oanna:tooltip.content>
</oanna-tooltip>
