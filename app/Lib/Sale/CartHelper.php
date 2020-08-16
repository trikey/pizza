<?php

namespace App\Lib\Sale;

use App\CartItem;
use App\SaleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartHelper
{
    public static function getCartItemsBySaleUserId(int $saleUserId)
    {
        return CartItem::whereSaleUserId($saleUserId)->whereOrderId(null)->with('product')->get();
    }

    public static function getCartItemsCount(int $saleUserId)
    {
        $cartItems = self::getCartItemsBySaleUserId($saleUserId);
        return $cartItems->pluck('quantity')->sum();
    }
}
