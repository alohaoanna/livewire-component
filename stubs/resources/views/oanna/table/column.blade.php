@props([
    'sortable' => null,
])

<th data-oanna-table-column data-sortable="{{ $sortable }}" {{ $attributes }} wire:ignore.self>
    <div>
        {{ $slot }}

        @if ($sortable)
            <oanna:icon icon="angles-up-down" variant="regular" class="sortable-arrow default" />
            <oanna:icon icon="angle-up" variant="regular" class="sortable-arrow asc" />
            <oanna:icon icon="angle-down" variant="regular" class="sortable-arrow desc" />
        @endif
    </div>
</th>
