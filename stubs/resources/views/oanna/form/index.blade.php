@php
    $attributes->class('form');
@endphp

<form {{ $attributes }}>
    @csrf

    {{ $slot }}
</form>
