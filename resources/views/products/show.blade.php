@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <img src="{{ Storage::url($product->image) }}" alt="Product Image" width="250">
                <h5 class="card-title">{{ $product->productname }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text">Price: ${{ $product->price }}</p>
                <p class="card-text">Category: {{ $product->category }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
        </div>
    </div>
</div>
@endsection