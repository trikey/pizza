<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show(Request $request, Product $product)
    {
        return view('pizza.product', ['product' => $product]);
    }
}
