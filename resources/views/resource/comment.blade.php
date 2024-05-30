<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <style>
            /* Main container styling */
            .insights {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f2f2f2;
                width: 300%; /* Set width to 100% */
                height: 100%; /* Set height to 100% */
                max-width: 750px; /* Adjust max-width as needed */
            }

            /* Container for the entire dashboard layout */
            .x-dashboard-layout {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 20px;
            }

            .info-container {
                margin-left: 5%; /* Move the container to the right */
                width: 300%; /* Set width to 100% */
                height: 100%; /* Set height to 100% */
                max-width: 750px; /* Adjust max-width as needed */
                align-items: center;
                padding: 20px;
                background-color: white;
                border: 1px solid #ccc;
                box-sizing: border-box; /* Include padding and border in width and height calculations */
            }

            /* Panel styling */
            .panel {
                margin-bottom: 20px;
                border: 1px solid #dddddd;
                border-radius: 5px;
            }

            .panel-heading {
                background-color: #f5f5f5;
                padding: 10px;
                border-bottom: 1px solid #dddddd;
            }

            .panel-body {
                padding: 15px;
            }

            /* Styling for comments */
            .well {
                margin-bottom: 15px;
                background-color: #f9f9f9;
                border: 1px solid #dddddd;
                border-radius: 5px;
                padding: 15px;
                position: relative;
            }

            .well strong {
                color: #333333;
                font-size: 16px;
            }

            .well .profile-photo {
                position: absolute;
                top: 15px;
                right: 15px;
            }

            .well .profile-photo img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
            }

            /* Delete button */
           /* Delete button */
.btn-delete {
    position: absolute;
    top: auto;
    right: auto;
    background-color: #dc3545; /* Red color for delete button */
    border-color: #dc3545;
    color: #fff; /* Text color */
    padding: 4px 8px; /* Adjust padding */
    border-radius: 5px; /* Rounded corners */
    font-size: 8px; /* Font size */
    transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease; /* Smooth transition */
    z-index: 10000; /* Adjust the z-index value as needed */
}

.btn-delete:hover {
    background-color: #c82333; /* Darker red color on hover */
    border-color: #bd2130;
    color: #fff; /* Text color */
}


            /* Add comment form */
            .add-comment-form {
                margin-top: 20px;
            }

            .add-comment-form h4 {
                margin-bottom: 10px;
                color: #333333;
                font-size: 18px;
            }

            .add-comment-form textarea {
                resize: vertical;
                height: 100px;
                border-radius: 5px; /* Rounded corners */
                border: 1px solid #ccc; /* Border color */
                padding: 10px; /* Padding inside the textarea */
                font-size: 16px; /* Font size */
                width: 100%; /* Full width */
                box-sizing: border-box; /* Include padding and border in width and height calculations */
            }

            .add-comment-form .btn-primary {
                background-color: #337ab7;
                border-color: #2e6da4;
                color: #ffffff; /* Text color */
                padding: 10px 20px; /* Padding */
                border-radius: 5px; /* Rounded corners */
                cursor: pointer; /* Cursor on hover */
                transition: background-color 0.3s ease; /* Smooth transition */
            }

            .add-comment-form .btn-primary:hover {
                background-color: #286090; /* Darker background color on hover */
            }
        </style>

        <div class="insights">
            <div class="info-container">
                <div class="panel panel-default">
                    <div class="panel-heading">Comments</div>
                    <div class="panel-body">
                        <!-- Display existing comments -->
                        @foreach($comments as $comment)
                            <div class="well">
                                <div class="profile-photo">
                                    @if($comment->user->image)
                                        <img src="{{ asset($comment->user->image) }}" alt="User Profile Photo">
                                    @else
                                        <img src="{{ asset('storage/profile/man/face.jpg') }}" alt="Default Profile Photo">
                                    @endif
                                </div>
                                <strong>User: {{ $comment->user->name }}</strong><br>
                                {{ $comment->text }}
                                @if(auth()->user()->role->name == "admin")
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                </form>
                            @endif
                            
                      
                            </div>
                        @endforeach

                        <!-- Add new comment form -->
                        <div class="well add-comment-form">
                            <h4>Add Comment</h4>
                            <form action="{{ route('comments.store', ['resource' => $resource->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="resource_id" value="{{ $resource->id }}">
                                <div class="form-group">
                                    <textarea class="form-control" id="comment" name="text" rows="3" placeholder="Write your comment here..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        
     <!-- Pagination Links -->
@if ($comments->hasPages())
<div class="pagination" style="margin-top: 20px; margin-bottom: 20px; text-align: center;">
    <ul class="pagination-list" style="display: inline-flex; list-style: none; padding: 0; margin: 0;">
        {{-- First Page Link --}}
        <li class="page-item {{ $comments->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $comments->url(1) }}">First</a>
        </li>

        {{-- Previous Page Link --}}
        @if ($comments->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $comments->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @php
            $start = max(1, $comments->currentPage() - 2);
            $end = min($start + 4, $comments->lastPage());
        @endphp
        @for ($i = $start; $i <= $end; $i++)
            <li class="page-item {{ $i == $comments->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $comments->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Next Page Link --}}
        @if ($comments->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $comments->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link">Next</span>
            </li>
        @endif

        {{-- Last Page Link --}}
        <li class="page-item {{ $comments->currentPage() == $comments->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $comments->url($comments->lastPage()) }}">Last</a>
        </li>
    </ul>

    <div class="pagination-info" style="margin-top: 10px; text-align: center; margin-bottom: 20px;">
        <p>Page {{ $comments->currentPage() }} of {{ $comments->lastPage() }} - Showing {{ $comments->firstItem() }} to {{ $comments->lastItem() }} of {{ $comments->total() }} results</p>
    </div>
</div>
@endif

                    </div>
                </div>
            </div>
        </div>

    </x-slot>

</x-dashboard-layout>

<style>
   
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
        border-color: #07ad39;
        font-size: 15px; /* Adjust the font size as needed */
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
    .pagination {
    z-index: 9999;
}
</style>
