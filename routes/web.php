<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [AuthController::class, 'index'])
    ->name('auth.index');

Route::get('/login', [AuthController::class, 'index'])
    ->name('auth.login');

Route::post('/login', [AuthController::class, 'verify'])
    ->name('auth.verify');

Route::get('/register', [AuthController::class, 'register'])
    ->name('auth.register');

#untuk proses register
Route::post('/register/store', [AuthController::class, 'store'])
    ->name('auth.register.store');

Route::middleware(['auth.api'])->group(function () {

    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile.index');
    Route::get('/profile/edit', [DashboardController::class, 'editProfile'])
        ->name('profile.edit');
    Route::post('/profile/store', [DashboardController::class, 'updateProfile'])
        ->name('profile.edit.store');
});