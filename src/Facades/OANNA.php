<?php

namespace OANNA\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \OANNA\OANNA
 */
class OANNA extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \OANNA\OANNA::class;
    }
}
