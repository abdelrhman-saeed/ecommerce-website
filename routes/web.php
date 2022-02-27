<?php

use App\Http\Controllers\Dashboard\Resources\NotebookController;
use App\Http\Controllers\Resources\UserController;
use App\Http\Controllers\UserActions\AuthenticationController;
use App\Models\Notebook;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('welcome');
})->middleware(['auth', 'verified']);


Route::controller(AuthenticationController::class)->group(function () {
    
    Route::get('login', 'authentication')->name('login');
    Route::post('login', 'authenticate');
    Route::get('logout', 'logout')->name('logout');

    Route::get('/email/verify','emailVerificationNotice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->name('verification.verify');
    Route::post('/email/verification/notification', 'resendEmailVerificationNotification')->name('verification.send');

    Route::get('/forgot-password', 'forgotPasswordPage')->name('password.request');
    Route::post('/forgot-password', 'forgotPassword')->name('password.email');

    Route::get('/reset-password/{token}', 'passwordResetPage')->name('password.reset');
    Route::post('/reset-password/{token}', 'passwordReset');
});

// the registeration view and siging in route
Route::resource('/users', UserController::class);

// the admin dashboard for the notebooks
Route::resource('dashboard/notebooks', NotebookController::class);

Route::get('test/{notebook}', function (Notebook $notebook) {
    dd($notebook->pictures()->get()[1]->picture_path);
    // return NotebookPictures::where('notebook_id', $notebook->id)->get();
});