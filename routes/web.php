<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->middleware(['auth'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::middleware('guest')->group(function () {
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
Route::inertia('/about', 'About')->name('about');

