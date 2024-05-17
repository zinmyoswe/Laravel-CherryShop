@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories and Products</h1>
    @foreach($categories as $category)
        <h2>{{ $category->name }}</h2>
        <ul>
            @foreach($category->products as $product)
                <li>{{ $product->name }} - ${{ $product->price }}</li>
            @endforeach
        </ul>
    @endforeach
</div>
@endsection
