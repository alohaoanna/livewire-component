@props([
    'name',
])

@php

@endphp

<div x-on:click="$oanna.modal('{{$name}}').close()" {{ $attributes }}>
    {{ $slot }}
</div>
