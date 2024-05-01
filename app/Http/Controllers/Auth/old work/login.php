<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Compte; // Import the Compte model
use App\Http\Services\ServiceUser; // Import the UserService class
use App\Http\Services\RedirectServiceLoging; // Import the RedirectServiceLogin class

class AuthenticatedSessionController extends Controller
{
    protected $userService;
    protected $redirectServiceLogin;

    public function __construct(ServiceUser $userService, RedirectServiceLoging $redirectServiceLogin)
    {
        $this->userService = $userService;
        $this->redirectServiceLogin = $redirectServiceLogin;
    }

    public function create() 
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        
        $credentials = $request->only('email', 'password');
        
        // Attempt to log in with the 'compte' guard
        if (Auth::guard('compte')->attempt($credentials)) {
            // Retrieve the authenticated compte
            $compte = Auth::guard('compte')->user();
    
            // Check if the compte's etat is active (etat == 1)
            if ($compte->etat === 1) {
                // Retrieve the associated user using the compte instance
                $user = $compte->user;
    
                // If user exists
                if ($user) {
                    $userRole = $this->userService->getRole($user->id);
    
                    // Set user role in session
                    session(['userRole' => $userRole]);
    
                    // Log in the compte and user
                    Auth::guard('compte')->login($compte);
                    Auth::login($user);
    
                    // If the user is an admin, also log in the admin guard
                    if ($userRole == "admin") {
                        Auth::guard('admin')->login($compte->admin);
                    }
    
                    // Redirect based on user role
                    return $this->redirectServiceLogin->redirectLogingBasedOnRole($userRole, $user)->with('user', $user);
                }
            } else {
                // If compte's etat is not active, logout and redirect to login page with a message
                Auth::guard('compte')->logout();
                return redirect()->route('login')->with('confirmation_message', 'Your account is waiting for confirmation. Please check your email for further instructions.');
            }
        }
        
        // If authentication fails, return error response
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }
    
    public function destroy(Request $request)
    {
        Auth::guard('compte')->logout(); // Log the user out from the 'compte' guard
        Auth::guard('admin')->logout(); // Log the user out from the 'admin' guard
        Auth::logout(); // Log out from all guards
        $request->session()->invalidate(); // Invalidate the session
        return redirect('/'); // Redirect to the home page or any other desired location
    }
}
