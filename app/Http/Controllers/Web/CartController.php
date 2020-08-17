<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\CartItem;
use Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = Cart::getCartItems();
        return view('pizza.cart', ['cartItems' => $cartItems]);
    }

    public function getCartItemsCount(Request $request)
    {
        $count = Cart::getCartItemsCount();
        return response()->json(['count' => $count]);
    }

    public function addToCart(Request $request, Product $product)
    {
        $quantity = $request->get('quantity');
        Cart::addProductToCart($product, $quantity);

        return $this->getCartItemsCount($request);
    }

    public function increaseCartItemQuantity(Request $request, CartItem $cartItem)
    {
        Cart::increaseQuantity($cartItem);
        return $this->index($request);
    }

    public function decreaseCartItemQuantity(Request $request, CartItem $cartItem)
    {
        Cart::decreaseQuantity($cartItem);
        return $this->index($request);
    }
}
