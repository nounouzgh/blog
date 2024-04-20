<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ServiceUser; // Import the UserService class

class Guest
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
        
        if (!Auth::check() && !Auth::guard('compte')->check()) {
            return redirect()->route('login');
            
        }

        $userId = Auth::id();
        $userRole = $this->userService->getRole($userId);
  
        if ($userRole == "guest") {
            return $next($request);
        }else// If the user role is neither supervisor nor admin, redirect to an appropriate page
        return redirect()->route('welcome')->with('success', 'Student information updated successfully');
        }
    }

