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
    protected $redirectServiceLogin; // Define the redirectServiceLogin property

    public function __construct(ServiceUser $userService, RedirectServiceLoging $redirectServiceLogin)
    {
        $this->userService = $userService;
        $this->redirectServiceLogin = $redirectServiceLogin; // Initialize the redirectServiceLogin property
    }


    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    

     public function store(Request $request): RedirectResponse
     {
         $request->validate([
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:comptes'],
             'password' => ['required', 'string', 'min:8', 'confirmed'],
             'role' => ['required', 'string'], // Add validation for role
         ]);
     
         // Find the role ID for the given role name
         $roleId = Role::findID($request->role);
     
         // Create a compte
         $compte = Compte::create([
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);
     
         // Create a user and associate it with the compte
         $user = $compte->user()->create([
             'name' => $request->name,
             'role_id' => $roleId,
         ]);
     
         // Determine the type of user and create the related model
         if ($request->role === "student") {
            $user->student()->create([
                // Add other fields as needed
            ]);
        } elseif ($request->role === "teacher") {
            $user->teacher()->create([
                // Add other fields as needed
            ]);
         } elseif ($request->role === "expert") { // Changed from "supervisor" to "expert"
             // Handle expert registration
             $user->expert()->create([
                 // Add other fields as needed
             ]);
         } elseif ($request->role === "admin") {
             // Handle admin registration
             $user->admin()->create([
                 // Add other fields as needed
             ]);
         }
     
         // Assuming $compte represents the user account
         Auth::guard('compte')->login($compte);
         Auth::login($user);
         $compte = Auth::guard('compte')->user(); // Retrieve the associated user using the compte instance
         $user = $compte->user;
     
         // Regenerate session ID to prevent session fixation attacks
         $request->session()->regenerate();
         session(['userRole' => $request->role]);
     
         // Redirect to the appropriate dashboard route
         if ($user) {
             $userRole = $this->userService->getRole($user->id);
             session(['userRole' => $userRole]);
     
             if ($userRole) {
                 // Pass the $user variable to the view
                 return $this->redirectServiceLogin->redirectLogingBasedOnRole($userRole, $user)->with('user', $user);
             }
         } else {
             return response()->json(['error' => 'Invalid User'], 401);
         }
     }
     
     
    }