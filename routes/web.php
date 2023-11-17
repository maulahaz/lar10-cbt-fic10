<?php

use Illuminate\Support\Facades\Route;

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

// use App\Http\Controllers\AuthController;
 
// Route::get('login', [AuthController::class, 'login']);
// Route::get('register', [AuthController::class, 'reg']);

//--Soals
Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('soal/list', 'SoalController@list');
    Route::Resource('/soal', SoalController::class);
});
