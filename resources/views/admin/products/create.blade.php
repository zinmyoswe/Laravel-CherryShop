@extends('layouts.app')

@section('content')
<!-- resources/views/products/create.blade.php -->
<div class="container">
    <h1 class="my-4">Create Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="productid" class="form-label">Product ID:</label>
                <input type="text" name="productid" id="productid" class="form-control" value="{{ old('productid') }}" required>
            </div>
            <div class="col-md-6">
                <label for="productname" class="form-label">Product Name:</label>
                <input type="text" name="productname" id="productname" class="form-control" value="{{ old('productname') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="category" class="form-label">Category:</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="col-md-6">
                <label for="gender" class="form-label">Gender:</label>
                <input type="text" name="gender" id="gender" class="form-control" value="{{ old('gender') }}" required>
            </div> --}}
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender:</label>
                <select name="gender" id="gender" class="form-select" required>
                    <option value="">Select Gender</option>
                    <option value="MEN" {{ old('gender') == 'MEN' ? 'selected' : '' }}>MEN</option>
                    <option value="WOMEN" {{ old('gender') == 'WOMEN' ? 'selected' : '' }}>WOMEN</option>
                    <option value="KIDS" {{ old('gender') == 'KIDS' ? 'selected' : '' }}>KIDS</option>
                </select>
            </div>
        </div>

        

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="price" class="form-label">Price:</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
            </div>
            <div class="col-md-6">
                <label for="stock" class="form-label">Stock:</label>
                <input type="text" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="images" class="form-label">Additional Images:</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">Video:</label>
            <input type="file" name="video" id="video" class="form-control">
        </div>

        <div class="mb-3">
            <label for="sizes" class="form-label">Select Sizes:</label>
            <select name="sizes[]" id="sizes" class="form-select" multiple required>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Select Colors:</label><br>
            @foreach ($colors as $color)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="color_{{ $color->id }}" name="colors[]" value="{{ $color->id }}">
                    <label class="form-check-label" for="color_{{ $color->id }}">
                        <img src="{{ Storage::url($color->image) }}" alt="Color Image" class="img-thumbnail" style="width: 50px; height: auto;">
                        {{ $color->name }}
                    </label>
                    <input type="file" name="color_images[]" class="form-control mt-2">
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Select Related Products:</label><br>
            @foreach ($products as $relatedProduct)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="related_product_{{ $relatedProduct->id }}" name="related_products[]" value="{{ $relatedProduct->id }}">
                    <label class="form-check-label" for="related_product_{{ $relatedProduct->id }}">
                        <img src="{{ Storage::url($relatedProduct->image) }}" alt="Product Image" class="img-thumbnail" style="width: 50px; height: auto;">
                        {{ $relatedProduct->productname }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>
@endsection
