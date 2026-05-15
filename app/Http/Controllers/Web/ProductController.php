<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Domains\Product\Models\Product::with('category')->get();
        return view('web.products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = \App\Domains\Product\Models\Product::with(['category', 'specifications.attribute'])->where('slug', $slug)->firstOrFail();
        
        return view('web.products.show', compact('product'));
    }
}
