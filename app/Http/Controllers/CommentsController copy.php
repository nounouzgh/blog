<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resource;

class CommentsController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($resourceId)
    {
        // Load the resource
        $resource = Resource::findOrFail($resourceId);
    
        // Load comments for the resource
        $comments = $resource->comments;
    
        return view('resource.comment', compact('resource', 'comments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'text' => 'required',
        'resource_id' => 'required|exists:resources,id', // Ensure that the resource_id exists in the resources table
    ]);

    // Create a new comment instance
    $comment = new Comment();

    // Set the comment text
    $comment->text = $request->text;

    // Set the resource_id from the request
    $comment->resource_id = $request->resource_id;

    // Get the authenticated user
    $user = Auth::user();

    // If the user is not authenticated, check if it's a guest
    if (!$user) {
        // If not a guest, we need to use compte
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
    }

    // Associate the authenticated user's ID with the comment
    $comment->user_id = $user->id;

    // Save the comment
    $comment->save();

    // Redirect to the resource show page
    return redirect()->route('comments.show', $request->resource_id);
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Find the comment by its ID
    $comment = Comment::findOrFail($id);
    
    // Get the authenticated user
    $user = Auth::user();

    // If the user is not authenticated, check if they exist via the 'compte' guard
    if (!$user) {
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
    }

    // Check if the authenticated user is authorized to delete the comment
    if ($user && $comment->user_id == $user->id) {
        // If authorized, delete the comment
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    // If not authorized, redirect back with an error message
    return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
}

}
