/* -------------------------------------
 * MODAL
 * -----------------------------------*/
document.addEventListener('livewire:initialized', () => {
    window.Livewire?.on('modal-show', function (params) {
        const name = params.name;
        const componentId = params.componentId; // nullable

        const dialog = document.querySelector("dialog[data-modal=" + name + "]");

        if (!dialog) {
            console.warn("No modal found for name [" + name + "]");
        }
        else {
            const component = window.Livewire?.find(componentId);

            showModal(dialog);
        }
    });

    window.Livewire?.on('modal-close', function (params) {
        const name = params.name;
        const componentId = params.componentId; // nullable

        const dialog = document.querySelector("dialog[data-modal=" + name + "]");

        if (!dialog) {
            console.warn("No modal found for name [" + name + "]");
        }
        else {
            const component = window.Livewire?.find(componentId);

            closeModal(dialog);
        }
    });
});

function showModal(element) {
    element.setAttribute('data-open');
}

function closeModal(element) {
    element.removeAttribute('data-open');
}
