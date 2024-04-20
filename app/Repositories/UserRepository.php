<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Compte;

class UserRepository // class to use 
{
    protected $userModel;

    public function __construct(User $userModel)
{
    $this->userModel = $userModel;
}

public function findById($id)
{
    return User::find($id);
}

public function getAllUsers()
{
    return $this->userModel->all();

}


public function hasRole($userId, $role) {
    return $this->userModel::find($userId)->role()->where('name', $role)->exists();
}


// Custom method to get the role of the user
// Custom method to get the role of the user
public function getRole($userId)
{
    $user = $this->userModel->find($userId);

    if ($user) {
        // Ensure that the role relationship is loaded
        $role = $user->role;

        if ($role) {
            return $role->name;
        } else {
            return "No Role Assigned";
        }
    } else {
        return "User not found";
    }
}
public function getRolecompte($compteId)
{
    $compte = Compte::find($compteId);

    if ($compte) {
        // Ensure that the user relationship is loaded
        $user = $compte->user;

        if ($user) {
            // Ensure that the role relationship is loaded
            $role = $user->role;

            if ($role) {
                return $role->name;
            } else {
                return "No Role Assigned";
            }
        } else {
            return "User not found";
        }
    } else {
        return "Compte not found";
    }
}   


}
