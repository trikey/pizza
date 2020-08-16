<?php

namespace App\Lib\Sale;

use App\SaleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Symfony\Component\HttpFoundation\Cookie;

class SaleUserHelper
{
    public static function getSaleUser(Request $request): SaleUser
    {
        $saleUserId = session('sale_user_id');
        if ($saleUserId) {
            return SaleUser::find($saleUserId);
        }

        $cookieName = config('sale.user_cookie_name');
        $saleUserCookie = $request->cookie($cookieName);
        $saleUserCode = $saleUserCookie ?: md5(time() . Str::random(10));
        $userId = optional(auth()->user())->getAuthIdentifier();

        $saleUser = SaleUser::whereCode($saleUserCode)->limit(1)->first();
        if (!$saleUser) {
            $saleUser = SaleUser::create([
                'user_id' => $userId,
                'code' => $saleUserCode,
            ]);
        }

        return $saleUser;
    }

    public static function setSaleUserCode(SaleUser $saleUser): Cookie
    {
        session()->put('sale_user_id', $saleUser->id);
        $saleUser->touch();
        $saleUserCode = $saleUser->code;
        $cookieName = config('sale.user_cookie_name');
        return cookie()->make($cookieName, $saleUserCode, 60 * 24 * 30);
    }
}
