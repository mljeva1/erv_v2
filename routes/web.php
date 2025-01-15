<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

use App\Models\User;
Route::get('/users', function () {
    $users = User::all();
    return view('users.index', ['users' => $users]);
});

use App\Http\Controllers\UserController;
Route::resource('users', UserController::class);
