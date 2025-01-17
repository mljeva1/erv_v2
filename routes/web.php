<?php

use Illuminate\Support\Facades\Route;

use App\Models\Task;
use App\Models\User;
Route::get('/', function () {
    $totalTasks = Task::count();
    $totalUsers = User::count();
    return view('home.index', compact('totalTasks','totalUsers'));
})->name('home');

use App\Http\Controllers\UserController;
Route::resource('users', UserController::class);
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

use App\Http\Controllers\CompanyProfileController;
Route::resource('company_profiles', CompanyProfileController::class);

use App\Http\Controllers\SectionRoomController;
use App\Http\Controllers\RoleController;
Route::resource('sections', SectionRoomController::class)->only(['create', 'store', 'destroy']);
Route::resource('roles', RoleController::class);
Route::get('/settings', [SectionRoomController::class, 'index'])->name('settings.index');
Route::post('/sections', [SectionRoomController::class, 'store'])->name('sections.store');
Route::delete('/sections/{section}', [SectionRoomController::class, 'destroy'])->name('sections.destroy');

use App\Http\Controllers\TaskController;
Route::resource('tasks', TaskController::class);
Route::post('/tasks/{task}/assign-users', [TaskController::class, 'assignUsers'])->name('tasks.assignUsers');