@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    @foreach($products as $product)
        <div class="card mb-3">
            <div class="card-body">
                <img src="{{ Storage::url($product->image) }}" alt="Product Image" width="250">
                <h5 class="card-title">{{ $product->productname }}</h5>
                {{-- <p class="card-text">{{ $product->description }}</p> --}}
                <p class="card-text">Price: ${{ $product->price }}</p>
                <p class="card-text">Category: {{ $product->category }}</p>
                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View Details</a>
            </div>
        </div>
    @endforeach
</div>
@endsection