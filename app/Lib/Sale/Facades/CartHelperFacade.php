<?php

namespace App\Lib\Sale\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class CartHelperFacade
 *
 * @package App\Lib\Sale\Facades
 */
class CartHelperFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cart-helper';
    }
}
