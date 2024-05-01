<?php


use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\admin;


// routes/web.php

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'listUsers'])->name('users');

    
});

/*
// In your routes file (web.php or api.php)
Route::get('/admin', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
*/