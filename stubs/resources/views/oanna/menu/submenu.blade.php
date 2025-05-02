@props([
    'heading' => '',
])

<oanna-submenu data-oanna-menu-submenu>
    <oanna:menu.item>
        {{ $heading }}

        <x-slot:suffix>
            <flux:icon icon="chevron-right" :variant="$iconVariant" :class="$iconClasses->add('rtl:hidden')" />
            <flux:icon icon="chevron-left" :variant="$iconVariant" :class="$iconClasses->add('hidden rtl:inline')" />
        </x-slot:suffix>
    </oanna:menu.item>

    <oanna:menu>
        {{ $slot }}
    </oanna:menu>
</oanna-submenu>
