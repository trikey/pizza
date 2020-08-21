<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function show(Request $request, Category $category)
    {
        return view('pizza.products', [
            'products' => $category->products->chunk(3),
            'sectionName' => $category->name
        ]);
    }
}
