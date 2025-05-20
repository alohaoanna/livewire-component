@props([
    "name",
    'variant' => null,
    'position' => null,
    "size" => null,
    "dismissible" => true,
])

<oanna-modal data-oanna-modal wire:ignore.self>
    <dialog data-modal="{{ $name }}" data-size="{{ $size }}"
            @if ($variant) data-variant="{{ $variant }}" @endif
            @if ($position) data-position="{{ $position }}" @endif
            data-dismissible="{{ $dismissible ? 'true' : 'false' }}"
            wire:ignore.self>
        {!! $slot !!}

        <div data-modal-close>
            <button type="button" x-on:click="$oanna.modal(@js($name)).close()">
                <oanna:icon icon="xmark" variant="regular" />
            </button>
        </div>
    </dialog>
</oanna-modal>
