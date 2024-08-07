@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="CategoryName">Category Name</label>
            <input type="text" name="CategoryName" id="CategoryName" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="Description" id="Description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="ImageURL">Image URL</label>
          
            <input type="file" name="ImageURL" id="ImageURL" class="form-control">
            
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
