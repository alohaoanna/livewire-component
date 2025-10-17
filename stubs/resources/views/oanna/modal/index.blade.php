@props([
    'name',
    'dismissable' => true,
])

<dialog data-modal="{{ $name }}" popover="manual" class="modal" data-dismissable="{{ $dismissable ? 'true' : 'false' }}" wire:ignore.self wire:cloak>
    <oanna:button x-on:click="$oanna.modal('{{ $name }}').close()" class="modal__close" :loading="false">
        <oanna:icon name="close" />
    </oanna:button>

    {{ $slot }}
</dialog>
