<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
{
    // Eager load the products relationship
    $categories = Category::with('products')->get();
    
    return view('categories.index', compact('categories'));
}
}
