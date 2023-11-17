<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//--API Register
Route::post('register', \App\Http\Controllers\Api\Auth\RegisterController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
