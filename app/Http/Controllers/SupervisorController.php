<?php

namespace App\Http\Controllers; // Correct namespace

use App\Models\Supervisor;
use App\Models\User;
use App\Models\Compte;
use App\Models\Teacher; // Import the Teacher model if not already imported
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request; // Add this line at the top of your file

class SupervisorController extends Controller
{
    public function show($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        $user = $supervisor->user;
        $compte = $user->compte;

        return view('supervisor.profile', compact('supervisor', 'user', 'compte'));
    }

    public function edit()
    {
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
        $supervisor = $user->supervisor;
        $editing = false;

        return view('supervisor.profile', compact('supervisor', 'user', 'compte', 'editing'));
    }

    public function update(Request $request)
    {
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
        $supervisor = $user->supervisor;

        $supervisor->update([
            
            'specialite' => $request->input('specialite'),
            // Add other fields here as necessary
        ]);

        $user->update([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            // Add other fields here as necessary
        ]);

        return redirect()->route('supervisor.profile.edit')->with('success', 'Supervisor information updated successfully');
    }

    public function destroy()
    {
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
        $supervisor = $user->supervisor;
        Auth::guard('compte')->logout();
     
        $this->performDeletionSupervisor($compte, $user, $supervisor);
        
        return redirect()->route('welcome')->with('success', 'Your account has been deleted successfully');
    }

    protected function performDeletionSupervisor(Compte $compte, User $user, Supervisor $supervisor)
    {
        if ($supervisor) {
            $supervisor->delete();
        }

        if ($user) {
            $user->delete();
        }

        if ($compte) {
            return $compte->delete();
        }
    }
}
