<?php


use Illuminate\Support\Facades\Route;

   
use App\Http\Controllers\AdsController;


Route::get('/ads/create', [AdsController::class, 'create'])->name('ads.create');
Route::post('/ads/store', [AdsController::class, 'store'])->name('ads.store');
Route::get('/ads/list', [AdsController::class, 'listAds'])->name('ads.list');

// Route for deleting an ad   ads.delete
Route::delete('ads/{id}', [AdsController::class, 'delete'])->name('ads.delete');
// Route for accepting an ad
Route::post('/ads/{id}/accept', [AdsController::class, 'accept'])->name('ads.accept');
// just for refrec is called in list_user_ads with paramater for pagination
Route::get('/ads/liste', [AdsController::class, 'indexlist_user_ads'])->name('ads.indexlist_user_ads');

Route::get('/ads/demandes_pubs', [AdsController::class, 'List_demande_pub'])->name('ads.demandes_pub');
// just for refrec is called in list_user_ads with paramater for pagination
Route::get('/ads/demandes_pub', [AdsController::class, 'list_users_demonde_pub'])->name('ads.list_users_demonde_pub');

// Define a route to show an ad by its ID
Route::get('/ads/{id}', [AdsController::class, 'show'])->name('ads.show');

// view fille resourece verrssion 
Route::get('/ads/{id}/view_filerun', [AdsController::class, 'view_fileinCader'])->name('ads.view_fileinCader');


