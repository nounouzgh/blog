<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ServiceUser; // Import the UserService class


class Student
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
       // this one fix problem to go in with out beein login in 
        if (!Auth::check() && !Auth::guard('compte')->check()) {
            return redirect()->route('login');
            
        }else{
            if (Auth::check() && Auth::guard('compte')->check()) {
                $userId = Auth::id();
                $userRole = $this->userService->getRolecompte($userId);
               
                 if ($userRole == "student") {
                     return $next($request);
                    }else{
                     
                        return redirect()->route('welcome');
                     }
            }

        }
           // If the user role is neither expert nor admin, redirect to an appropriate page
           
}
}

