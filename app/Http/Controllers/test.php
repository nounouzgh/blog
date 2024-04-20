<?php

namespace App\Http\Controllers;

use App\Models\User;


class test extends Controller
{
    public function Userwithrole()
    {
         // Create an instance of the User model
         $userModel = new User();
         // Call the function defined in the User model
         $usersWithRoles = $userModel->getUsersWithTheirRoles();

        return view('test', compact('usersWithRoles')); // Pass data to the Blade view
    }



}