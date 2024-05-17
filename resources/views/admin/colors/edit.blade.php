<!-- resources/views/colors/edit.blade.php -->
<h1>Edit color</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.colors.update', $color->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $color->name }}" required>
    </div>
    <button type="submit">Update color</button>
</form>
