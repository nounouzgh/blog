<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ServiceUser; // Import the UserService class
class Teacher
{

    protected $userService;

    public function __construct(ServiceUser $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() && !Auth::guard('compte')->check()) {
            return redirect()->route('login');
        }else{
            if (Auth::check() && Auth::guard('compte')->check()) {

        $userId = Auth::id();
        //$userRole = $this->userService->getRole($userId);
        $userRole = $this->userService->getRolecompte($userId);
      
        // Check user roles and redirect accordingly
        if ($userRole == "teacher") {
            return $next($request);
             }else
                 return redirect()->route('welcome');
                
            }

        }
           // If the user role is neither supervisor nor admin, redirect to an appropriate page
           
}
}