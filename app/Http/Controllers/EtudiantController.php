<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class EtudiantController extends Controller
{
    // edit work

    public function show($id)
    {
        // Retrieve the student, user, and compte based on the ID
        $student = Student::findOrFail($id);
        $user = $student->user;
        $compte = $user->compte;

        // Return the view to display student information
        return view('student.profile', compact('student', 'user', 'compte'));
    }


    public function edit()
    {
        // Retrieve the compte with its associated user and student for editing

        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
        $student = $user->student;
        $editing = false;
        return view('student.profile', compact('student', 'user', 'compte', 'editing'));
    }


    public function update(Request $request)
    {
        // Retrieve the authenticated compte and its associated user
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;

        // Retrieve the student associated with the authenticated user
        $student = $user->student;

        // Update the student's information
        $student->update([
            'specialite' => $request->input('specialite'),
            'date_naissance' => $request->input('date_naissance'),
            'niveau' => $request->input('niveau'),
            // Add other fields here as necessary
        ]);

        // Update the user's information
        $user->update([
            'name' => $request->input('user_name'),
            'prenom'=> $request->input('user_prenom'),
            'email' => $request->input('user_email'),
            // Add other fields here as necessary
        ]);

        // Redirect back to the student's profile page
        return redirect()->route('student.profile.edit')->with('success', 'Student information updated successfully');
    }

    public function destroy()
    {
        // Retrieve the authenticated compte and its associated user
        $compte = Auth::guard('compte')->user();
        $user = $compte->user;
        // Retrieve the student associated with the authenticated user
        $student = $user->student;
        Auth::guard('compte')->logout();

        $this->performDeletion($compte, $user, $student);

        // Redirect to a relevant page after deletion
        return redirect()->route('welcome')->with('success', 'Your account has been deleted successfully');
    }

    /**
     * Perform the deletion of the compte and related records.
     *
     * @param Compte $compte
     * @return bool
     */
    protected function performDeletion(Compte $compte, User $user, Student $student)
    {
        // If a student exists, delete it
        if ($student) {
            $student->delete();
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
