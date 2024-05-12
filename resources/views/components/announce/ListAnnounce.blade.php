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
                    <img  src="{{ asset($resource->user->image) }}">
                     @else
                     <img src="{{ asset('storage/profile/man/face.jpg') }}">
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
                        
                        @if($resource->user->id === auth()->user()->id)
                        <a href="{{ route('resource.edit', $resource->id) }}" class="btn btn-primary btn-sm btn-3d mr-1">
                            <span class="material-symbols-outlined">upgrade</span>
                        </a>
                          @endif
                        <!-- View File 2 Button -->
                        <a href="{{ route('resource.viewFileshow', $resource->id) }}" class="btn btn-secondary btn-sm btn-3d mr-1"><span class="material-symbols-outlined">visibility</span></a>
                        <a href="{{ route('comments.show', ['resourceId' => $resource->id]) }}" class="btn btn-primary btn-sm btn-3d"><span class="material-symbols-outlined">comment</span>
                            <span class="message-count">{{ $resource->comments->count() }}</span>      </a>
                        <a href="{{ route('resource.download', ['id' => $resource->id]) }}" class="btn btn-primary btn-sm btn-3d"><span class="material-symbols-outlined">download</span></a>
                        <a href="{{ route('resource.signal.show', ['resourceId' => $resource->id]) }}" class="btn btn-primary btn-sm btn-3d"> <span class="material-symbols-outlined">report</span>
                            <span class="message-count">{{ $resource->nbr_signal }}</span>          
                        </a>
                  
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
      <x-pagination :paginator="$resources" />
   
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