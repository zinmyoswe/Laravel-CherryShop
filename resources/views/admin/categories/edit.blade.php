<!-- resources/views/categories/edit.blade.php -->
<h1>Edit Category</h1>

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}" required>
    </div>
    <button type="submit">Update Category</button>
</form>
