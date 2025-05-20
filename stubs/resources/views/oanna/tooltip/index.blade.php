@props([
	'content',
])

@php
    $name ??= (\Illuminate\Support\Str::uuid() . '-' . time());
@endphp

<oanna-tooltip wire:tooltip>
    {{ $slot }}

    <oanna:tooltip.content>
        {{ $content }}
    </oanna:tooltip.content>
</oanna-tooltip>
