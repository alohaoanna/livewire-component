<?php

namespace OANNA\Compo;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\ComponentAttributeBag;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CompoServiceProvider extends PackageServiceProvider
{
    public function registeringPackage()
    {
        parent::registeringPackage();

        $this->app->alias(CompoManager::class, 'compo');

        $this->app->singleton(CompoManager::class);
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Compo', \OANNA\Compo\Compo::class);
    }

    public function bootingPackage()
    {
        parent::bootingPackage();

        $this->bootComponentPath();
        $this->bootTagCompiler();
        $this->bootMacros();

        AssetManager::boot();

        app('compo')->boot();
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('livewire-component');
    }

    public function bootComponentPath()
    {
        if (file_exists(resource_path('views/compo'))) {
            Blade::anonymousComponentPath(resource_path('views/compo'), 'compo');
        }

        Blade::anonymousComponentPath(__DIR__.'/../stubs/resources/views/compo', 'compo');
    }

    public function bootTagCompiler()
    {
        $compiler = new CompoTagCompiler(
            app('blade.compiler')->getClassComponentAliases(),
            app('blade.compiler')->getClassComponentNamespaces(),
            app('blade.compiler')
        );

        app()->bind('flux.compiler', fn () => $compiler);

        app('blade.compiler')->precompiler(function ($in) use ($compiler) {
            return $compiler->compile($in);
        });
    }

    public function bootMacros()
    {
        app('view')::macro('getCurrentComponentData', function () {
            return $this->currentComponentData;
        });

        ComponentAttributeBag::macro('pluck', function ($key) {
            $result = $this->get($key);

            unset($this->attributes[$key]);

            return $result;
        });
    }
}
