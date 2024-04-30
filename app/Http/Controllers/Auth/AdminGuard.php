<?php
// app/Auth/AdminGuard.php
namespace App\Auth\Guards;

use App\Models\Compte;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;

class AdminGuard extends SessionGuard
{
    /**
     * Create a new authentication guard.
     *
     * @param  string  $name
     * @param  UserProvider  $provider
     * @param  \Illuminate\Contracts\Session\Session|null  $session
     * @param  string|null  $sessionKey
     * @return void
     */
    public function __construct($name, UserProvider $provider, $session = null, $sessionKey = null)
    {
        parent::__construct($name, $provider, $session, $sessionKey);
    }

    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param  array  $credentials
     * @param  bool   $remember
     * @return bool
     */
    // app/Auth/Guards/AdminGuard.php

public function attempt(array $credentials = [], $remember = false)
{
    // Retrieve email and password from the credentials array
    $email = $credentials['email'];
    $password = $credentials['password'];

    // Fetch the admin from the 'compte' table using the email
    $admin = Compte::where('email', $email)->first();

    // If admin is found and password matches, log in the admin
    if ($admin && Hash::check($password, $admin->password)) {
        $this->login($admin, $remember);
        return true;
    }

    return false;
}

}
