<?php

use App\Http\Controllers\Resources\UserController;
use App\Http\Controllers\UserActions\AuthenticationController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
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
})->middleware('auth');


Route::controller(AuthenticationController::class)->group(function () {
    
    Route::get('login', 'authentication')->name('login');
    Route::post('login', 'authenticate');
    Route::get('logout', 'logout')->name('logout');

    Route::get('/email/verify','emailVerificationNotice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->name('verification.verify');
    Route::post('/email/verification/notification', 'resendEmailVerificationNotification')->name('verification.send');
});

// the registeration view and siging in route
Route::resource('/users', UserController::class);