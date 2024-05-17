<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all(); // Load categories
        return view('products.index', compact('products','categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
