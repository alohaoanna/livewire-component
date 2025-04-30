<?php

namespace OANNA\Compo;

use Illuminate\Support\Facades\Facade;

/**
 * @method static modal($name);
 * @method static modals();
 * @method static void toast($text, $heading = null, $duration = 5000, $variant = null, $position = null);
 *
 * @see CompoManager
 */
class Compo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'compo';
    }
}
