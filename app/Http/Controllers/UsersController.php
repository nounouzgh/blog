<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Compte;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
      
    public function listUsers()
    {
        $users = User::latest()->paginate(4); // Retrieve users sorted by creation date in descending order and paginate with 4 users per page
    
        return view('user.users', ['users' => $users]); // Pass the paginated users to the view
    }
    

    public function delete($idcompte)
{
    $compte = Auth::guard('compte')->user();
    $user = $compte->user;
  
       // Retrieve the user's compte by ID
       $compteToDelete = Compte::findOrFail($idcompte);

       // Check if the compte exists
       if (!$compteToDelete) {
           return redirect()->back()->with('error', 'Compte not found');
       }

       // Retrieve the user associated with the compte
       $userToDelete = $compteToDelete->user;

       // Check if the user exists
       if (!$userToDelete) {
           return redirect()->back()->with('error', 'User not found');
       }

         // Check if the user to delete belongs to the authenticated student
    if ($userToDelete->student_id !== $user->id) {
        // If not, redirect with an error message or handle it as per your requirements
        return redirect()->back()->with('error', 'u  can t delet ur self ');
    }

       // Delete related student record, if it exists
       if ($userToDelete->student) {
           $userToDelete->student->delete();
       }
       if ($userToDelete->teacher) {
        $userToDelete->teacher->delete();
    }
    if ($userToDelete->expert) {
        $userToDelete->expert->delete();
    }
    if ($userToDelete->visiteur) {
        $userToDelete->visiteur->delete();
    }
       // Delete the user
       $userToDelete->delete();

       // Delete the compte
       if ($compteToDelete) {
        $compteToDelete->delete();
    }    
       return redirect()->back()->with('success', 'User and related data have been deleted successfully');

        
    } 
    
    // EtudiantController.php

public function block($idcompte)
{
    try {
        // Retrieve the compte by ID
        $compte = Compte::findOrFail($idcompte);

        // Check if the compte exists
        if (!$compte) {
            return redirect()->back()->with('error', 'Compte not found');
        }

        // Block the compte (set etat to 0)
        $compte->update(['etat' => 0]);

        return redirect()->back()->with('success', 'User account has been blocked successfully');
    } catch (\Exception $e) {
        // Handle any exceptions
        return redirect()->back()->with('error', 'Failed to block user account');
    }
}

public function activate($idcompte)
{
    try {
        // Retrieve the compte by ID
        $compte = Compte::findOrFail($idcompte);

        // Check if the compte exists
        if (!$compte) {
            return redirect()->back()->with('error', 'Compte not found');
        }

        // Activate the compte (set etat to 1)
        $compte->update(['etat' => 1]);

        return redirect()->back()->with('success', 'User account has been activated successfully');
    } catch (\Exception $e) {
        // Handle any exceptions
        return redirect()->back()->with('error', 'Failed to activate user account');
    }
}

    
}
