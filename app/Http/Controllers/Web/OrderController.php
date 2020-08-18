<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = auth()->user()->orders;
        return view('pizza.orders.index', ['orders' => $orders]);
    }

    public function show(Request $request, Order $order)
    {
        return view('pizza.orders.show', ['order' => $order->load('cartItems.product.images')]);
    }
}
