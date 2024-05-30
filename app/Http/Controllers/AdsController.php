<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\User;
use App\Models\Owners;
use App\Models\JustificationCompitence;
use App\Models\DemandePub;
use App\Models\PieceJoint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AdsController extends Controller
{
    public function create()
    {
        return view('ads.create'); // Pass $owners to the view
    }
    

    public function store(Request $request)
    {
        // Find the authenticated user
        $user = Auth::user();
 
        if (!$user) {
            // Handle case when user is not authenticated
            return response()->json(['error' => 'Unauthorized'], 401);
        }
      
      

        // Validate request data
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'specialite' => 'required|string',
            'date' => 'required|date',
            'tel' => 'required|string', // Assuming 'tel' is also a required field
            'justification_compitences' => 'array',
            'piece_joints' => 'array', // Add piece_joints validation
            // Add more validation rules as needed
        ]);

        

        // Create or find the owner

        if($user->compte) {
        $owner = Owners::firstOrCreate(
            ['email' => $user->compte->email],
            ['name' => $user->name, 'prenom' => $user->prenom, 'tel' => $request->tel]
        );
    }else{

        $owner = Owners::firstOrCreate(
            ['email' => "guest"],
            ['name' => $user->name, 'prenom' => $user->prenom, 'tel' => $request->tel]
        );
    }
        // Create ad
        $ad = Ads::create([
            'description' => $request->description,
            'specialite' => $request->specialite,
            'date' => $request->date,
            'id_owner' => $owner->id,
            'user_id'=> $user->id,
           
      
        ]);
        //'user_id' =>Auth::user()->id,
        // Create demande pub
        if($user->compte) {
        $demandePub = DemandePub::create([
            'nom' => $user->name,
            'tel' => $request->tel,
            'email' => $user->compte->email,
            'description' => $request->description,
            'specialite' => $request->specialite,
            'ads_id' => $ad->id,
          
        ]);
    }  else{
        
        $demandePub = DemandePub::create([
            'nom' => $user->name,
            'tel' => $request->tel,
            'email' => "guest",
            'description' => $request->description,
            'specialite' => $request->specialite,
            'ads_id' => $ad->id,
          
        ]);
        }
    
        // Create justification compitences
        if ($request->has('justification_compitences')) {
            foreach ($request->justification_compitences as $description) {
                JustificationCompitence::create([
                    'description' => $description,
                    'iddemande' => $demandePub->id,
                ]);
            }
        }
       
        // Create piece joints
        if ($request->has('piece_joints')) {
            foreach ($request->piece_joints as $pieceJoint) {
                // Generate a unique filename
                $uniqueFilename = uniqid() . '/' . $pieceJoint->getClientOriginalName();
        
                PieceJoint::create([
                    // Store the file with a unique filename in the 'ads' directory
                    'lien' => $pieceJoint->storeAs('ads', $uniqueFilename, 'public'),
                    'type' => $pieceJoint->getClientOriginalExtension(),
                    'id_demande_pub' => $demandePub->id,
                ]);
            }

            
        }
        
    
        // Return success response
      //  return response()->json(['message' => 'Demande pub created successfully', 'ad' => $ad, 'demandePub' => $demandePub], 201);
        return back()->with('success', 'Demande ad created  successfully waiting now to active');
    }
    

public function listAds()
{
    // Fetch ads for the authenticated user
    $user = Auth::user();
    $user = User::find($user->id);

    // Access the user's ads
    $AdsAndDemandePub = $user->ads()->with('demandePub')->latest()->paginate(4);

    return view('ads.list_user_ads', compact('AdsAndDemandePub'));
}

