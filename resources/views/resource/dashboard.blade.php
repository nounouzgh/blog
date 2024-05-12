<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
  
        <div class="info-container">
            <div class="my-resource" >
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Creation Resource') }}</div>
                        <div class="card-body">
                            <!-- Form for creating a new resource (Initially hidden) -->
                            <form method="POST" action="{{ route('resource.store') }}" id="createForm" enctype="multipart/form-data" class="create-resource-form">
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
                                    <input type="file" name="file" id="file" class="form-control-file @error('file') is-invalid @enderror" accept="image/jpeg, image/png, image/gif, application/pdf, audio/*, video/*" required>
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Create Resource') }}</button>
                            </form>
                            <!-- End of creation form -->
                        </div>
                    </div>
                </div>
            </div>

               <!-- Search Bar -->
               <div class="search-container">
                <form action="{{ route('resource.search') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" id="searchInput" name="query" class="form-control" placeholder="Search resources...">
                        <input type="hidden" name="view" value="my">
                    </div>
                </form>
                
              
            </div>
            <!-- Table to display existing resources -->
            <div class="table-container">
                <table class="table table-3d">
                    <thead>
                     
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Lien</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($resources as $resource)
                            <tr>
                                <td>{{ $resource->name }}</td>
                                <td>{{ $resource->description }}</td>
                                <td>{{ $resource->lien }}</td>
                                <td>
                                    <div class="btn-group d-flex" role="group" style="white-space: nowrap;">
                                        <!-- Delete Resource Button -->
                                   
                                        <!-- Edit Resource Button -->
                                        <a href="{{ route('resource.edit', $resource->id) }}" class="btn btn-primary btn-sm btn-3d mr-1"><span class="material-symbols-outlined">upgrade</span></a>
                                        <!-- View File 2 Button -->
                                        <a href="{{ route('resource.viewFileshow', ['id' => $resource->id]) }}" class="btn btn-secondary btn-sm btn-3d mr-1">
                                            <span class="material-symbols-outlined">visibility</span>
                                        </a>
c                                        
                                        <a href="{{ route('comments.show', ['resourceId' => $resource->id]) }}" class="btn btn-primary btn-sm btn-3d"><span class="material-symbols-outlined">comment</span>
                                            <span class="message-count">{{ $resource->comments->count() }}</span>      </a>
                                        <a href="{{ route('resource.download', ['id' => $resource->id]) }}" class="btn btn-primary btn-sm btn-3d"><span class="material-symbols-outlined">download</span></a>
                                        <a><form action="{{ route('resource.destroy', $resource->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-3d mr-1"><span class="material-symbols-outlined">delete</span></button>
                                        </form> </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No resources found.</td>
                            </tr>
                        @endforelse
                    <tr></tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links -->
            @if ($resources->hasPages())
            <div class="pagination" style="margin-top: 20px; margin-bottom: 20px; text-align: center;">
                <ul class="pagination-list" style="display: inline-flex; list-style: none; padding: 0; margin: 0;">
                    {{-- Previous Page Link --}}
                    @if ($resources->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $resources->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                        </li>
                    @endif

                    {{-- Page Numbers --}}
                    @php
                        $start = max(1, $resources->currentPage() - 2);
                        $end = min($start + 4, $resources->lastPage());
                    @endphp
                    @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item {{ $i == $resources->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $resources->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Next Page Link --}}
                    @if ($resources->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $resources->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link">Next</span>
                        </li>
                    @endif

                    {{-- Last Page Link --}}
                    @if ($resources->currentPage() < $resources->lastPage() - 2)
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ $resources->url($resources->lastPage()) }}">{{ $resources->lastPage() }}</a>
                        </li>
                    @endif
                </ul>
                
                <div class="pagination-info" style="margin-top: 10px; text-align: center; margin-bottom: 20px;">
                    <p>Page {{ $resources->currentPage() }} of {{ $resources->lastPage() }} - Showing {{ $resources->firstItem() }} to {{ $resources->lastItem() }} of {{ $resources->total() }} results</p>
                </div>
            </div>
            @endif
            <!-- End of resource table -->
        </div>
        <div class="all-resource"  >
            <x-ListAnnounce :resources="$allresources" />
        </div>
    </div>
    </x-slot>

