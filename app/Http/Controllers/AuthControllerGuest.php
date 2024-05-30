<?php

namespace App\Http\Controllers;

use App\Models\Visiteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Services\ServiceUser; // Import the UserService class

class AuthControllerGuest extends Controller
{

    protected $userService;

    public function __construct(ServiceUser $userService)
    {
        $this->userService = $userService;
    }


    public function showRegistrationForm()
    {
        return view('guest.login');
    }
// Register guest
public function register(Request $request)
{
    // Create a new User
    $user = User::create([
        'name' => $request->name,
        'role_id' => '4',  // id of visiteur on role table
        // Add other fields as needed
    ]);

    // Create a new Visiteur for the user
    $user->visiteur()->create([
        'name' => $request->name,
        // Add other fields as needed
    ]);

    // loging in
    auth()->login($user);

    // Regenerate session ID to prevent session fixation attacks
    $request->session()->regenerate();
    $userRole = $this->userService->getRole($user->id);
   
    session(['userRole' => $request->role]);
    return redirect()->route('guest.dashboard')->with('user', $user);; // Redirect to the guest dashboard

       
}









    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home');
        session()->invalidate(); // Clears the user's session data
        session()->regenerateToken(); // Regenerates the CSRF token
    }


    private function generateRandomEmail($length = 10)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString . '@example.com'; // Change the domain as needed
}

private function generateRandomPassword($length = 10)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';

    // Generate a random password of the specified length
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}
}
