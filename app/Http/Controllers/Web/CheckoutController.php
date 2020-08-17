<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\OrderProperty;
use Illuminate\Http\Request;
use Cart;
use App\Lib\Sale\CheckoutHelper;

class CheckoutController extends Controller
{
    public function checkoutPage(Request $request)
    {
        if (!Cart::getCartItemsCount()) {
            return redirect(route('index'));
        }

        $properties = OrderProperty::all();

        return view('pizza.checkout', ['properties' => $properties]);
    }

    public function checkout(Request $request)
    {
        if (!Cart::getCartItemsCount()) {
            return response()->json(['message' => 'no items for checkout'], 422);
        }

        $propertyValues = $request->all(
            OrderProperty::all()->pluck('code')->toArray()
        );

        CheckoutHelper::checkout($propertyValues);

        return response()->json(['message' => 'Thank you for order']);
    }
}
