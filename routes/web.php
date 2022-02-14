<?php

use App\Http\Controllers\Resources\UserController;
use App\Http\Controllers\UserActions\AuthenticationController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [AuthenticationController::class, 'authentication']);
Route::post('login', [AuthenticationController::class, 'authenticate']);

// the registeration view and storing route
Route::resource('users', UserController::class);