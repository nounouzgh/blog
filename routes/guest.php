<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthControllerGuest;


/*
Route::get('/register', [AuthControllerGuest::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthControllerGuest::class, 'register']);
Route::post('/login', [AuthControllerGuest::class, 'login'])->name('login');
Route::post('/logout', [AuthControllerGuest::class, 'logout'])->name('logout');
*/

Route::prefix('guest')->name('guest.')->group(function () {
  
        Route::view('dashboard', 'guest.dashboard')->name('dashboard');
        
Route::get('register', [AuthControllerGuest::class, 'showRegistrationForm'])->name('login'); // Show registration form
Route::post('register', [AuthControllerGuest::class, 'register'])->name('register'); ; // Register visitor
Route::post('logout', [AuthControllerGuest::class, 'logout'])->name('logout'); // Logout for visitors

    
});

/*
Route::get('/guest/register', [AuthControllerGuest::class, 'showRegistrationForm'])->name('guest.login'); // Show registration form
Route::post('/guest/register', [AuthControllerGuest::class, 'register'])->name('guest.register'); ; // Register visitor
Route::post('/guest/logout', [AuthControllerGuest::class, 'logout'])->name('guest.logout'); // Logout for visitors
*/