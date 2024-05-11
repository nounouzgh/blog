<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\ResourceSignal;

class SignalResourceController extends Controller
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
    
    // Load signals for the resource with pagination
    $signals = $resource->signals()->paginate(3); // Change 3 to your desired number of items per page
    
  
    // Return the view with resource and signals
    return view('resource.signal', compact('resource', 'signals'));
}


    
public function store(Request $request, $id)
{
    // Get the authenticated user
    $user = $request->user();
    $userId = $user->id;

    // Validate the request
    $validator = Validator::make($request->all(), [
        'cause' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    // Find the resource
    $resource = Resource::findOrFail($id);

    // Create a new signal
    $signal = new ResourceSignal();
    $signal->user_id = $userId;
    $signal->resource_id = $resource->id;
    $signal->cause = $request->cause;
    $signal->date = now(); // Set the date to the current system date and time
    $signal->save();

    // Update the resource signals count
    $resource->increment('nbr_signal');

    // You don't need to return 'resource' here unless you need it for some specific purpose
    
// Redirect to the resource show page
return redirect()->route('resource.signal.show', ['resourceId' => $resource->id]);
}

}
