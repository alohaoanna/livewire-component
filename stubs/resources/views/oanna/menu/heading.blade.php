<div {{ $attributes }} data-flux-menu-heading>
    <div class="w-7 hidden [[data-flux-menu]:has(>[data-flux-menu-item-has-icon])_&]:block"></div>

    <div>{{ $slot }}</div>
</div>
