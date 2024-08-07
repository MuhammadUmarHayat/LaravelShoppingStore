@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->CategoryName }}</h1>
    <p>{{ $category->Description }}</p>
    <p>
    @if($category->ImageURL)
                        <img src="{{ asset('storage/' . $category->ImageURL) }}" alt="{{ $category->CategoryName }}" style="max-width: 100px;">
                    @else
                        No Image
                    @endif
</p>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection

