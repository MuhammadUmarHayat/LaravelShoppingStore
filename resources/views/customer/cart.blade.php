@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @php
        $cart = session()->get('cart', []);
    @endphp

    @if ($cart && count($cart) > 0)
        <div class="row">
            @foreach ($cart as $email => $items)
                @foreach ($items as $item)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['name'] }}</h5>
                                <p class="card-text"><strong>Price:</strong> ${{ $item['price'] }}</p>
                                <p class="card-text"><strong>Customer:</strong> {{ $item['email'] }}</p>
                                <p class="card-text"><strong>Quantity:</strong> {{ $item['quantity'] }}</p>
                                <p class="card-text"><strong>Product Number:</strong> {{ $item['id'] }}</p>
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="mb-2">
                                    @csrf
                                    <div class="input-group">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{ route('cart.delete', $item['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif

    <h3>Total Price: ${{ $total['totalPrice'] }}</h3>
</div>
@endsection
