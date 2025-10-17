@props([
    'position' => 'bottom',
    'align' => 'left',
    'class' => '',
])

<div class="dropdown {{ $class }}" {{ $attributes }}
     data-dropdown-position="{{ $position }}" data-dropdown-align="{{ $align }}">
    {{ $slot }}
</div>
