<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


//--API
//-----------------------------------------------------------------
// Route::post('/register', \App\Http\Controllers\Api\Auth\RegisterController::class);

//--register:
Route::post('/register', [AuthController::class, 'register']);
//--login:
Route::post('/login', [AuthController::class, 'login']);
//--logout:
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//-----------------------------------------------------------------
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
