<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Routes for authenticated sessions (for other roles)
Route::middleware('auth')->group(function () {

    Route::get('verify-email', [EmailVerificationPromptController::class, 'show'])
        ->name('email.verify');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('email.verify.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('email.verify.send');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
/*
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');
*/

/*
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->name('password.confirmation'); // Changed route name to ensure uniqueness;
*/
    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
