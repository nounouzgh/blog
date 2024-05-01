<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\compte;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Http\Services\ServiceUser; // Import the UserService class
use App\Http\Services\RedirectServiceLoging; // Import the UserService class

class RegisteredUserController extends Controller
{
    protected $userService;
    protected $redirectServiceLogin;

    public function __construct(ServiceUser $userService, RedirectServiceLoging $redirectServiceLogin)
    {
        $this->userService = $userService;
        $this->redirectServiceLogin = $redirectServiceLogin;
    }

    public function create(): View
    {
        return view('auth.register');
    }
 
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:comptes'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string'], // Add validation for role
        ]);

        // Validate if the selected role exists
        if (!in_array($request->role, ['admin', 'student', 'teacher', 'expert'])) {
            return redirect()->back()->withErrors(['role' => 'Invalid role selected']);
        }

       
        // Create compte (user account)
        $compte = Compte::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
         // Create a user and associate it with the compte
         $user = $compte->user()->create([
            'name' => $request->name,
            'prenom'=>  $request->prenom,
            'role_id' => Role::where('name', $request->role)->value('id'),
        ]);

           // Determine the type of user and create the related model
           if ($request->role === "student") {
            $user->student()->create([
               'specialite' => $request->input('specialite'),
               'date_naissance' => $request->input('date_naissance'),
               'niveau' => $request->input('niveau'),
            ]);
        }
         elseif ($request->role === "teacher") {
            $user->teacher()->create([
               'specialite' => $request->input('specialite'),
               'grade' => $request->input('grade'),
            ]);
        }
         elseif ($request->role === "expert") {
            $user->expert()->create([
               'specialite' => $request->input('specialite'),
            ]);
            $compte->update([
                'etat' => '0', // Set etat to 0 for expert accounts
                // Add other fields here as necessary
            ]);   
            return redirect()->route('login')->with('confirmation_message', 'Your account is waiting for confirmation. Please check your email for further instructions.');
        }
          elseif ($request->role === "admin") {
             $admin = $compte->admin()->create([
                'nom' => $user->name,
                'prenom' => $request->prenom, // Include the 'prenom' field
            ]);

            Auth::guard('admin')->login($admin);
         }


            Auth::guard('compte')->login($compte);
            // Log in the user
            Auth::login($user);
            // Regenerate session ID to prevent session fixation attacks
            $request->session()->regenerate();
            // Set user role in session
            session(['userRole' => $request->role]);
            // Redirect based on user role
            return $this->redirectServiceLogin->redirectLogingBasedOnRole($request->role, $user)->with('user', $user);
        }
    }

