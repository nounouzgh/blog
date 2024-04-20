<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->name('admin.')->middleware(['auth:compte', 'verified', 'admin'])->group(function () {
    // Dashboard
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');

    // Profile routes
    Route::get('profile', [AdminController::class, 'show'])->name('profile.show'); // Show profile
    Route::get('profile/{id}', [AdminController::class, 'show'])->name('profile.show'); // Show specific profile
    Route::get('profil/edit', [AdminController::class, 'edit'])->name('profile.edit'); // Edit profile (show edit form)
    Route::put('profil', [AdminController::class, 'update'])->name('profile.update'); // Update profile
});
