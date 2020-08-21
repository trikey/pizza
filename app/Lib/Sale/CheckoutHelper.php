<?php

namespace App\Lib\Sale;

use App\Order;
use App\OrderProperty;
use App\OrderPropertyValue;
use Illuminate\Support\Facades\DB;
use Cart;

class CheckoutHelper
{
    public static function checkout($propertyValues)
    {
        return DB::transaction(function () use ($propertyValues) {
            $cartItems = Cart::getCartItems();
            $productsPrice = $cartItems->sum(function ($cartItem) {
                return $cartItem->price * $cartItem->quantity;
            });
            $deliveryPrice = config('sale.delivery_price');
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

            return $order;

        }, 3);

    }

    public static function getValidationRulesForFrontend()
    {
        $propertyRules = OrderProperty::required()->get()->toArray();

        return array_reduce($propertyRules, function ($carry, $item) {
            $rules = ['notEmpty' => true];
            if ($item['is_phone']) {
                $rules['checkMask'] = true;
            }
            $carry[$item['code']] = $rules;

            return $carry;
        }, []);
    }

    public static function getValidationRulesForBackend()
    {
        $propertyRules = OrderProperty::required()->get()->toArray();
        return array_reduce($propertyRules, function ($carry, $item) {
            $rules = ['required'];
            if ($item['is_email']) {
                $rules[] = 'email';
            }
            $carry[$item['code']] = $rules;

            return $carry;
        }, []);

    }
}
