@props([
    "name",
    "size" => null,
])

<div data-oanna-modal wire:ignore.self>
    <template x-teleport="body">
        <dialog data-modal="{{ $name }}" data-size="{{ $size }}" wire:ignore.self x-on:click.outside="$wire.dispatch('modal-close', {'name': @js($name)})">
            {!! $slot !!}

            <div data-modal-close>
                <button type="button" x-on:click="$wire.dispatch('modal-close', {'name': @js($name)})">
                    <oanna:icon icon="xmark" variant="regular" />
                </button>
            </div>
        </dialog>
    </template>
</div>
