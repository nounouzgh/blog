@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>

                <div class="panel-body">
                    <!-- Display existing comments -->
                    @php
                        // Get the authenticated user
                        $user = Auth::user();

                        // If the user is not authenticated, check if it's a guest
                        if (!$user) {
                            // If not a guest, we need to use compte
                            $compte = Auth::guard('compte')->user();
                            $user = $compte->user;
                        }
                    @endphp
                    @foreach($comments as $comment)
                        <div class="well">
                            <strong>User: {{ $user->name }}</strong><br>
                            {{ $comment->text }}
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs pull-right">Delete</button>
                            </form>
                        </div>
                    @endforeach

                    <!-- Add new comment form -->
                    <div class="well">
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
    </div>
</div>
@endsection
