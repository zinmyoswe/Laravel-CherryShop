<!-- resources/views/sizes/show.blade.php -->
<h1>Size Details</h1>

<div>
    <strong>ID:</strong> {{ $size->id }}
</div>
<div>
    <strong>Name:</strong> {{ $size->name }}
</div>

<a href="{{ route('admin.sizes.edit', $size->id) }}">Edit</a>

<form action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure you want to delete this size?')">Delete</button>
</form>

<a href="{{ route('admin.sizes.index') }}">Back to Size List</a>
