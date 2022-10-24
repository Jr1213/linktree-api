<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

//auth
Route::apiResource('Auth',AuthController::class);
Route::post('Login',LoginController::class);