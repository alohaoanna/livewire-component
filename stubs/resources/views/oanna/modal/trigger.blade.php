@props([
    "name",
])

<button data-oanna-modal-trigger x-on:click="$wire.dispatch('modal-show', {'name': '@js($name)'})" {{ $attributes }}>
    {!! $slot !!}
</button>
