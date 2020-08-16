<?php

namespace App\Http\Middleware;

use App\SaleUser;
use Closure;
use Illuminate\Support\Str;

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
        $saleUserExists = session('sale_user_id');
        if (!$saleUserExists) {
            return $next($request);
        }

        $cookieName = config('sale.user_cookie_name');
        $saleUserCookie = $request->cookie($cookieName);
        $saleUserCode = $saleUserCookie ?: md5(time() . Str::random(10));
        $userId = optional(auth()->user())->getAuthIdentifier();

        $saleUser = SaleUser::whereCode($saleUserCode)->limit(1)->first();
        if (!$saleUser) {
            SaleUser::create([
                'user_id' => $userId,
                'code' => $saleUserCode,
            ]);
        }
        else {
            $saleUser->touch();
        }

        session()->put('sale_user_id', $saleUserCode);

        return $next($request)->withCookie(cookie()->make($cookieName, $saleUserCode, 60 * 24 * 30));
    }
}
