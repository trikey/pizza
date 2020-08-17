<?php

namespace App\Lib\Sale;

use App\Order;
use App\OrderProperty;
use App\OrderPropertyValue;
use Illuminate\Support\Facades\DB;

class CheckoutHelper
{
    public static function checkout($propertyValues)
    {
        DB::transaction(function () use ($propertyValues) {
            $cartItems = Cart::getCartItems();
            $productsPrice = $cartItems->sum(function ($cartItem) {
                return $cartItem->price * $cartItem->quantity;
            });
            $deliveryPrice = 10;
            $totalPrice = $productsPrice + $deliveryPrice;

            $order = Order::create([
                'user_id' => optional(auth()->user())->getAuthIdentifier(),
                'total' => $totalPrice,
                'delivery_price' => $deliveryPrice,
                'products_price' => $productsPrice,
            ]);

            $properties = OrderProperty::all();
            $props = $properties->pluck('id', 'code')->toArray();
            foreach ($propertyValues as $code => $value) {
                if ($value) {
                    OrderPropertyValue::create([
                        'order_id' => $order->id,
                        'order_property_id' => $props[$code],
                        'value' => $value,
                    ]);
                }
            }

            $cartItems->each(function ($cartItem) use ($order) {
                $cartItem->order_id = $order->id;
                $cartItem->save();
            });

        }, 3);

    }
}
