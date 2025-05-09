@props([
    'interactive' => null,
    'position' => 'top',
    'content' => null,
])

<oanna-tooltip data-position="{{ $position }} {{ $align }}" {{ $attributes }} data-oanna-tooltip>
    {{ $slot }}

    @if ($content !== null)
        <oanna:tooltip.content>
            {{ $content }}
        </oanna:tooltip.content>
    @endif
</oanna-tooltip>
