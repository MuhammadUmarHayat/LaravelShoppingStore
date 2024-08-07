@extends('../layouts.app')

@section('content')
<div class="container">
    <h1>Create New User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('store_user') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password"  class="form-control" name="password_confirmation" placeholder="Password again" required>
        </div>
        <input type="hidden" name="role" value="admin">
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
