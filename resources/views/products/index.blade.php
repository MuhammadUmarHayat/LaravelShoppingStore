@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered mt-4">
        <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Available Quantity</th>
            <th>Category</th>
        </tr>
        
        @foreach ($products as $product)
            <tr>
                
                <td>{{ $product->ProductID }}</td>
                <td> @if($product->ImageURL)
                        <img src="{{ asset('storage/' . $product->ImageURL) }}" alt="{{ $product->ProductName }}" style="max-width: 100px;">
                    @else
                        No Image
                    @endif</td>
                <td>{{ $product->ProductName }}</td>
                <td>{{ $product->Description }}</td>
                <td>{{ $product->Price }}</td>
                
                <td>{{ $product->StockQuantity }}</td>
                <td>{{ $product->category->CategoryName }}</td>
                <td>
                    <a href="{{ route('products.show', $product->ProductID) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('products.edit', $product->ProductID) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('products.destroy', $product->ProductID) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
