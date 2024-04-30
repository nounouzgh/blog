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
        $user = $compte->user()->create([
            'name' => $request->name,
            'role_id' => Role::where('name', $request->role)->value('id'),
        ]);

        // Create user based on role
        if ($request->role === "admin") {
            $admin = $compte->admin()->create([
                'nom' => $request->name,
                'prenom' => $request->name, // Include the 'prenom' field
            ]);
            Auth::guard('compte')->login($compte);
            // Automatically log in the admin
            Auth::guard('admin')->login($admin);
            // Regenerate session ID to prevent session fixation attacks
            Auth::login($user);
            $request->session()->regenerate();
            // Set user role in session
            session(['userRole' => 'admin']);
            // Redirect to the admin dashboard
            
           // return redirect()->route('admin.dashboard');
           //return view('admin.dashboard');
           return redirect()->route('admin.dashboard')->with('user', $user); 
        } else {
            $user = $compte->user()->create([
                'name' => $request->name,
                'role_id' => Role::where('name', $request->role)->value('id'),
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
            } elseif ($request->role === "supervisor") {
                $user->supervisor()->create([
                   'specialite' => $request->input('specialite'),
                ]);
            }
            Auth::guard('compte')->login($compte);
            // Log in the user
            Auth::login($user);
            // Regenerate session ID to prevent session fixation attacks
            $request->session()->regenerate();
            // Set user role in session
            session(['userRole' => $request->role]);
            // Redirect based on user role
            $userRole = $this->userService->getRole($user->id);
            return $this->redirectServiceLogin->redirectLogingBasedOnRole($userRole, $user)->with('user', $user);
        }
    }
}
