<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DemandeInscriptionController;

   
use App\Http\Controllers\AdsController;

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




// all that be need be auth user 
Route::middleware('auth')->group(function () {

    Route::get('/users', [UsersController::class, 'listUsers'])->name('users.List');
    // Route to show the form for creating a new comment
   // Route to delete a comment
   Route::delete('/users/{idcompte}', [UsersController::class, 'delete'])->name('user.delete'); // Updated route
    Route::put('/users/{idcompte}/block', [UsersController::class, 'block'])->name('user.block');
    Route::put('/users/{idcompte}/activate', [UsersController::class, 'activate'])->name('user.activate');


    Route::post('/signals', [SignalController::class, 'store'])->name('signals.store');
    Route::get('/signals/user/{id}', [SignalController::class, 'show'])->name('signals.show');
    




    Route::get('/demande-inscriptions', [DemandeInscriptionController::class, 'listDemandeInscription'])->name('demande-inscriptions.index');
    Route::get('/demande-inscriptions/{id}', [DemandeInscriptionController::class, 'show'])->name('demande-inscriptions.show');
    Route::delete('/demande-inscriptions/{id}', [DemandeInscriptionController::class, 'active_destroy'])->name('demande-inscriptions.destroy');
    


});

