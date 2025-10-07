@props([
    'name',
    'dismissable' => true,
])

<dialog data-modal="{{ $name }}" popover="manual" class="modal" data-dismissable="{{ $dismissable ? 'true' : 'false' }}">
    <x-button x-on:click="$oanna.modal('{{ $name }}').close()" class="modal__close" :loading="false">
        X
    </x-button>

    {{ $slot }}
</dialog>
