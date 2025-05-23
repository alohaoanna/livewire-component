<?php
return [

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
        | Fontawesome
        |--------------------------------------------------------------------------
        |
        | This key is used by the icon component. Provide your fontawesome url kit here.
        | Only set it to true if you already import your kit in your templates
        |
        */

        'fontawesome' => null,

        /*
        |--------------------------------------------------------------------------
        | Sprite
        |--------------------------------------------------------------------------
        |
        | Sprite is use by default if fontawesome is'nt specified
        | This key is used by the icon component. If you provide your sprite.svg path here
        | Icon component will use svg sprite as icon.
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
];
