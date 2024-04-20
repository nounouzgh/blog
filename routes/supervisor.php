<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupervisorController;

Route::prefix('supervisor')->name('supervisor.')->middleware(['auth:compte', 'verified', 'supervisor'])->group(function () {
    // Dashboard route
    Route::view('dashboard', 'supervisor.dashboard')->name('dashboard');

    // Profile routes
    Route::get('profile', [SupervisorController::class, 'show'])->name('profile.show'); // Show profile
    Route::get('profile/edit', [SupervisorController::class, 'edit'])->name('profile.edit'); // Edit profile (show edit form)
    Route::put('profile/update', [SupervisorController::class, 'update'])->name('profile.update'); // Update profile
    Route::delete('profile/delete', [SupervisorController::class, 'destroy'])->name('profile.destroy'); // Delete profile
});
