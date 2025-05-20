@props([
    "name",
])

<button data-oanna-modal-trigger x-on:click="$oanna.modal('{{$name}}').show()" {{ $attributes }}>
    {!! $slot !!}
</button>
