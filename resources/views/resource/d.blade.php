
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
                                <a href="{{ route('resource.view-file', $resource->id) }}" class="btn btn-secondary btn-sm btn-3d mr-1"><span class="material-symbols-outlined">visibility</span></a>
                                <a href="{{ route('comments.show', ['resourceId' => $resource->id]) }}" class="btn btn-primary btn-sm btn-3d"><span class="material-symbols-outlined">comment</span></a>
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