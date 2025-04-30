<?php

namespace OANNA\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static modal($name);
 * @method static modals();
 * @method static void toast($text, $heading = null, $duration = 5000, $variant = null, $position = null);
 *
 * @see OannaManager
 */
class OANNA extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'oanna';
    }
}
