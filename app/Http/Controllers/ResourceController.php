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
use Illuminate\Http\Response;


class ResourceController extends Controller
{
    
// work
public function index()
{
    // Get the authenticated user
    $user = Auth::user();
   
    // Check if the user exists
    if (!$user) { // if not a quest so we need use compte
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
    }

    // Retrieve all resources associated with the authenticated user
    $resources = $user->resources()->paginate(3); // Change 10 to the desired number of items per page
    

     // Generate file URLs for each resource
     foreach ($resources as $resource) {
        $resource->fileUrl = Storage::url($resource->lien);
    }

    $allresources = Resource::paginate(4);

    // Generate file URLs for each resource associated with the user
    foreach ($allresources as $resource) {
        $resource->fileUrl = Storage::url($resource->lien);
    }

    // Return both $resources and $allresources to the view
    return view('resource.dashboard', [
        'resources' => $resources,
        'allresources' => $allresources
    ]);
}

    // Method to delete a resource work
   // Method to delete a resource
    public function destroy($id)
    {
        // Find the resource by its ID
        $resource = Resource::find($id);

        // Check if the resource exists
        if (!$resource) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
      
 
       
             // Delete  derctory that will have file 
        if ($resource->lien) {
            // sup file
            Storage::disk('public')->delete($resource->lien);
            // get folder of this file
            $directory = dirname($resource->lien);
               if (Storage::disk('public')->exists($directory)) {
                $files = Storage::disk('public')->files($directory);
                if (empty($files)) {
                    Storage::disk('public')->deleteDirectory($directory);
                }
            }
        }
        // Delete the resource
        $resource->delete();

        // Redirect back with a success message
        // return redirect()->route('resource.index')->with('success', 'Resource deleted successfully');
    // Redirect back to the current page with a success message and hash fragment
return redirect()->back()->with('success', 'Resource deleted successfully');
 }

    


    

// work just boton for tak u to upate session
public function edit($id)
    {
        // Find the resource by its ID
        $resource = Resource::find($id);

        // Check if the resource exists
        if (!$resource) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        // Return the view with the resource data
        return view('resource.edit', compact('resource'));
    }

    // Method to update a resource work
    public function update(Request $request, $id)
    {
        // Find the resource by its ID
        $resource = Resource::find($id);
    
        // Check if the resource exists
        if (!$resource) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
    
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            // Add validation rules for other fields as needed
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Update the resource
        $resource->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            // Add other fields as needed
        ]);
    
        // Redirect back with a success message
        return redirect()->route('resource.index')->with('success', 'Resource updated successfully');
    }

//========================================================
    /// no test
    // Method to create a new resource
    public function store(Request $request)
{
    $user = Auth::user();
    
    // Check if the user exists
    if (!$user) {
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
    }

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'description' => 'required|string',
        'file' => ['nullable', 'file', 'mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/x-flv,video/x-ms-wmv,video/x-ms-asf,video/x-m4v,video/3gpp,video/x-matroska,application/pdf,image/jpeg,image/png,image/gif', 'max:20480'], // Allow video and PDF files with a maximum size of 20MB
        // Add validation rules for other fields as needed
    ]);
 
    // Process file upload if present
    $filePath = 'default_file.jpg'; // Default file path if no file is uploaded
    if ($request->hasFile('file')) {
        
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName(); // Get the original file name
        $uniqueFilename = uniqid() . '/' . $fileName;
        $filePath = $file->storeAs('file', $uniqueFilename, 'public'); // Store the file with its original name
   
    }

    Resource::create([
        'user_id'=> $user->id,
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'lien'=> $filePath,
        // Add other fields as needed
    ]);

    // Return a success response
    return redirect()->route('resource.index');
}




public function search(Request $request)
{
    $query = $request->input('query');
    $view = $request->input('view');

    // Query resources based on the search query and the type of resource view
    if ($view === 'my') {
        $userId = Auth::id(); // Get the authenticated user's ID
        $resources = Resource::where('user_id', $userId)
                             ->where(function($queryBuilder) use ($query) {
                                 $queryBuilder->where('name', 'like', "%$query%")
                                              ->orWhere('description', 'like', "%$query%");
                             })
                             ->paginate(3);
    } else {
        $resources = Resource::where('name', 'like', "%$query%")
                             ->orWhere('description', 'like', "%$query%")
                             ->paginate(3);
    }

    // Pass both $resources and $allresources to the view
    $allresources = $resources;

    // Return the search results to the view
    return view('resource.dashboard', compact('resources', 'query', 'allresources', 'view'));
}

public function viewFileshow($id)
{
    // Find the resource by its ID
    $resource = Resource::find($id);

    // Check if the resource exists
    if (!$resource) {
        return response()->json(['message' => 'Resource not found'], 404);
    }

// Specify the file path relative to the root directory of the storage disk
$filePath = 'public/' . $resource->lien;
// Get the file extension

// Get the file's MIME type
$mimeType = Storage::mimeType($filePath);
    return view('resource.view-file', compact('resource','mimeType'));
}





public function downloadFile($id)
    {
        // Find the resource by its ID
        $resource = Resource::find($id);

        // Check if the resource exists
        if (!$resource) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        // Specify the file path relative to the root directory of the storage disk
        $filePath = 'public/' . $resource->lien;

        // Check if the file exists
        if (!Storage::exists($filePath)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        // Get the file's MIME type
        $mimeType = Storage::mimeType($filePath);
    //    dd($mimeType);
        // Return the file as a downloadable response
        return response()->download(storage_path('app/' . $filePath), basename($filePath), [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
        ]);
    }
    
    
 
    
    
    
    public function view_fileinCader($id)
{
    // Find the resource by its ID
    $resource = Resource::find($id);

    // Check if the resource exists
    if (!$resource) {
        return response()->json(['message' => 'Resource not found'], 404);
    }

    // Specify the file path relative to the root directory of the storage disk
    $filePath = 'public/' . $resource->lien;

    // Check if the file exists
    if (!Storage::exists($filePath)) {
        return response()->json(['message' => 'File not found'], 404);
    }

    // Get the file's MIME type
    $mimeType = Storage::mimeType($filePath);

    // Set the correct headers
    $headers = [
        'Content-Type' => $mimeType,
    ];

    // Return the response with the correct headers
    return response()->file(storage_path('app/' . $filePath), $headers);
}

}