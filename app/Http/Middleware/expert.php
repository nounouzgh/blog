<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response; // Import Response class from Illuminate\Http namespace
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ServiceUser;

class expert // Corrected class name
{
    protected $userService;

    public function __construct(ServiceUser $userService)
    {
        $this->userService = $userService;
    }

    public function handle(Request $request, Closure $next)
    {
   // this one fix problem to go in with out beein login in 
   if (!Auth::check() && !Auth::guard('compte')->check()) {
    return redirect()->route('login');
    
}else{
    if (Auth::check() && Auth::guard('compte')->check()) {
        $userId = Auth::id();
        $userRole = $this->userService->getRolecompte($userId);
       
         if ($userRole == "expert") {
             return $next($request);
         }else{
        
            return redirect()->route('welcome');
         }
         
        
    }

}
   // If the user role is neither expert nor admin, redirect to an appropriate page
   
}
}

