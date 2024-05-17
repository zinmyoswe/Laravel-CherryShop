<!-- resources/views/sizes/edit.blade.php -->
<h1>Edit Size</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.sizes.update', $size->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $size->name }}" required>
    </div>
    <button type="submit">Update Size</button>
</form>
