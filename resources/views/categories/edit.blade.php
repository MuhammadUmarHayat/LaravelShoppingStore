@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="CategoryName">Category Name</label>
            <input type="text" name="CategoryName" id="CategoryName" class="form-control" value="{{ $category->CategoryName }}" required>
        </div>

        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="Description" id="Description" class="form-control">{{ $category->Description }}</textarea>
        </div>

        <div class="form-group">
            <label for="ImageURL">Image URL</label>
            @if($category->ImageURL)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $category->ImageURL) }}" alt="{{ $category->CategoryName }}" style="max-width: 100px;">
                </div>
            @endif
            <input type="file" name="ImageURL" id="ImageURL" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
