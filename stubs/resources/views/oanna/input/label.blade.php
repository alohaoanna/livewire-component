@props([
    'content' => null,
])

<label {{ $attributes }}>
    {!! $content ?? $slot !!}
</label>
