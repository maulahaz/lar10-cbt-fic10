<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SoalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('homepage');
// });

Route::get('/', function () {
    return view('auth.auth-login');
});

// use App\Http\Controllers\AuthController;
 
// Route::get('login', [AuthController::class, 'login']);
// Route::get('register', [AuthController::class, 'reg']);

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    })->name('home');

    //--Users:
    //-----------------------------------------------------------------
    Route::resource('users', UserController::class);

    //--Soal:
    //-----------------------------------------------------------------
    // Route::get('soal/list', 'SoalController@list');
    Route::resource('soal', SoalController::class);
});

//--Soals
//-----------------------------------------------------------------
// Route::group(['namespace' => 'App\Http\Controllers'], function(){
//     Route::get('soal/list', 'SoalController@list');
//     Route::Resource('/soal', SoalController::class);
// });
