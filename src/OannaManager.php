<?php

namespace OANNA;

use OANNA\Concerns\InteractsWithComponents;
use Illuminate\Support\Str;
use function Livewire\on;

class OannaManager
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

    public function appearance($options = [])
    {
        $this->markAssetsRendered();

        return AssetManager::appearance($options);
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

    public function splitAttributes($attributes, $by = ['class', 'style'], $strict = false)
    {
        return [
            $strict ? $attributes->only($by) : $attributes->whereStartsWith($by),
            $strict ? $attributes->except($by) : $attributes->whereDoesntStartWith($by),
        ];
    }

    // @deprecated - use extract(Flux::forwardedAttributes()) instead...
    public function restorePassThroughProps($attributes, $passThroughProps)
    {
        foreach ($passThroughProps as $passThroughProp) {
            $attributes = $attributes->except($passThroughProp)->merge([
                Str::camel($passThroughProp) => $attributes->get($passThroughProp),
            ]);
        }

        return $attributes;
    }

    public function forwardedAttributes($attributes, $propKeys)
    {
        $props = [];

        $unescape = fn ($value) => is_string($value) ? htmlspecialchars_decode($value, ENT_QUOTES) : $value;

        foreach ($propKeys as $key) {
            // Because Blade automatically escapes all "attributes" (not "props"), it errantly escaped these values.
            // Therefore, we have to apply an "unescape" operation (htmlspecialchars_decode) to rectify that...
            if (isset($attributes[$key])) {
                $props[$key] = $unescape($attributes[$key]);
            }
            // If a kebab-cased prop is present, we need to convert it to camelCase so that @props() picks it up...
            elseif (isset($attributes[Str::kebab($key)])) {
                $props[$key] = $unescape($attributes[Str::kebab($key)]);
            }
        }

        return $props;
    }

    public function attributesAfter($prefix, $attributes, $default = [])
    {
        $newAttributes = new \Illuminate\View\ComponentAttributeBag($default);

        foreach ($attributes->getAttributes() as $key => $value) {
            if (str_starts_with($key, $prefix)) {
                $newAttributes[substr($key, strlen($prefix))] = $value;
            }
        }

        return $newAttributes;
    }

    public function applyInset($inset, $top, $right, $bottom, $left)
    {
        if ($inset === null) return '';

        $insets = $inset === true
            ? collect(['top', 'right', 'bottom', 'left'])
            : str($inset)->explode(' ')->map(fn ($i) => trim($i));

        $insetClasses = [
            'top' => $top,
            'right' => $right,
            'bottom' => $bottom,
            'left' => $left,
        ];

        return $insets->map(fn ($i) => $insetClasses[$i])->join(' ');
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
