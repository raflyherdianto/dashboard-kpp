<?php

use App\Http\Controllers\CompetenceScoreController;
use App\Http\Controllers\EgiController;
use App\Http\Controllers\GlWaliController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');

    // Users Routes
    Route::resource('users', UserController::class);
    Route::post('users/import-data', [UserController::class, 'importData'])->middleware('increaseExecutionTime')->name('users.import');

    Route::resource('glwali', GlWaliController::class);
    Route::resource('mekanik', MekanikController::class);
    Route::post('mekanik/import-data', [MekanikController::class, 'importData'])->middleware('increaseExecutionTime')->name('mekanik.import');

    Route::resource('databank', EgiController::class);
    Route::post('databank/import-data', [EgiController::class, 'importData'])->middleware('increaseExecutionTime')->name('databank.import');

    Route::post('score/import-data', [CompetenceScoreController::class, 'importData'])->middleware('increaseExecutionTime')->name('score.import');
});
