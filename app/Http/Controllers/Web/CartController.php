<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\CartItem;
use App\Lib\Sale\CartHelper;
use App\Lib\Sale\SaleUserHelper;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $saleUser = SaleUserHelper::getSaleUser($request);
        $cartItems = CartHelper::getCartItemsBySaleUserId($saleUser->id);
        return view('pizza.cart', ['cartItems' => $cartItems]);
    }

    public function getCartItemsCount(Request $request)
    {
        $saleUser = SaleUserHelper::getSaleUser($request);
        $count = CartHelper::getCartItemsCount($saleUser->id);
        return response()->json(['count' => $count]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->get('product_id');
        $product = Product::find($productId);

        $saleUser = SaleUserHelper::getSaleUser($request);
        $cartItem = CartItem::whereProductId($productId)->whereSaleUserId($saleUser->id)->first();
        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        }
        else {
            CartItem::create([
                'product_id' => $product->id,
                'quantity' => $request->get('quantity'),
                'price' => $product->price,
                'sale_user_id' => $saleUser->id
            ]);
        }
        return $this->getCartItemsCount($request);
    }

    public function increaseCartItemQuantity(Request $request)
    {
        $cartItemId = $request->get('id');
        $cartItem = CartItem::find($cartItemId);
        $cartItem->quantity++;
        $cartItem->save();
        return $this->index($request);
    }

    public function decreaseCartItemQuantity(Request $request)
    {
        $cartItemId = $request->get('id');
        $cartItem = CartItem::find($cartItemId);
        $cartItem->quantity--;
        if ($cartItem->quantity > 0) {
            $cartItem->save();
        }
        else {
            CartItem::destroy($cartItemId);
        }
        return $this->index($request);
    }
}
