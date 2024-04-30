<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Expert;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\Compte;
use Illuminate\Support\Facades\Auth;

class ServiceUser
{
    protected $UserRepository;

    public function __construct(UserRepository $userModel)
{
    $this->UserRepository = $userModel;
}
public function getRole($userId)
{
    return $this->UserRepository->getRole($userId);
}
public function getRolecompte($adminId)
{
    return $this->UserRepository->getRolecompte($adminId);
}
public function getAllUsers()
{
    return $this->UserRepository->getAllUsers();
}


public static function authenticateAdmin($email, $password)
{
    $compte = Compte::where('email', $email)->first();

    if ($compte && Auth::guard('admin')->attempt(['compte_id' => $compte->id, 'password' => $password])) {
        return true; // Authentication successful
    }

    return false; // Authentication failed
}
}

