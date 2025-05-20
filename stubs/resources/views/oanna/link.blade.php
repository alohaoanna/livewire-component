@php
    $attributes->class('button button--link');
@endphp

<a {{ $attributes }}>
    {{ $slot }}
</a>
