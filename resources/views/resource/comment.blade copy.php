<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
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
        margin-left: 5%;/* Move the container to the right */
        max-width: 700px; /* Adjust max-width as needed */
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
                padding: 10px;
            }

            .well strong {
                color: #333333;
            }

            /* Delete button */
            .btn-danger {
                background-color: #d9534f;
                border-color: #d43f3a;
            }

            /* Add comment form */
            .add-comment-form {
                margin-top: 20px;
            }

            .add-comment-form h4 {
                margin-bottom: 10px;
                color: #333333;
            }

            .add-comment-form textarea {
                resize: vertical;
            }

            .add-comment-form .btn-primary {
                background-color: #337ab7;
                border-color: #2e6da4;
            }

            .add-comment-form .btn-primary:hover {
                background-color: #286090;
                border-color: #204d74;
            }
        </style>

        <div class="info-container">
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>
                <div class="panel-body">
                    <!-- Display existing comments -->
                    @foreach($comments as $comment)
                        <div class="well">
                            <div class="profile-photo">
                                @if($comment->user->image)
                                <img  src="{{ asset($comment->user->image) }}" alt="Click to Open Menu" id="menuImage">
                                 @else
                                 <img src="{{ asset('storage/profile/man/face.jpg') }}" alt="Click to Open Menu" id="menuImage">
                                 @endif
                            </div>
                            <strong>User: {{ $comment->user->name }}</strong><br>
                            {{ $comment->text }}
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs pull-right">Delete</button>
                            </form>
                        </div>
                    @endforeach

                    <!-- Add new comment form -->
                    <div class="well add-comment-form">
                        <h4>Add Comment</h4>
                        <form action="{{ route('comments.store', ['resource' => $resource->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="resource_id" value="{{ $resource->id }}">
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea class="form-control" id="comment" name="text" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Recent Updates section -->
    <x-slot name="recentUpdates">
        <!-- Add recent updates here -->
    </x-slot>

    <!-- List Course section -->
    <x-slot name="ListCoure">
        <!-- Add list of courses here -->
    </x-slot>
</x-dashboard-layout>
