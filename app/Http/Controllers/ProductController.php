<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($name)
    {
        $product = Product::where('name', $name)->firstOrFail();
        return view('products.show', compact('product'));
    }
}
