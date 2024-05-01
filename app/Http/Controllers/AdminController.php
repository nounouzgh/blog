<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;


class AdminController extends Controller
{
  
    public function adminDashboard()
    {
        return view('admin.dashboard');
      
    }

    public function listUsers()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('admin.users', ['users' => $users]); // Pass the users to the view
    }
  
}
