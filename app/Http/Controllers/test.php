<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resource; // Make sure to import the Resource model at the top
use Illuminate\Support\Facades\Storage;

class test extends Controller
{
    public function index()
    {
          // Retrieve all resources from the database
    $resources = Resource::paginate(3); // Change 3 to the desired number of items per page

    // Generate file URLs for each resource
    foreach ($resources as $resource) {
        $resource->fileUrl = Storage::url($resource->lien);
    }

    // Return the resources to the view
    return view('1to call back if err.dashboard', ['resources' => $resources]);
}
    }



