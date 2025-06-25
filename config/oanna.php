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

    /*
    |--------------------------------------------------------------------------
    | Colors
    |--------------------------------------------------------------------------
    |
    | Here are the list of colors available in some components for exemple badge, avatar...
    | This array is used in the components for the "auto" value.
    | You can remove somes if you want to prevent the auto value to take them but can't add somes.
    |
    */

    'colors' => [
        'zinc',
        'red',
        'orange',
        'amber',
        'yellow',
        'lime',
        'green',
        'emerald',
        'teal',
        'cyan',
        'sky',
        'blue',
        'indigo',
        'violet',
        'purple',
        'fuchsia',
        'pink',
        'rose',
    ],

    /*
    |--------------------------------------------------------------------------
    | JQuery
    |--------------------------------------------------------------------------
    |
    | This library of component need JQuery to work. For this we set an auto import of JQuery code via cdn in the assets directive.
    | For preventing too many resources to be import or if you already have jquery installed via another cdn or via npm.
    | Set this value too false to prevent jquery to be import.
    |
    */

    'auto_import_jquery' => true,
];
