@props([
    'heading' => null,
])

<div {{ $attributes }} role="group" data-oanna-menu-group>
    <oanna:menu.separator data-oanna-menu-separator-top />

    <?php if ($heading): ?>
        <oanna:menu.heading>
            {{ $heading }}
        </oanna:menu.heading>
    <?php endif; ?>

    {{ $slot }}

    <oanna:menu.separator data-oanna-menu-separator-bottom />
</div>
