<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');
Route::middleware(['auth'])->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->middleware(['auth'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/users', function (Request $request){
        return inertia('Users', ['users' => User::paginate(5)]);
    })->name('users');
});
Route::middleware('guest')->group(function () {
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
Route::inertia('/about', 'About')->name('about');

