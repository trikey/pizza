<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('pizza.products', ['products' => Product::popular()->with('images')->get()->chunk(3)]);
    }
}
