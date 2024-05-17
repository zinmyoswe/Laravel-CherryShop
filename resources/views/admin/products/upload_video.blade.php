<!-- resources/views/products/upload_video.blade.php -->
<form action="{{ route('admin.products.uploadVideo', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="video">
    <button type="submit">Upload Video</button>
</form>
