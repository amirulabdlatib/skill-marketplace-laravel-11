<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\TalentController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::post('/logout', [AuthController::class, 'doLogout'])->name('logout');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'getLoginPage'])->name('login.page');
    Route::get('/register', [AuthController::class, 'getRegisterPage'])->name('register.page');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('register');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('login');
});

Route::middleware(['auth'])
    ->prefix('recruiter')
    ->group(function () {
        Route::get('/dashboard', [RecruiterController::class, 'dashboard'])->name('recruiter.dashboard');
    });

Route::middleware(['auth'])
    ->prefix('talent')
    ->group(function () {
        Route::get('/dashboard', [TalentController::class, 'dashboard'])->name('talent.dashboard');
    });