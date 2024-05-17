@extends('layouts.app')

@section('content')
<!-- resources/views/sizes/index.blade.php -->
<div class="container">
    <h1 class="my-4">Size List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.sizes.create') }}" class="btn btn-primary mb-3">Create New Size</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizes as $size)
                    <tr>
                        <td>{{ $size->id }}</td>
                        <td>{{ $size->name }}</td>
                        <td>
                            <a href="{{ route('admin.sizes.edit', $size->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this size?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection