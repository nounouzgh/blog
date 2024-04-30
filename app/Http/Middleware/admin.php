<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

// Admin middleware
class admin
{
    public function handle($request, $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login'); // Redirect non-admin users to login
        }
   
        dd($request);
        return $next($request);
    }
}
