<?php

namespace App\Http\Middleware;

use App\Lib\Sale\SaleUserHelper;
use Closure;

class SetSaleUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $saleUser = SaleUserHelper::getSaleUser($request);
        return $next($request)->withCookie(SaleUserHelper::setSaleUserCode($saleUser));
    }
}
