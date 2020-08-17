<?php

namespace App\Lib\Sale;

use App\CartItem;
use App\Product;

class CartHelper
{
    private $saleUserId;

    public function __construct()
    {
        $this->saleUserId = SaleUserHelper::getCurrentSaleUserId();
    }

    public function getCartItems()
    {
        return self::getCartItemsBySaleUserId($this->saleUserId);
    }

    public function getCartItemsCount()
    {
        $cartItems = self::getCartItemsBySaleUserId($this->saleUserId);
        return $cartItems->pluck('quantity')->sum();
    }

    public function increaseQuantity(CartItem $cartItem)
    {
        $cartItem->quantity += 1;
        $cartItem->save();
    }

    public function decreaseQuantity(CartItem $cartItem)
    {
        $cartItem->quantity -= 1;
        if ($cartItem->quantity > 0) {
            $cartItem->save();
        }
        else {
            CartItem::destroy($cartItem->id);
        }
    }

    public function addProductToCart(Product $product, int $quantity = 1)
    {
        $cartItem = CartItem::whereProductId($product->id)
            ->whereSaleUserId($this->saleUserId)
            ->notOrdered()->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        }
        else {
            CartItem::create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'sale_user_id' => $this->saleUserId
            ]);
        }
    }

    public static function getCartItemsBySaleUserId(int $saleUserId)
    {
        return CartItem::whereSaleUserId($saleUserId)
            ->notOrdered()
            ->with('product')
            ->get();
    }
}
