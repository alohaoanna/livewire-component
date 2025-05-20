@props([
    'heading' => '',
])

<oanna-submenu wire:submenu data-oanna-menu-submenu>
    <oanna:menu.item>
        {{ $heading }}

        <x-slot:suffix>
            <oanna:icon icon="chevron-right" suffix />
        </x-slot:suffix>
    </oanna:menu.item>

    <oanna:menu>
        {{ $slot }}
    </oanna:menu>
</oanna-submenu>
