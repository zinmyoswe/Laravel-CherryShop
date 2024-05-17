@extends('layouts.app')

@section('content')
<!-- resources/views/colors/index.blade.php -->
<h1>color List</h1>

@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('admin.colors.create') }}">Create New color</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($colors as $color)
            <tr>
                <td>{{ $color->id }}</td>
                <td>{{ $color->name }}</td>
                <td>
                    <a href="{{ route('admin.colors.edit', $color->id) }}">Edit</a>
                    <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this color?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
