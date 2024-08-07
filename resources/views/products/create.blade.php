@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Product</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="ProductName">Product Name</label>
            <input type="text" name="ProductName" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="Description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="Price">Price</label>
            <input type="number" name="Price" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="StockQuantity">Stock Quantity</label>
            <input type="number" name="StockQuantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="CategoryID">Category</label>
            <select class="form-control"  name="CategoryID">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->CategoryName }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ImageURL">Image</label>
            <input type="file" name="ImageURL" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
