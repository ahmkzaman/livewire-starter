<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

//public route
Route::get('/register', function () {
    return view('register');
})->name('register.form');
Route::post('/register', [UserController::class, 'createUser'])->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login.form');
Route::post('/login', [UserController::class, 'loginUser'])->name('login');

Route::post('/logout', [UserController::class, 'logoutUser'])->name('logout')->middleware('auth');

//protected route
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/test', function () {
    return view('test');
})->name('test')->middleware('admin');
