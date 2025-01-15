<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

use App\Http\Controllers\UserController;
Route::resource('users', UserController::class);
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
