@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All Resources') }}</div>

                <div class="card-body">
       
                    <!-- Form for creating a new resource (Initially hidden) -->
                    <form method="POST" action="{{ route('resource.store') }}" id="createForm" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="file" class="block mb-2 text-sm font-medium">File</label>
                            <input type="file" name="file" id="file" class="form-control-file @error('file') is-invalid @enderror" accept="image/jpeg, image/png, image/gif, application/pdf" required>
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">{{ __('Create Resource') }}</button>
                    </form>
                    <!-- End of creation form -->

                    <hr>

         <!-- Table to display existing resources -->
<table class="table">
    <thead>
        <!-- Search Bar -->
        <form action="{{ route('resource.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Search resources...">

            </div>
        </form>
        <tr>
            <th>             Name                            </th>
            <th>              Description                    </th>
            <th>              lien                    </th>
            <th>              Actions          </th>
            
        </tr>
    </thead>
    <tbody>
        @forelse($resources as $resource)
        <tr>
            <td>{{ $resource->name }}</td>
            <td>{{ $resource->description }}</td>
            <td>{{ $resource->lien }}</td>
            <td>
                <!-- Delete Resource Button -->
                <form action="{{ route('resource.destroy', $resource->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                <!-- Edit Resource Button -->
                <a href="{{ route('resource.edit', $resource->id) }}" class="btn btn-primary btn-sm">Edit</a>
              <!-- View File Button -->
              <a href="{{ $resource->fileUrl }}" target="_blank" class="btn btn-secondary btn-sm">View File</a>
              <a href="{{ route('comments.show', ['resourceId' => $resource->id]) }}" class="btn btn-primary btn-sm">comments</a>
            </tr>

        @empty
        <tr>
            <td colspan="3">No resources found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

                </div>
                 <!-- Pagination Links -->
 {{ $resources->links() }}
 <!-- End of resource table -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle form visibility
        const toggleButton = document.getElementById('toggleForm');
        const createForm = document.getElementById('createForm');

        toggleButton.addEventListener('click', function () {
            createForm.classList.toggle('d-none');
        });
    });
</script>
@endsection
