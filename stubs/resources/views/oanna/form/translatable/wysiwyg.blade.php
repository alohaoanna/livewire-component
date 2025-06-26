@props([
    "activeLang",
    "items",
])

<div class="translatable translatable--one {{ $attributes->get('container:class') }}">

    @foreach($items as $key => $item)
        @if ($key == $activeLang)
            @php
                $wireKey = array_keys($attributes->whereStartsWith('wire:model')->jsonSerialize())[0];
                $wireModel = $attributes->whereStartsWith('wire:model')->first();
                $wireModel = str_replace("$", $key, $wireModel);
                $attributes->offsetSet($wireKey, $wireModel);
            @endphp

            <oanna:form.wysiwyg {{ $attributes }} />
        @endif
    @endforeach

</div>
