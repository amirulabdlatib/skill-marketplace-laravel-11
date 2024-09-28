<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/',function(){
    return view('landing');
});

Route::get('/login',[AuthController::class,'getLoginPage'])->name('login.page');
Route::get('/register',[AuthController::class,'getRegisterPage'])->name('register.page');