<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Compte;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Services\ServiceUser; // Import the UserService class
use App\Http\Services\RedirectServiceLoging; // Import the RedirectServiceLogin class

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:comptes'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string'], // Add validation for role
        ]);

        $roleId = Role::where('name', $request->role)->value('id');

        $compte = Compte::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = $compte->user()->create([
            'name' => $request->name,
            'role_id' => $roleId,
        ]);

        if ($request->role === "student") {
            $user->student()->create([
                'specialite' => $request->input('specialite'),
                'date_naissance' => $request->input('date_naissance'),
                'niveau' => $request->input('niveau'),
            ]);
        } elseif ($request->role === "teacher") {
            $user->teacher()->create([
                'specialite' => $request->input('specialite'),
                'grade' => $request->input('grade'),
            ]);
        } elseif ($request->role === "expert") {
            $user->expert()->create([
                'specialite' => $request->input('specialite'),
            ]);
        }

        Auth::login($user);
        Auth::guard('compte')->login($compte);

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