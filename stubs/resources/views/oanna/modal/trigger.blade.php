@props([
    "name",
])

<button data-oanna-modal-trigger x-on:click="$oanna.modal(@js($name)).show()" {{ $attributes }}>
    {!! $slot !!}
</button>
