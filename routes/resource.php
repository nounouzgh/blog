<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\SignalResourceController;

Route::post('/resource/dashboard', [ResourceController::class, 'store'])->name('resource.store');
// test controlle pase data and get it in blade test
Route::get('/resource/dashboard', [ResourceController::class, 'index'])->name('resource.index');

Route::delete('/resources/{id}', [ResourceController::class, 'destroy'])->name('resource.destroy');

Route::get('/resources/edit/{id}', [ResourceController::class, 'edit'])->name('resource.edit');

Route::put('/resources/{resource}/edit/update', [ResourceController::class, 'update'])->name('resource.update'); // Update profile


Route::get('Student/resource/dashboard', [ResourceController::class, 'search'])->name('resource.search');


Route::get('resource/download/{id}', [ResourceController::class, 'downloadFile'])->name('resource.download');

/*
Route::get('/resources/{id}/view', [ResourceController::class, 'view'])->name('resource.view');
*/
// this one for give acc to see resource 
Route::get('/storage/{file}', function ($file) {
    $path = storage_path('app/public/' . $file);
    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('file', '.*');

// view fille resourece verrssion 2

Route::get('/resource/{id}/viewFileshow', [ResourceController::class, 'viewFileshow'])->name('resource.viewFileshow');

// view fille resourece verrssion 2
Route::get('/resource/{id}/view_filerun', [ResourceController::class, 'view_fileinCader'])->name('resource.view_fileinCader');



// Define the routes

// Route to show the form for creating a new comment
Route::get('/resources/{resourceId}/comments', [CommentsController::class, 'show'])->name('comments.show');

// Route to store a newly created comment
Route::post('/resources/{resource}/comments', [CommentsController::class, 'store'])->name('comments.store');

// Route to delete a comment
Route::delete('/comments/{id}', [CommentsController::class, 'destroy'])->name('comments.destroy');

Route::get('/resources/{resourceId}/signal', [SignalResourceController::class, 'show'])->name('resource.signal.show');

Route::post('/resources/{id}/signal', [SignalResourceController::class, 'store'])->name('resource.signal.store');
