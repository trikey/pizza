<?php

namespace App\Lib\Sale;

use App\Currency;

class CurrencyHelper
{
    public function getCurrentUserCurrency()
    {
        return session(config('sale.currency_session_name'), null);
    }

    public function setCurrentUserBaseCurrency()
    {
        $baseCurrency = Currency::whereIsBase(1)->first();
        $this->setCurrency($baseCurrency);
    }

    public function setCurrentUserCurrency(string $currencyCode)
    {
        $currency = Currency::whereCode($currencyCode)->first();
        if ($currency) {
            $this->setCurrency($currency);
        }
    }

    public function formatPrice(float $price)
    {
        $currency = $this->getCurrentUserCurrency();
        return $currency->format . round($price * $currency->rate, 2);
    }

    public function isSelected(Currency $currency)
    {
        $currentCurrency = $this->getCurrentUserCurrency();
        if ($currentCurrency) {
            return $currency->code == $currentCurrency->code;
        }
        return false;
    }

    private function setCurrency(Currency $currency)
    {
        session()->put(config('sale.currency_session_name'), $currency);
    }
}
