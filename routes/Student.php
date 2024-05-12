<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

Route::middleware(['auth:compte', 'verified', 'student'])->group(function () {
    // Dashboard route
    Route::prefix('student')->name('student.')->group(function () {
        Route::view('dashboard', 'student.dashboard')->name('dashboard');

        
        
    });

    // Profile routes
    Route::prefix('student/profile')->name('student.profile.')->group(function () {
        Route::get('/', [EtudiantController::class, 'show'])->name('show'); // Show profile
        Route::get('edit', [EtudiantController::class, 'edit'])->name('edit'); // Edit profile (show edit form)
        Route::put('/', [EtudiantController::class, 'update'])->name('update'); // Update profile
        Route::delete('/', [EtudiantController::class, 'destroy'])->name('destroy'); // Delete profile
    });
});
