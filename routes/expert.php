<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertController;
Route::prefix('expert')->name('expert.')->middleware(['auth:compte', 'verified', 'expert'])->group(function () {
    // Dashboard route
    Route::view('dashboard', 'expert.dashboard')->name('dashboard');

    // Profile routes
    Route::get('profile', [ExpertController::class, 'show'])->name('profile.show'); // Show profile
    Route::get('profile/edit', [ExpertController::class, 'edit'])->name('profile.edit'); // Edit profile (show edit form)
    Route::put('profile/update', [ExpertController::class, 'update'])->name('profile.update'); // Update profile
    Route::delete('profile/delete', [ExpertController::class, 'destroy'])->name('profile.destroy'); // Delete profile
});

