<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\User;
use App\Models\Compte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
class ExpertController extends Controller
{
    public function show($id)
    {
        $expert = Expert::findOrFail($id);
        $user = $expert->user;
        $compte = $user->compte;

        return view('expert.profile', compact('expert', 'user', 'compte'));
    }
    
    public function edit()
    {
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
        $expert = $user->expert;
        $editing = true;

        return view('expert.profile', compact('expert', 'user', 'compte', 'editing'));
    }

    public function update(Request $request)
    {
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
        $expert = $user->expert;

        $expert->update([
            'specialite' => $request->input('specialite'),
            // Add other fields here as necessary
        ]);

        $user->update([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            // Add other fields here as necessary
        ]);

        return redirect()->route('expert.profile.edit')->with('success', 'Expert information updated successfully');
    }

    public function destroy()
    {
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
        $expert = $user->expert;

        Auth::guard('compte')->logout();
     
        $this->performDeletionExpert($compte, $user, $expert);
        
        return redirect()->route('welcome')->with('success', 'Your account has been deleted successfully');
    }

    protected function performDeletionExpert(Compte $compte, User $user, Expert $expert)
    {
        if ($expert) {
            $expert->delete();
        }

        if ($user) {
            $user->delete();
        }

        if ($compte) {
            return $compte->delete();
        }
    }
}
