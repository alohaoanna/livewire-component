<?php

namespace OANNA;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;

class AssetManager
{
    static function boot()
    {
        $instance = new static;

        $instance->registerAssetDirective();
        $instance->registerRoutes();
    }

    public function registerAssetDirective()
    {
        Blade::directive('oannaScripts', function ($expression) {
            return <<<PHP
            <?php app('livewire')->forceAssetInjection() ?>
            {!! app('oanna')->scripts($expression) !!}
            PHP;
        });
    }

    public function registerRoutes()
    {
        Route::prefix(config('oanna.route_prefix', 'oanna'))->group(function () {
            // GET /monpackage/config → renvoie un sous-ensemble de la config
            Route::get('/config', function () {
                $all = config('oanna', []);
                $expose = $all['expose_keys'] ?? [];

                if (is_array($expose) && $expose) {
                    $allowed = array_intersect_key($all, array_flip($expose));
                } else {
                    $allowed = $all; // fallback si tu veux tout exposer (déconseillé si sensible)
                }

                return response()->json($allowed);
            });

            Route::get('oanna.min.js', [static::class, 'oannaMinJs']);
        });
    }

    public function oannaMinJs() {
        return $this->pretendResponseIsFile(__DIR__.'/../../livewire-component/dist/oanna.min.js', 'text/javascript');
    }

    public static function scripts($options = [])
    {
        return '<script src="/'.config('oanna.route_prefix', 'oanna').'/oanna.min.js"></script>';
    }

    public function pretendResponseIsFile($file, $contentType = 'application/javascript; charset=utf-8')
    {
        $lastModified = filemtime($file);

        return $this->cachedFileResponse($file, $contentType, $lastModified,
            fn ($headers) => response()->file($file, $headers));
    }

    protected function cachedFileResponse($filename, $contentType, $lastModified, $downloadCallback)
    {
        $expires = strtotime('+1 year');
        $cacheControl = 'public, max-age=31536000';

        if ($this->matchesCache($lastModified)) {
            return response('', 304, [
                'Expires' => $this->httpDate($expires),
                'Cache-Control' => $cacheControl,
            ]);
        }

        $headers = [
            'Content-Type' => $contentType,
            'Expires' => $this->httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => $this->httpDate($lastModified),
        ];

        if (str($filename)->endsWith('.br')) {
            $headers['Content-Encoding'] = 'br';
        }

        return $downloadCallback($headers);
    }

    protected function matchesCache($lastModified)
    {
        $ifModifiedSince = app(Request::class)->header('if-modified-since');

        return $ifModifiedSince !== null && @strtotime($ifModifiedSince) === $lastModified;
    }

    protected function httpDate($timestamp)
    {
        return sprintf('%s GMT', gmdate('D, d M Y H:i:s', $timestamp));
    }
}
