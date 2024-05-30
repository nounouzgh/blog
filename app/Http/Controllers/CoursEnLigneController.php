<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursEnLigne;
use App\Models\PreRequi;
use Illuminate\Support\Facades\Auth;

class CoursEnLigneController extends Controller
{
    public function create()
    {
        return view('cours_en_ligne.create');
    }


    // In your controller (e.g., CoursEnLigneController.php)

public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'event' => 'required',
        'description' => 'nullable',
        'date' => 'required',
        'duree' => 'required',
        'prix' => 'required|numeric',
        'specialite' => 'required',
        'prerequis' => 'required|array',
        'prerequis.*.description' => 'required',
    ]);

    // Check if the event already exists
    $existingEvent = CoursEnLigne::where('event', $request->event)->first();

    if ($existingEvent) {
        // If the event already exists, return a response indicating it
        return redirect()->back()->with('error', 'CoursEnLigne event already exists');
    }
    $user = Auth::user();
    if ($user->teacher) {
    // Create the CoursEnLigne event
    $coursEnLigne = CoursEnLigne::create($request->only([
        'event', 'description', 'date', 'duree', 'prix', 'specialite'
    ]));

 
        // Assign the teacher's ID to the teacher_id attribute
        $coursEnLigne->teacher_id = $user->teacher->id;

        // Save the new coursEnLigne to the database
        $coursEnLigne->save();

    // Create prerequisites if provided
    if ($request->has('prerequis')) {
        foreach ($request->input('prerequis') as $prerequiData) {
            PreRequi::create([
                'description' => $prerequiData['description'],
                'event_id' => $coursEnLigne->id,
        ]);
        }
    }

    return redirect()->back()->with(['success' => 'CoursEnLigne event created successfully'], 201);

    }
    else
    {
    return redirect()->back()->with(['success' => 'u can create it with ur curent role'], 201);
    }
}

public function listcoursEnLigne()
{
    $coursEnLigne = CoursEnLigne::paginate(3);
    return view('cours_en_ligne.List', compact('coursEnLigne'));
}
}
