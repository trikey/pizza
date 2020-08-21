<?php

namespace App\Lib\Sale;

use App\SaleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Symfony\Component\HttpFoundation\Cookie;

class SaleUserHelper
{
    private $cookieName;

    public function __construct()
    {
        $this->cookieName = config('sale.user_code_cookie_name');
    }

    public function getCurrentSaleUserId(): ?int
    {
        return session(config('sale.user_id_session_name'), null);
    }

    public function initFromRequest(Request $request): void
    {
        $saleUser = $this->getSaleUserFromRequest($request);
        $this->attachSaleUserCookie($saleUser);
    }

    public function attachUserToSaleUser(int $userId): void
    {
        $saleUser = SaleUser::find(self::getCurrentSaleUserId());
        $saleUser->user_id = $userId;
        $saleUser->save();
    }

    public function attachSaleUserCookie(SaleUser $saleUser): void
    {
        $this->updateSaleUserSession($saleUser);
        $cookie = $this->makeSaleUserCodeCookie($saleUser);
        cookie()->queue($cookie);
    }

    public function detachSaleUserCookie()
    {
        cookie()->queue(cookie()->forget($this->getSaleUserCookieName()));
    }

    protected function makeSaleUserCodeCookie(SaleUser $saleUser): Cookie
    {
        $cookieName = $this->getSaleUserCookieName();
        return cookie()->make($cookieName, $saleUser->code, 60 * 24 * 30);
    }

    protected function updateSaleUserSession(SaleUser $saleUser): void
    {
        $saleUser->touch();
        session()->put(config('sale.user_id_session_name'), $saleUser->id);
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
