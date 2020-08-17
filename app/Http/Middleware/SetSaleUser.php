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
        if (!SaleUserHelper::getCurrentSaleUserId()) {
            $saleUser = new SaleUserHelper($request);
            $saleUser->updateSaleUserSession();
            $cookie = $saleUser->makeSaleUserCodeCookie();
            return $next($request)->withCookie($cookie);
        }
        return $next($request);
    }
}
