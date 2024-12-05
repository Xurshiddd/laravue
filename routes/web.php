<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    sleep(1);
    return Inertia::render('Home');
})->name('home');
Route::inertia('/about', 'About', )->name('about');
Route::inertia('/register', 'Auth/Register', )->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::inertia('/login', 'Auth/Login', )->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

