@extends('layouts.app')

@section('content')
<!-- resources/views/products/index.blade.php -->
<h1>All Products</h1>
<a href="{{ route('admin.products.create') }}">Create New Product</a>
<table class="table">
    <thead>
        <tr>
            <th>Product Image</th>
            <th>Product ID</th>
            <th>ProductName</th>
            <th>Category</th>
            <th>Gender</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Colors</th>
            <th>Sizes</th>
            
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td><img src="{{ Storage::url($product->image) }}" alt="Product Image" width="90"></td>
            <td>{{ $product->productid }}</td>
            <td>{{ $product->productname }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ $product->gender }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                
                <ul>
                    @foreach ($product->colors as $color)
                        <li>{{ $color->name }}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                
                <ul>
                    @foreach ($product->sizes as $size)
                        <li>{{ $size->name }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $product->description }}</td>
            <td>
                <a href="{{ route('admin.products.show', $product->id) }}">View</a>
                <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                <!-- Add delete button -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection