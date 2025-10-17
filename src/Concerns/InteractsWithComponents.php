<?php

namespace OANNA\Concerns;

use JetBrains\PhpStorm\ExpectedValues;
use Livewire\Component;
use OANNA\Features\Modal;

trait InteractsWithComponents
{
    public function bootComponents()
    {
        $this->bootModal();
    }

    public function bootModal()
    {
        Component::macro('modal', function ($name) {
            return new Modal($name);
        });
    }

    public static function modal($name): Modal
    {
        return new Modal($name);
    }

    public static function toast(
        $text,
        $heading = null,
        $duration = 5000,
        #[ExpectedValues([null, 'default', 'success', 'info', 'warning', 'error'])] $variant = null,
        #[ExpectedValues([null, 'top', 'top left', 'top right', 'bottom', 'bottom left', 'bottom right'])] $position = null
    ) {
        $duration ??= config('oanna.toast.duration');
        $position ??= config('oanna.toast.position');

        $params = [
            'duration' => $duration,
            'slots' => [],
            'dataset' => [],
        ];

        if ($text) $params['slots']['text'] = $text;
        if ($heading) $params['slots']['heading'] = $heading;
        if ($variant) $params['dataset']['variant'] = $variant;
        if ($position) $params['dataset']['position'] = $position;

        app('livewire')->current()->dispatch('toast.show', ...$params);
    }
}

