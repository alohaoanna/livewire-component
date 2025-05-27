@props([])

<oanna-search data-oanna-select-search data-input-container x-data="{ search: '' }">
    <oanna:icon icon="magnifying-glass" variant="regular" size="s" data-oanna-icon-leading />
    <input type="search" {{ $attributes }} data-oanna-select-search-input x-model="search" />
</oanna-search>
