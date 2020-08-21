<?php

namespace App\Lib\Sale\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class SaleUserHelperFacade
 *
 * @package App\Lib\Sale\Facades
 */
class SaleUserHelperFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sale-user-helper';
    }
}
