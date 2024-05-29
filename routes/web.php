<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\test;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ResourceController;

// Define a catch-all route when u do wrong route

Route::fallback(function () {
    return redirect('/');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


/* need to fix this route later*/
    Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/updateProfileImage', [ProfileController::class, 'updateProfileImage'])->name('updateProfileImage');

});





require __DIR__.'/NoRole.php';
require __DIR__.'/auth.php';
require __DIR__.'/guest.php';
require __DIR__.'/student.php';
require __DIR__.'/teacher.php';
require __DIR__.'/expert.php';
require __DIR__.'/admin.php';
require __DIR__.'/resource.php';
require __DIR__.'/ads.php';
require __DIR__.'/Reunion.php';
require __DIR__.'/coure.php';
require __DIR__.'/event.php';

