<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;

// Authentication Routes
Route::get('/login', [GoogleAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [GoogleAuthController::class, 'login'])->name('login.post');
Route::get('/register', [GoogleAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [GoogleAuthController::class, 'register'])->name('register.post');
Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// Your existing routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/buat', function () {
    return view('buat');
})->name('buat');

Route::get('/donasi', function () {
    return view('donasi');
})->name('donasi');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/kampanye', function () {
    return view('kampanye');
})->name('kampanye');