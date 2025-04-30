@props([
    "name",
    "size" => null,
])

<div data-oanna-modal wire:ignore.self>
    <template x-teleport="body">
        <dialog data-modal="{{ $name }}" data-size="{{ $size }}" wire:ignore.self x-on:click.outside="$wire.dispatch('modal-close', @js($name))">
            {!! $slot !!}

            <div data-modal-close>
                 <button type="button" x-on:click="$wire.dispatch('modal-close', @js($name))">
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.--><path d="M324.5 411.1c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L214.6 256 347.1 123.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 233.4 59.6 100.9c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L169.4 256 36.9 388.5c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L192 278.6 324.5 411.1z"/></svg>
                </button>
            </div>
        </dialog>
    </template>
</div>
