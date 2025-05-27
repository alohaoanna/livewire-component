<div data-input-container>
    <button data-placeholder="{{ $attributes->get('placeholder') }}" data-selected-suffix="{{ $attributes->get('selected:suffix') ?? "selected" }}" type="button" data-oanna-select-button wire:ignore>
        {{ $attributes->get('placeholder') }}
    </button>

    <oanna:icon icon="angle-down" variant="regular" data-oanna-icon-trailing />
</div>
