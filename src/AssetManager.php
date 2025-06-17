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
        $instance->registerAssetRoutes();
    }

    public function registerAssetDirective()
    {
        Blade::directive('oannaScripts', function ($expression) {
            return <<<PHP
            <?php app('livewire')->forceAssetInjection() ?>
            {!! app('oanna')->scripts($expression) !!}
            PHP;
        });

        Blade::directive('oannaAssets', function ($expression) {
            return <<<PHP
            {!! app('oanna')->assets($expression) !!}
            PHP;
        });
    }

    public function registerAssetRoutes()
    {
        Route::get('/oanna/oanna.min.js', [static::class, 'oannaMinJs']);
    }

    public function oannaMinJs() {
        return $this->pretendResponseIsFile(__DIR__.'/../../livewire-component/dist/oanna.min.js', 'text/javascript');
    }

    public static function scripts($options = [])
    {
        return '<script src="/oanna/oanna.min.js"></script>';
    }

    public static function assets($options = [])
    {
        $assets = '';

        if (config('oanna.editor.ckeditor.enable')) {
            $assets .= '<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.css" /> <script src="https://cdn.ckeditor.com/ckeditor5/45.1.0/ckeditor5.umd.js"></script>';
        }
        else {
            $assets .= '<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet"> <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>';
        }

        if (is_string(config('oanna.icon.fontawesome'))) {
            $assets .= ' <script src="'.config('oanna.icon.fontawesome').'" crossorigin="anonymous"></script>';
        }

        return $assets;
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
