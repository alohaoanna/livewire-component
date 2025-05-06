@props(["name"])

@error($name)
<p data-oanna-error>
    {{ $message }}
</p>
@enderror
