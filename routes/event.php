
<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventPayonController;



// all that be need be auth user 
Route::middleware('auth')->group(function () {
Route::get('/events', [EventPayonController::class, 'create'])->name('events.create');
Route::post('/events/store', [EventPayonController::class, 'store'])->name('events.store');
Route::get('/events/List', [EventPayonController::class, 'ListEvents'])->name('events.list');

});

