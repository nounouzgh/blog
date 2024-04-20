<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ServiceUser; // Import the UserService class

class Admin
{
    protected $userService;

    public function __construct(ServiceUser $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check() && !Auth::guard('compte')->check()) {
            return redirect()->route('login');
        }

        // Get the authenticated user's role
        $compteId = Auth::id();
        $userRole = $this->userService->getRolecompte($compteId);

        // Check if the user role is "admin"
        if ($userRole == "admin") {
            // If the user is an admin, allow access
            return $next($request);
        } else {
            // If the user is not an admin, redirect to an appropriate page
            return redirect()->route('welcome')->with('success', 'You do not have permission to access this page');
        }
    }
}
