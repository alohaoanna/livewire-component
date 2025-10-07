@props([
    'name',
])

@error($name)
    <p class="text-danger invalid-feedback">
        {{ $message }}
    </p>
@enderror
