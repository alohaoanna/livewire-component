<?php

namespace OANNA;

use OANNA\Concerns\InteractsWithComponents;
use Illuminate\Support\Str;
use function Livewire\on;

class OANNA
{
    use InteractsWithComponents;

    public $hasRenderedAssets = false;

    public function boot()
    {
        on('flush-state', function () {
            $this->hasRenderedAssets = false;
        });

        $this->bootComponents();
    }

    public function markAssetsRendered()
    {
        $this->hasRenderedAssets = true;
    }

    public function scripts($options = [])
    {
        $this->markAssetsRendered();

        return AssetManager::scripts($options);
    }

    public function classes($styles = null)
    {
        $builder = new ClassBuilder;

        return $styles ? $builder->add($styles) : $builder;
    }

    /**
     * @throws \Throwable
     */
    public function disallowWireModel($attributes, $componentName)
    {
        throw_if($attributes->whereStartsWith('wire:')->isNotEmpty(), "Cannot use wire:model on <{$componentName}>");
    }

    public function componentExists($name)
    {
        // Laravel 12+ uses xxh128 hashing for views https://github.com/laravel/framework/pull/52301...
        if (app()->version() >= 12) {
            return app('view')->exists(hash('xxh128', 'oanna') . '::' . $name);
        }

        return app('view')->exists(md5('oanna') . '::' . $name);
    }
}
