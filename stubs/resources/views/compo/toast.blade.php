<div data-compo-toastr wire:ignore>
    <div id="toastr">
        <div id="toastr-container">
            <div id="toastr-container-content">
                <div>
                    <h5 id="toastr-container-content-heading"></h5>
                    <p id="toastr-container-content-text"></p>
                </div>
            </div>

            <div id="toastr-container-close">
                <button type="button" x-on:click="$wire.dispatch('toast-dismiss')">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.--><path d="M324.5 411.1c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L214.6 256 347.1 123.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 233.4 59.6 100.9c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L169.4 256 36.9 388.5c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L192 278.6 324.5 411.1z"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

@script
<script>
    var timeout;

    Livewire.on('toast-show', function (params) {
        const toastr = document.querySelector("div[data-compo-toastr]");
        const heading = toastr.querySelector("h5#toastr-container-content-heading");
        const text = toastr.querySelector("p#toastr-container-content-text");

        const duration = params.duration;
        const textContent = params.slots['text'];
        const headingContent = params.slots['heading'];
        const variant = params.dataset['variant'];
        const position = params.dataset['position'];

        toastr.setAttribute('data-position', position);
        toastr.setAttribute('data-variant', variant);

        heading.innerHTML = headingContent;
        text.innerHTML = textContent;

        // PERMANENT
        if (duration == 0) {
            showToastr(toastr);
        }
        else {
            showToastr(toastr);

            timeout = window.setTimeout(function () {
                dismissToastr(toastr);
            }, duration);
        }
    });


    Livewire.on('toast-dismiss', function () {
        const toastr = document.querySelector("div[data-compo-toastr]");
        dismissToastr(toastr);
    });

    function showToastr(element) {
        element.setAttribute('data-show', true);
    }

    function dismissToastr(element) {
        window.clearTimeout(timeout);
        element.removeAttribute('data-show');
    }
</script>
@endscript
