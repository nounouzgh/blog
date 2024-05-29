<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoursEnLigneController;

// for show create blade  use in slide
Route::get('/cours-en-ligne/create', [CoursEnLigneController::class, 'create'])->name('cours-en-ligne.create');

Route::post('/cours-en-ligne', [CoursEnLigneController::class, 'store'])->name('cours-en-ligne.store');

Route::get('/cours-en-ligne/list', [CoursEnLigneController::class, 'listcoursEnLigne'])->name('cours-en-ligne.list');