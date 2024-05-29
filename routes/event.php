
<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventPayonController;

Route::get('/events', [EventPayonController::class, 'create'])->name('events.create');
Route::post('/events/store', [EventPayonController::class, 'store'])->name('events.store');
Route::post('/events/{id}/participate', [EventPayonController::class, 'participate'])->name('events.participate');
