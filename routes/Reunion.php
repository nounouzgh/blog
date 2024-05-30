<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReunionController;

/*
Route::get('/reunions/create', function () {
    return view('reunions.create');
});
*/


Route::middleware('auth')->group(function () {

Route::get('/reunions/create', [ReunionController::class, 'create'])->name('reunions.create');

Route::post('/reunions', [ReunionController::class, 'store'])->name('reunions.store');


Route::get('/reunion/{reunionId}', [ReunionController::class, 'reunionInviter'])->name('reunion.inviter');

Route::get('/get-student-list', [ReunionController::class, 'getStudentList']);
Route::get('/get-teacher-list', [ReunionController::class, 'getTeacherList']);



Route::post('/reunion/{reunionId}/invite', [ReunionController::class, 'invite'])->name('reunion.invite');
Route::get('/reunions/invitation', [ReunionController::class, 'listInviteReunionUser'])->name('reunions.invitation');


Route::get('/get-number-invite-reunion', [ReunionController::class, 'getNumberInviteReunion'])->name('get-number-invite-reunion');

Route::get('/reunions', [ReunionController::class, 'listReunion'])->name('reunions.list');

Route::delete('/reunions/{reunion}', [ReunionController::class, 'destroy'])->name('reunions.destroy');

// In web.php or routes file
Route::post('/reunion/{idreunion}/participate', [ReunionController::class, 'participate'])->name('reunions.participate');

});
