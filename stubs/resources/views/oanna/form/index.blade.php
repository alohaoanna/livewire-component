@props([
    'class' => "form",
])

<form {{ $attributes }} class="{{ $class }}">
    @csrf

    {{ $slot }}
</form>
