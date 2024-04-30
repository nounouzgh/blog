<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\test;
use App\Http\Controllers\AdminController;
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
});


// test controlle pase data and get it in blade test
//Route::get('/test', [test::class, 'Userwithrole']);
/*
    Route::get('/lol', function () {
        return view('1to call back if err.dashboard');
    });*/
Route::get('/lol', [test::class, 'index']);

require __DIR__.'/NoRole.php';
require __DIR__.'/auth.php';
require __DIR__.'/guest.php';
require __DIR__.'/student.php';
require __DIR__.'/teacher.php';
require __DIR__.'/expert.php';
require __DIR__.'/admin.php';
require __DIR__.'/resource.php';

