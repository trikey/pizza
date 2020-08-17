<?php

namespace App\Lib\Sale;

use App\SaleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Symfony\Component\HttpFoundation\Cookie;

class SaleUserHelper
{
    protected $saleUser;
    private $cookieName;

    public function __construct(Request $request)
    {
        $this->cookieName = config('sale.user_code_cookie_name');
        $this->saleUser = $this->getSaleUserFromRequest($request);
    }

    public function updateSaleUserSession(): void
    {
        $this->saleUser->touch();
        session()->put(config('sale.user_id_session_name'), $this->saleUser->id);
    }

    public function makeSaleUserCodeCookie(): Cookie
    {
        $cookieName = $this->getSaleUserCookieName();
        return cookie()->make($cookieName, $this->saleUser->code, 60 * 24 * 30);
    }

    public static function getCurrentSaleUserId(): ?int
    {
        return session(config('sale.user_id_session_name'), null);
    }

    protected function getSaleUserFromRequest(Request $request): SaleUser
    {
        $saleUserCookie = $request->cookie($this->getSaleUserCookieName());
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

    private function getSaleUserCookieName(): string
    {
        return $this->cookieName;
    }
}
