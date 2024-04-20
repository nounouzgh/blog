<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
  
    public function show($id)
{
    // Retrieve the student, user, and compte based on the ID
    $Admin = Admin::findOrFail($id);
    $compte = $Admin->compte;

    // Return the view to display student information
    return view('admin.profile', compact('admin','compte'));
}


    public function edit()
{
    // Retrieve the compte with its associated user and student for editing



    $compte = Auth::guard('compte')->user();
    $admin = $compte->admin;
    $editing = false;
    return view('admin.profile', compact('admin','compte', 'editing'));
}


public function update(Request $request)
{
    // Retrieve the authenticated compte and its associated user
    $compte = Auth::guard('compte')->user();
    $admin = $compte->admin;

    // Update the user's information
    $admin->update([
        'name' => $request->input('name'),
        'prenom' => $request->input('prenom'),
        // Add other fields here as necessary
    ]);

    // Redirect back to the student's profile page
    return redirect()->route('admin.profile.edit')->with('success', 'admin information updated successfully');
}

public function destroy()
{

        // Retrieve the authenticated compte and its associated user
        $compte = Auth::guard('compte')->user();
        $admin = $compte->admin;
 
        Auth::guard('compte')->logout();
     
        $this->performDeletionstudent($compte, $admin);
        
        // Redirect to a relevant page after deletion
        return redirect()->route('welcome')->with('success', 'Your account has been deleted successfully');
    
    }

 /**
     * Perform the deletion of the compte and related records.
     *
     * @param Compte $compte
     * @return bool
     */
    protected function performDeletionstudent(Compte $compte,Admin $admin)
    {


        // Delete the user
        if ($admin) {
            $admin->delete();
        }

        if ($compte) {
        return $compte->delete();
    }
}
  
}
