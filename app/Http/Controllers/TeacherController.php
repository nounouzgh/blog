<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Supervisor;
use App\Models\User;
use App\Models\Compte;
use App\Models\Teacher; // Import the Teacher model if not already imported
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request; // Add this line at the top of your file


class TeacherController extends Controller
{
    // edit work

    public function show($id)
{
    // Retrieve the teacher, user, and compte based on the ID
    $teacher = Teacher::findOrFail($id);
    $user = $teacher->user;
    $compte = $user->compte;

    // Return the view to display teacher information
    return view('teacher.profile', compact('teacher', 'user', 'compte'));
}





    public function edit()
{
    // Retrieve the compte with its associated user and student for editing



    $compte = Auth::guard('compte')->user();
    $user = $compte->user;
    $teacher = $user->teacher;
    $editing = false;
    return view('teacher.profile', compact('teacher', 'user', 'compte', 'editing'));
}
public function update(Request $request)
{
    // Retrieve the authenticated compte and its associated user
    $compte = Auth::guard('compte')->user();
    $user = $compte->user;

    // Retrieve the teacher associated with the authenticated user
    $teacher = $user->teacher;

    // Update the teacher's information
    $teacher->update([
        'specialite' => $request->input('specialite'),
        'grade' => $request->input('grade'),
        // Add other fields here as necessary
    ]);

    // Update the user's information
    $user->update([
        'name' => $request->input('user_name'),
        'prenom' => $request->input('user_prenom'), // Make sure this line is correct
        'email' => $request->input('user_email'),
        // Add other fields here as necessary
    ]);

    // Redirect back to the teacher's profile page
    return redirect()->route('teacher.profile.edit')->with('success', 'Teacher information updated successfully');
}



public function destroy()
{

        // Retrieve the authenticated compte and its associated user
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
        // Retrieve the student associated with the authenticated user
        $teacher = $user->teacher;

        Auth::guard('compte')->logout();
     
        $this->performDeletionteacher($compte, $user,$teacher);
        
        // Redirect to a relevant page after deletion
        return redirect()->route('welcome')->with('success', 'Your account has been deleted successfully');
    
    }

 /**
     * Perform the deletion of the compte and related records.
     *
     * @param Compte $compte
     * @return bool
     */
    protected function performDeletionteacher(Compte $compte,User $user,Teacher $teacher)
    {
         // If a student exists, delete it
         if ($teacher) {
            $teacher->delete();
        }

        // Delete the user
        if ($user) {
            $user->delete();
        }

        if ($compte) {
        return $compte->delete();
    }
}
  
}

