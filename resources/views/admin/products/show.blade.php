<!-- resources/views/products/show.blade.php -->
<h1>Product Details</h1>

<div>
    <strong>Product ID:</strong> {{ $product->productid }}
</div>

<div>
    <strong>Product Name:</strong> {{ $product->productname }}
</div>
<div>
    <strong>Category:</strong> {{ $product->category }}
</div>
<div>
    <strong>Gender:</strong> {{ $product->gender }}
</div>
<div>
    <strong>Price:</strong> {{ $product->price }}
</div>
<div>
    <strong>Stock:</strong> {{ $product->stock }}
</div>

<div>
<h2>Sizes:</h2>
<ul>
    @foreach ($product->sizes as $size)
        <li>{{ $size->name }}</li>
    @endforeach
</ul>
</div>

<div>
    <h2>Colors:</h2>
    <ul>
        @foreach ($product->colors as $color)
            <li>{{ $color->name }}</li>
        @endforeach
    </ul>
</div>


<div>
    <strong>Description:</strong> {{ $product->description }}
</div>
<div>
    <strong>Image:</strong> <img src="{{ Storage::url($product->image) }}" alt="Product Image" width="500">
</div>
@if ($product->images)
    <div>
        <strong>Additional Images:</strong>
        @foreach (json_decode($product->images) as $image)
            <img src="{{ Storage::url($image) }}" alt="Additional Image" width="500">
        @endforeach
    </div>
@endif
@if ($product->video)
    <div>
        <strong>Video:</strong>
        <video width="320" height="240" loop autoplay muted>
            <source src="{{ Storage::url($product->video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
@endif

<div>
    <h3>Available Colors:</h3>
    @foreach ($product->colors as $color)
        <div>
            <p>{{ $color->name }}</p>
            @if ($color->pivot->image)
                <img src="{{ Storage::url($color->pivot->image) }}" alt="{{ $color->name }}" width="100">
            @endif
        </div>
    @endforeach
</div>

<a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>

<form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
</form>

<a href="{{ route('admin.products.index') }}">Back to Products</a>
