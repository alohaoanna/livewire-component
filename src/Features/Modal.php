<?php

namespace OANNA\Features;

class Modal
{
    private string $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function show()
    {
        app('livewire')->current()->dispatch('modal-show', name: $this->name);
    }

    public function close()
    {
        app('livewire')->current()->dispatch('modal-close', name: $this->name);
    }
}
