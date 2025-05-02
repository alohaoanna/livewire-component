@props([
    "name",
    "size" => null,
    "dismissible" => true,
])

<oanna-modal data-oanna-modal wire:ignore.self>
    <dialog data-modal="{{ $name }}" data-size="{{ $size }}" data-dismissible="{{ $dismissible ? 'true' : 'false' }}" wire:ignore.self>
        {!! $slot !!}

        <div data-modal-close>
            <button type="button" x-on:click="$oanna.modal(@js($name)).close()">
                <oanna:icon icon="xmark" variant="regular" />
            </button>
        </div>
    </dialog>
</oanna-modal>
