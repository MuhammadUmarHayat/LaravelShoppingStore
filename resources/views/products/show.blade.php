@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->ProductName }}</h1>
    <img src="{{ asset('storage/' . $product->ImageURL) }}" class="img-fluid" alt="{{ $product->ProductName }}">
    <p>{{ $product->Description }}</p>
    <p><strong>Price:</strong> {{ $product->price }}</p>
    <form action="{{ route('cart.add', $product->ProductID) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Add to Cart</button>
    </form>
</div>
@endsection
