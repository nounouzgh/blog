<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use App\Http\Services\ServiceUser; // Import the UserService class
use App\Http\Services\RedirectServiceLoging; // Import the RedirectServiceLoging class

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
            // Regenerate the session ID to prevent session fixation attacks
            $request->session()->regenerate();
            
            // Retrieve the authenticated compte
            $compte = Auth::guard('compte')->user();
    
            // Retrieve the associated user using the compte instance
            $user = $compte->user;
    
            // If user exists, determine user role and redirect
            if ($user) {
                $userRole = $this->userService->getRole($user->id);
                session(['userRole' => $userRole]);
                
                // Redirect based on user role
                if ($userRole) {
                      // Assuming $compte represents the user account
                    Auth::guard('compte')->login($compte);
                    Auth::login($user);
                    return redirect()->route($userRole . '.dashboard');
                    
                }
            }
    
            // If user role is not defined, redirect to default dashboard
            return redirect()->route('login');
        }
        
        // If authentication fails, return error response
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }
    
    
    public function destroy(Request $request)
    {
        Auth::guard('compte')->logout(); // Log the user out from the 'compte' guard
        Auth::guard('admin')->logout(); // Log the user out from the 'compte' guard
        Auth::logout();
        $request->session()->invalidate(); // Invalidate the session
        return redirect('/'); // Redirect to the home page or any other desired location
    }
}
