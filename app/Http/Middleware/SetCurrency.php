<?php

namespace App\Http\Middleware;

use Closure;
use App\Lib\Sale\CurrencyHelper;
use Currency;

class SetCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Currency::getCurrentUserCurrency()) {
            Currency::setCurrentUserBaseCurrency();
        }
        if ($request->has('currency')) {
            Currency::setCurrentUserCurrency($request->get('currency'));
        }

        return $next($request);
    }
}
