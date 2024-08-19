<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'getUser']);
        Route::post('update-profile', [AuthController::class, 'updateProfile']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
});
