<!-- resources/views/categories/show.blade.php -->
<h1>Category Details</h1>

<div>
    <strong>Category ID:</strong> {{ $category->id }}
</div>
<div>
    <strong>Name:</strong> {{ $category->name }}
</div>
<div>
    <strong>Description:</strong> {{ $category->description }}
</div>

<a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>

<form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
</form>

<a href="{{ route('admin.categories.index') }}">Back to Categories</a>