public function List_demande_pub()
{
    // Query ads with demandePub relationships eager loaded and paginate the results
    $AdsAndDemandePub = Ads::with('demandePub')->latest()->paginate(4);

    return view('ads.list_users_demonde_pub', compact('AdsAndDemandePub'));
}



    public function delete($id)
    {
        $ad = Ads::find($id);

        if (!$ad) {
            return back()->with(['error' => 'Ad not found'], 404);
        }

        // Delete associated DemandePub
    if ($ad->demandePub) {
        $ad->demandePub->delete();
    }
        // Delete associated files
        if ($ad->dien) {
            Storage::disk('public')->delete($ad->dien);

            if ($ad->lien) {
                // sup file
                Storage::disk('public')->delete($ad->lien);
                // get folder of this file
                $directory = dirname($ad->lien);
                   if (Storage::disk('public')->exists($directory)) {
                    $files = Storage::disk('public')->files($directory);
                    if (empty($files)) {
                        Storage::disk('public')->deleteDirectory($directory);
                    }
                }
            }

        }

        // Delete the ad
        $ad->delete();
        

     
        return back()->with(['success' => 'Ad deleted successfully'], 200);
    }

    public function accept($id)
    {
        $ad = Ads::find($id);

        if (!$ad) {
            return back()->with(['error' => 'Ad not found'], 404);
        }
      
        // Update ad status to accepted
        $ad->demandePub->update(['accepted' => '1']);
        return back()->with('success', 'Demande ad accepted successfully');
    }
    
    public function indexlist_user_ads(Request $request)
    {
        
        $nmberPagination=10;
        $view = $request->query('view', 'all');
           // Fetch ads for the authenticated user
        $user = Auth::user();
        $user = User::find($user->id);


        if ($view === 'all') {
            $AdsAndDemandePub =  $user->ads()->with('demandePub', 'owner')->paginate($nmberPagination);
        } else {
            $AdsAndDemandePub =  $user->ads()->with('demandePub', 'owner')
                ->whereHas('demandePub', function ($query) use ($view) {
                    $query->where('accepted', $view === 'accepted');
                })
                ->paginate($nmberPagination);
        }
   
        return view('ads.list_user_ads', compact('AdsAndDemandePub'));
        
    }


    public function list_users_demonde_pub(Request $request)
    {
        
        $nmberPagination=10;
        $view = $request->query('view', 'all');
    
        if ($view === 'all') {
            $AdsAndDemandePub = Ads::with('demandePub', 'owner')->paginate($nmberPagination);
        } else {
            $AdsAndDemandePub = Ads::with('demandePub', 'owner')
                ->whereHas('demandePub', function ($query) use ($view) {
                    $query->where('accepted', $view === 'accepted');
                })
                ->paginate($nmberPagination);
        }
   
        return view('ads.list_users_demonde_pub', compact('AdsAndDemandePub'));
        
    }
 

    public function show(Request $request,$id)
    {
        // Retrieve the ad from the database using the ID
        $ad = Ads::findOrFail($id);
        $view = $request->input('view');
       
        // Paginate justificationCompitences
        $compitences = $ad->demandePub->justificationCompitences()->paginate(1, ['*'], 'compitencesPage');
        
        // Paginate pieceJoints
        $pieceJoints = $ad->demandePub->pieceJoints()->paginate(1, ['*'], 'pieceJointsPage');
    
        // Get the MIME type for each pieceJoint
        $mimeType = [];
    
        foreach ($ad->demandePub->pieceJoints as $pieceJoint) {
            // Specify the file path relative to the root directory of the storage disk
            $filePath = 'public/' . $pieceJoint->lien;
            
            // Check if the file exists
            if (File::exists(storage_path('app/' . $filePath))) {
                // Get the MIME type for the file using the File facade
                $mimeType[$pieceJoint->id] = File::mimeType(storage_path('app/' . $filePath));
            } else {
                // If the file does not exist, set a default MIME type or handle the case accordingly
                $mimeType[$pieceJoint->id] = 'application/octet-stream'; // Set a default MIME type
            }
        }
    
       // Pass the 'view' parameter received from the URL to the next page
    $view = request('view');

    return view('ads.demondepub_show', compact('ad', 'compitences', 'pieceJoints', 'mimeType', 'view'));
}
    
   
public function view_fileinCader($id)
{
   
    // Find the resource by its ID
    $PieceJoint = PieceJoint::findOrFail($id);

    // Check if the resource exists
    if (!$PieceJoint) {
        return response()->json(['message' => 'Resource not found'], 404);
    }

    // Specify the file path relative to the root directory of the storage disk
    $filePath = 'public/' . $PieceJoint->lien;

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
