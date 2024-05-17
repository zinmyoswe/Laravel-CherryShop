<!-- resources/views/categories/create.blade.php -->
<h1>Create Category</h1>

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <button type="submit">Create Category</button>
</form>
