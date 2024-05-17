<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); // Retrieve all categories
        $sizes = Size::all(); // Retrieve all sizes
        $colors = Color::all();
        $products = Product::all();
        return view('admin.products.create', compact('categories', 'sizes', 'colors','products')); // Pass both $categories and $sizes to the view
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'productid' => 'required|unique:products',
            'productname' => 'required',
            'category' => 'required',
            'gender' => 'required|string|in:MEN,WOMEN,KIDS',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4|max:20480',
            'sizes' => 'required|array', // Add validation for sizes input
            'sizes.*' => 'exists:sizes,id', // Validate each size ID exists in the sizes table
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
            'color_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'related_products' => 'nullable|array',
            'related_products.*' => 'exists:products,id',
        ]);

        // Handle file uploads
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('public/images');
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('public/images');
            }
            $validatedData['images'] = json_encode($images);
        }

        if ($request->hasFile('video')) {
            $validatedData['video'] = $request->file('video')->store('public/videos');
        }

        // Create the product
        $product = Product::create($validatedData);

         // Attach sizes to the product
        $product->sizes()->attach($validatedData['sizes']);

        // Attach colors to the product
        // $product->colors()->attach($request->colors);

        foreach ($request->input('colors') as $index => $colorId) {
            $image = $request->file("color_images.{$index}");
            $imagePath = $image ? $image->store('public/color_images') : null;
            $product->colors()->attach($colorId, ['image' => $imagePath]);
        }

        // Handle multiple selected products
        // if ($request->has('products')) {
        //     $selectedProducts = $request->input('products');
        //     $product->relatedProducts()->attach($selectedProducts);
        // }

        // Attach related products
        if ($request->has('related_products')) {
            $product->relatedProducts()->attach($request->input('related_products'));
        }

        // Redirect back with success message
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::with(['colors', 'sizes', 'relatedProducts'])->findOrFail($id);
        $categories = Category::all();
        $sizes = Size::all(); // Retrieve all sizes
        $colors = Color::all();
        $products = Product::all(); 
        return view('admin.products.edit', compact('product', 'categories', 'sizes', 'colors','products'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'productid' => 'required|unique:products,productid,' . $id,
            'productname' => 'required',
            'category' => 'required',
            'gender' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4|max:20480',
            'sizes' => 'required|array', // Add validation for sizes input
            'sizes.*' => 'exists:sizes,id', // Validate each size ID exists in the sizes table
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
            'color_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'related_products' => 'nullable|array',
            'related_products.*' => 'exists:products,id',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update the product attributes
        $product->productid = $validatedData['productid'];
        $product->productname = $validatedData['productname'];
        $product->category = $validatedData['category'];
        $product->gender = $validatedData['gender'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->description = $validatedData['description'];

        // Handle file uploads
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('public/images');
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('public/images');
            }
            $product->images = json_encode($images);
        }

        if ($request->hasFile('video')) {
            $product->video = $request->file('video')->store('public/videos');
        }

        $product->sizes()->sync($request->input('sizes'));
        // $product->colors()->sync($request->input('colors'));
        // Save the updated product
        // $product->save();
        $product->update($validatedData);

        // Sync colors with images
        // $syncData = [];
        // foreach ($request->input('colors') as $index => $colorId) {
        //     $image = $request->file("color_images.{$index}");
        //     $imagePath = $image ? $image->store('public/color_images') : $product->colors()->where('color_id', $colorId)->first()->pivot->image;
        //     $syncData[$colorId] = ['image' => $imagePath];
        // }
        // $product->colors()->sync($syncData);


         // Sync colors to the product with images
        // $colorData = [];
        // foreach ($request->input('colors') as $index => $colorId) {
        //     $image = $request->file('color_images')[$index] ?? null;
        //     $imagePath = $image ? $image->store('public/color_images') : null;
        //     $colorData[$colorId] = ['image' => $imagePath];
        // }
        // $product->colors()->sync($colorData);

        // // Sync related products
        // $product->relatedProducts()->sync($request->input('related_products', []));

        // Sync colors to the product with images
        $colorData = [];
        foreach ($request->input('colors', []) as $index => $colorId) {
            $image = $request->file('color_images')[$index] ?? null;
            $imagePath = $image ? $image->store('public/color_images') : null;
            $colorData[$colorId] = ['image' => $imagePath];
        }

        // Now, instead of directly syncing, let's iterate through $colorData and attach images individually
        // foreach ($colorData as $colorId => $data) {
        //     $product->colors()->attach($colorId, ['image' => $data['image']]);
        // }

        // Now, let's update existing data in the pivot table
    foreach ($colorData as $colorId => $data) {
        $product->colors()->updateExistingPivot($colorId, ['image' => $data['image']]);
    }


        // Redirect back with success message
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // Delete associated images and videos if needed
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function uploadImages(Request $request, $id)
    {
        $validatedData = $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('images');
            // Save $imagePath to the database or append to existing images
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }

    public function uploadVideo(Request $request, $id)
    {
        $validatedData = $request->validate([
            'video' => 'required|mimes:mp4|max:20480',
        ]);

        $product = Product::findOrFail($id);

        $videoPath = $request->file('video')->store('videos');
        // Save $videoPath to the database

        return redirect()->back()->with('success', 'Video uploaded successfully.');
    }
}
