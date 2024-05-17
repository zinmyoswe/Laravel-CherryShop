@extends('layouts.app')

@section('content')
<!-- resources/views/categories/index.blade.php -->
<div class="container">
    <h1 class="my-4">All Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <!-- Add more columns as needed -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <!-- Display more category details -->
                    <td>
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
