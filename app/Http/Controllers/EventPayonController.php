<?php

namespace App\Http\Controllers;

use App\Models\EvenementPayent;
use App\Models\User;
use Illuminate\Http\Request;

class EventPayonController extends Controller
{
    public function index()
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
            'expere_id' => 'required|exists:experts,id',
        ]);

        EvenementPayent::create($request->all());

        return redirect()->back()->with('success', 'Event created successfully.');
    }

    
    public function participate(Request $request, $id)
    {
        // Find the event by its ID or throw a 404 error
        $event = EvenementPayent::findOrFail($id);
    
        // Get the authenticated user
        $user = User::findOrFail($request->user()->id);
    
        // Check if the user is already participating in the event
        if ($event->participants()->where('user_id', $user->id)->exists()) {
            return redirect()->route('events.index')->with('error', 'You are already participating in this event.');
        }
    
        // Check if the event is fully booked
        if ($event->participants()->count() >= $event->nbr_de_place) {
            return redirect()->route('events.index')->with('error', 'The event is fully booked.');
        }
    
        // Attach the user to the event's participants
        $event->participants()->attach($user->id);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Successfully registered for the event.');
    }
    
}

