<?php

namespace App\Http\Controllers;

use App\Models\EvenementPayent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventPayonController extends Controller
{
    public function create()
    {
  
        return view('Evenement.create');
      
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'duree' => 'required|integer',
            'prix' => 'required|numeric',
            'specialite' => 'required|string|max:255',
            'nbr_de_place' => 'required|integer',
        
        ]);

        $evenementPayment = EvenementPayent::create($request->all());
        
        $authenticatedUser = Auth::user();
        if ($authenticatedUser && $authenticatedUser->expert) {
            $evenementPayment->expere_id = $authenticatedUser->expert->id;
        }
        
        // Save the EvenementPayent instance
        $evenementPayment->save();

        return redirect()->back()->with('success', 'Event created successfully.');
    }

    
    public function ListEvents()
    {
                // Paginate the events with 10 events per page
    $events = EvenementPayent::paginate(6);

    return view('Evenement.ListEvent', compact('events'));
    }
   
    

}

