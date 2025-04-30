@props([
    "name",
])

<button data-compo-modal-trigger x-on:click="$wire.dispatch('modal-show', @js($name))">
    {!! $slot !!}
</button>
