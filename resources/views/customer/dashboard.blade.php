@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
    <div class="col-md-4">
    <form action="{{ route('logout') }}" method="Post" class="mb-4">
                <div class="input-group">
                @csrf
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-danger">logout</button>
                    </div>
                </div>
</div>
</div>

    <div class="row">
        <div class="col-md-4">
            <h3>Categories</h3>
            <ul class="list-group" id="category-list">
                @foreach ($categories as $category)
                    <li class="list-group-item" onclick="filterProducts({{ $category->id }})">{{ $category->CategoryName }}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-8">
            <h3>Search Products</h3>
            <form action="{{ route('product.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search products...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <h3>Products</h3>
            <div class="row" id="product-list">
            @foreach ($products as $product)
    <div class="col-md-4 product-item" data-category-id="{{ $product->CategoryID }}">
        <div class="card mb-4">
            <img src="{{ asset('storage/' . $product->ImageURL) }}" class="card-img-top" alt="{{ $product->ProductName }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->ProductName }}</h5>
                <p class="card-text">{{ $product->Description }}</p>
                <p class="card-text"><strong>Price:</strong> {{ $product->Price }}</p>
                <a href="{{ route('product.show', $product->ProductID) }}" class="btn btn-primary">View Details</a>
              
               
                <form action="{{ route('cart.add', $product->ProductID) }}" method="POST" style="display:inline;">
                    @csrf
                    
                    <button type="submit" class="btn btn-success">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
@endforeach

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function filterProducts(categoryId) {
        // Hide all products
        document.querySelectorAll('.product-item').forEach(item => {
            item.style.display = 'none';
        });

        // Show products of the selected category
        document.querySelectorAll(`.product-item[data-category-id="${categoryId}"]`).forEach(item => {
            item.style.display = 'block';
        });
    }
</script>
@endsection
