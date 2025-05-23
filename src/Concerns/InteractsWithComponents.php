<?php

namespace OANNA\Concerns;

use JetBrains\PhpStorm\ExpectedValues;
use Livewire\Component;

trait InteractsWithComponents
{
    public function bootComponents()
    {
        $this->bootModal();
    }

    public function bootModal()
    {
        Component::macro('modal', function ($name) {
            return new class ($name) {
                public function __construct(public $name) {}

                public function show()
                {
                    $component = app('livewire')->current();

                    $component->dispatch('modal-show', name: $this->name, scope: $component->getId());
                }

                public function close()
                {
                    $component = app('livewire')->current();

                    $component->dispatch('modal-close', name: $this->name, scope: $component->getId());
                }
            };
        });
    }

    public static function modal($name)
    {
        return new class ($name) {
            public function __construct(public $name) {}

            public function show()
            {
                app('livewire')->current()->dispatch('modal-show', name: $this->name);
            }

            public function close()
            {
                app('livewire')->current()->dispatch('modal-close', name: $this->name);
            }
        };
    }

    public static function modals()
    {
        return new class {
            public function close()
            {
                app('livewire')->current()->dispatch('modal-close');
            }
        };
    }

    public static function toast(
        $text,
        $heading = null,
        $duration = 5000,
        #[ExpectedValues([null, 'default', 'success', 'info', 'warning', 'error'])] $variant = null,
        #[ExpectedValues([null, 'top left', 'top right', 'bottom left', 'bottom right'])] $position = null
    ) {
        $params = [
            'duration' => $duration,
            'slots' => [],
            'dataset' => [],
        ];

        if ($text) $params['slots']['text'] = $text;
        if ($heading) $params['slots']['heading'] = $heading;
        if ($variant) $params['dataset']['variant'] = $variant;
        if ($position) $params['dataset']['position'] = $position;

        app('livewire')->current()->dispatch('toast-show', ...$params);
    }
}

