<div class="recent-order">
    <h2>List Announce</h2>
        <!-- Search Bar -->
        <div class="search-container">
            <form action="{{ route('resource.search') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" id="searchInput" name="query" class="form-control" placeholder="Search resources...">
                    <input type="hidden" name="view" value="all">
                </div>
            </form>

            
        </div>
    <!-- Table to display existing resources -->
    <div class="table-container">
        <table class="table table-3d">
        <thead>
            <tr>
                <th>icon</th>
                <th>User name </th>
                <th>Role</th>
                <th>Resource Name</th>
                <th>Resource description</th>
                <th>Resource lien</th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($resources as $resource)
            <tr>
                <td>  <div class="profile-photo">
                    @if($resource->user->image)
                    <img  src="{{ asset($resource->user->image) }}" alt="Click to Open Menu" id="menuImage">
                     @else
                     <img src="{{ asset('storage/profile/man/face.jpg') }}" alt="Click to Open Menu" id="menuImage">
                     @endif
                </div></td>
                <td>{{ $resource->user->name }}</td>
                <td>{{ $resource->user->role->name }}</td>
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
                    </div>
                </td>
                <td colspan="3"></td>
            </tr>
    
            @empty
            <tr>
                <td colspan="3">No resources found.</td>
                <td colspan="3"></td>
                <td colspan="3"></td>
            </tr>
 
            @endforelse
            <tr></tr>
        </tbody>
     
    </table>
    
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

   
</div>
<style>



    .table-container {
        overflow-x: auto;
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