</x-dashboard-layout>

<!-- Script for toggling form visibility -->
<script>
    // hid element by defautlt need this for when i call from side bare  to hid all div that need be hid
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle form visibility
        const toggleButton = document.getElementById('toggleForm');
        const createForm = document.getElementById('createForm');

        toggleButton.addEventListener('click', function () {
            createForm.classList.toggle('d-none');
        });
    });
</script>

<script>
    // this one is show proper div after i call controler sharch
    document.addEventListener('DOMContentLoaded2', function() {
        // Get the value of the 'view' parameter from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const viewParam = urlParams.get('view');

        // Select the div element
        const allResourceDiv = document.querySelector('.all-resource');
        const myResourceDiv = document.querySelector('.my-resource');
        // If the 'view' parameter is not set or it's not equal to 'all', hide the div
        if (!viewParam || viewParam !== 'all') {
            allResourceDiv.style.display = 'none';
        }
        if (!viewParam || viewParam !== 'my') {
            myResourceDiv.style.display = 'none';
        }
    });
</script>

<!-- Styles -->
<style>
    .insights {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f2f2f2;
        width: 400%; /* Set width to 100% */
        height: 100%; /* Set height to 100% */
    }

    .info-container {
        width: 95%; /* Set width to 100% */
        height: 95%; /* Set height to 100% */
        margin-left: 5%; /* Move the container to the right */
        max-width: 730px; /* Adjust max-width as needed */
        align-items: center;
        padding: 20px;
        background-color: white;
        border: 1px solid #ccc;
        box-sizing: border-box; /* Include padding and border in width and height calculations */
    }

    .create-resource-form .form-group {
        margin-bottom: 20px;
    }

    .create-resource-form label {
        font-weight: bold;
    }

    .create-resource-form input[type="text"],
    .create-resource-form textarea,
    .create-resource-form input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .create-resource-form button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .create-resource-form button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .table-container {
        overflow-x: auto;
    }

    .table-3d {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }

    .table-3d th,
    .table-3d td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
        background-color: #f2f2f2;
    }

    .table-3d th {
        background-color: #007bff;
        color: white;
    }

    .table-3d tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table-3d th,
    .table-3d td {
        transition: all 0.3s;
    }

    .btn-3d {
        padding: 6px 12px; /* Updated padding */
        border: 1px solid #007bff; /* Added border */
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px; /* Updated font size */
    }

    .btn-3d:hover {
        background-color: #0056b3;
        color: white;
    }

    /* Pagination styles */
    .pagination-list {
        display: inline-flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .page-item {
        margin-right: 5px; /* Adjust spacing between pagination items */
    }

    .page-link {
        display: inline-block;
        padding: 5px 10px; /* Adjust padding as needed */
        text-decoration: none;
        color: #007bff; /* Link color */
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
    }

    .page-link:hover {
        color: #0056b3; /* Hover color */
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .page-item.disabled .page-link {
        pointer-events: none;
        cursor: not-allowed;
        color: #6c757d;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .page-item.active .page-link {
        color: #fff;
        background-color: #007bff; /* Active background color */
        border-color: #007bff;
    }

    .search-container {
        margin-top: 1%;
    margin-bottom: 2px;
  }
  .search-container input[type=text] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-size: 16px;
    background-color: #f8f8f8;
    transition: border-color 0.3s ease-in-out;
  }
  .search-container input[type=text]:focus {
    outline: none;
    border-color: #66afe9;
    box-shadow: 0 0 5px #66afe9;
  }
  tr:hover td {
    background-color: #e0e0e0;
  }
  .btn-group.d-flex {
        display: flex; /* Use flexbox layout */
        flex-wrap: nowrap; /* Prevent wrapping to next line */
        justify-content: flex-start; /* Align items to the start of the container */
    }

    .btn-group.d-flex .btn,
    .btn-group.d-flex form {
        margin-right: 5px; /* Add margin between buttons */
    }
</style>
