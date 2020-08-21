<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
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

    public function getValidationRules(Request $request)
    {
        $rules = CheckoutHelper::getValidationRulesForFrontend();

        return response()->json(['rules' => $rules]);
    }

    public function checkout(CheckoutRequest $request)
    {
        if (!Cart::getCartItemsCount()) {
            return response()->json(['message' => 'no items for checkout'], 422);
        }

        $propertyValues = $request->all(
            OrderProperty::all()->pluck('code')->toArray()
        );

        $order = CheckoutHelper::checkout($propertyValues);
        $responseMessage = "Thank you for order. The order number is {$order->id}";

        return response()->json(['message' => $responseMessage]);
    }
}
