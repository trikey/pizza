<?php

namespace App\Http\Middleware;

use SaleUser;
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
        if (!SaleUser::getCurrentSaleUserId()) {
            SaleUser::initFromRequest($request);
        }
        return $next($request);
    }
}
