@props([])

<oanna-toast data-oanna-toastr popover="manual" data-position="bottom right" data-duration="3000">
    <div class="container">
        <div class="content">
            <div class="icons">
                <oanna:icon icon="check" class="icon success" variant="solid" />
                <oanna:icon icon="circle-info" class="icon info" variant="solid" />
                <oanna:icon icon="triangle-exclamation" class="icon warning" variant="solid" />
                <oanna:icon icon="xmark" class="icon error" variant="solid" />
            </div>
            <div class="slots">
                <h5 class="title"></h5>
                <p class="text"></p>
            </div>
        </div>
        <div class="actions">
            <button data-toastr-close class="close">
                <oanna:icon icon="xmark" variant="regular" />
            </button>
        </div>
    </div>
</oanna-toast>
