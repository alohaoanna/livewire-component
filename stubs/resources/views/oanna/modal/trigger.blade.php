@props([
    'name',
])

@php

@endphp

<div x-on:click="$oanna.modal('{{$name}}').show()" {{ $attributes }}>
    {{ $slot }}
</div>
