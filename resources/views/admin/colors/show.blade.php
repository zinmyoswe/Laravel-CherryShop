<!-- resources/views/colors/show.blade.php -->
<h1>color Details</h1>

<div>
    <strong>ID:</strong> {{ $color->id }}
</div>
<div>
    <strong>Name:</strong> {{ $color->name }}
</div>

<a href="{{ route('admin.colors.edit', $color->id) }}">Edit</a>

<form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure you want to delete this color?')">Delete</button>
</form>

<a href="{{ route('admin.colors.index') }}">Back to color List</a>
