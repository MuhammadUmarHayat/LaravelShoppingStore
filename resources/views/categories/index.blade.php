@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered mt-4">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
        
        @foreach ($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->CategoryName }}</td>
                <td>{{ $cat->Description }}</td>
                <td>
                    @if($cat->ImageURL)
                        <img src="{{ asset('storage/' . $cat->ImageURL) }}" alt="{{ $cat->CategoryName }}" style="max-width: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <a href="{{ route('categories.show', $cat->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-primary">Edit</a>
                    <button class="btn btn-danger" onclick="confirmDelete({{ $cat->id }})">Delete</button>
                    
                    <form id="delete-form-{{ $cat->id }}" action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this category?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let categoryIdToDelete = null;

    function confirmDelete(categoryId) {
        categoryIdToDelete = categoryId;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
            keyboard: false
        });
        deleteModal.show();
    }

    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
        if (categoryIdToDelete) {
            document.getElementById('delete-form-' + categoryIdToDelete).submit();
        }
    });
</script>
@endsection
