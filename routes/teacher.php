<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Dashboard route
Route::prefix('teacher')->name('teacher.')->middleware(['auth:compte', 'verified', 'teacher'])->group(function () {
    Route::view('dashboard', 'teacher.dashboard')->name('dashboard');
});

// Profile routes
Route::prefix('teacher/profile')->name('teacher.profile.')->middleware(['auth:compte', 'verified', 'teacher'])->group(function () {
    Route::get('/', [TeacherController::class, 'show'])->name('show'); // Show profile
    Route::get('edit', [TeacherController::class, 'edit'])->name('edit'); // Edit profile (show edit form)
    Route::put('/', [TeacherController::class, 'update'])->name('update'); // Update profile
    Route::delete('/', [TeacherController::class, 'destroy'])->name('destroy'); // Delete profile
});
