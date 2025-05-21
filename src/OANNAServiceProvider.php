<?php

namespace OANNA;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\ComponentAttributeBag;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OANNAServiceProvider extends PackageServiceProvider
{
    public function registeringPackage()
    {
        parent::registeringPackage();

        $this->app->alias(OANNA::class, 'oanna');

        $this->app->singleton(OANNA::class);
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('OANNA', Facades\OANNA::class);
    }

    public function bootingPackage()
    {
        parent::bootingPackage();

        $this->bootComponentPath();
        $this->bootTagCompiler();
        $this->bootMacros();

        AssetManager::boot();

        app('oanna')->boot();
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('livewire-component')
            ->hasConfigFile('oanna');
    }

    public function bootComponentPath()
    {
        if (file_exists(resource_path('views/oanna'))) {
            Blade::anonymousComponentPath(resource_path('views/oanna'), 'oanna');
        }

        Blade::anonymousComponentPath(__DIR__.'/../stubs/resources/views/oanna', 'oanna');
    }

    public function bootTagCompiler()
    {
        $compiler = new OANNATagCompiler(
            app('blade.compiler')->getClassComponentAliases(),
            app('blade.compiler')->getClassComponentNamespaces(),
            app('blade.compiler')
        );

        app()->bind('oanna.compiler', fn () => $compiler);

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
