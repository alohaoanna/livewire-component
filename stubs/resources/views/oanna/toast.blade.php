@props([])

<div class="toastContainer" popover="manual" data-toast-position="top right" data-toast-variant="default">
    <div class="toastContainer__toast">
        <div class="toastContainer__toast__icon">
            <x-icon name="check" class="success" />
            <x-icon name="info" class="info" />
            <x-icon name="caution" class="warning" />
            <x-icon name="danger" class="error" />
        </div>

        <div class="toastContainer__toast__contentContainer">
            <h5 class="toastContainer__toast__contentContainer__title"></h5>

            <p class="toastContainer__toast__contentContainer__text"></p>
        </div>
    </div>
</div>
