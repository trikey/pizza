<?php

namespace App\Lib\Sale\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class CartHelperFacade
 *
 * TODO add documentation for reference
 *
 * @package App\Lib\Sale\Facades
 */
class CurrencyHelperFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'currency-helper';
    }
}
