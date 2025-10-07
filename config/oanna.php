<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Routes prefix
    |--------------------------------------------------------------------------
    |
    | Define the routes prefix of the package
    |
    */

    'route_prefix' => 'oanna',

    /*
    |--------------------------------------------------------------------------
    | Livewire Icons
    |--------------------------------------------------------------------------
    |
    | Define uses for icons in livewire-component.
    | He will always use fontawesome before else.
    |
    */

    'icon' => [

        /*
        |--------------------------------------------------------------------------
        | Sprite
        |--------------------------------------------------------------------------
        |
        | Sprite is use by default
        | This key is used by the icon component. Please provide your sprite file path to set in asset() function
        |
        */

        'sprite' => 'images/sprite.svg',

    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire Editor
    |--------------------------------------------------------------------------
    |
    | Configuration parameters of editor component wysiwyg
    |
    */

    'editor' => [

        /*
        |--------------------------------------------------------------------------
        | Core
        |--------------------------------------------------------------------------
        |
        | Specified the core of the editor that'll be use.
        | Possibilities: ckeditor, quill
        |
        */

        'core' => 'quill',

        /*
        |--------------------------------------------------------------------------
        | CKEditor
        |--------------------------------------------------------------------------
        |
        | Enable it to use ckeditor as core for wysiwyg component.
        | You will need a license_key to be able to use it in your code.
        |
        */

        'ckeditor' => [


            'license_key' => env('CKEDITOR_LICENSE_KEY', '<YOUR_LICENSE_KEY>'),

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire toast
    |--------------------------------------------------------------------------
    |
    | Default configuration for the toast.
    |
    */

    'toast' => [

        /*
        |--------------------------------------------------------------------------
        | Duration
        |--------------------------------------------------------------------------
        |
        | Define the default duration of the toast.
        | You can still provide a custom one when calling a toast in PHP or JS.
        |
        */

        'duration' => 3000,

        /*
        |--------------------------------------------------------------------------
        | Position
        |--------------------------------------------------------------------------
        |
        | Define the default position of the toast.
        | You can still provide a custom one when calling a toast in PHP or JS.
        |
        */

        'position' => 'bottom right',

    ],
];
