<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Models\Campaign;

// Authentication Routes
Route::get('/login', [GoogleAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [GoogleAuthController::class, 'login'])->name('login.post');
Route::get('/register', [GoogleAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [GoogleAuthController::class, 'register'])->name('register.post');
Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// Di routes/web.php
Route::get('/debug-user', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'google_id' => $user->google_id,
            'avatar_exists' => !empty($user->avatar),
            'avatar_url' => $user->avatar
        ]);
    }
    return response()->json(['error' => 'Not authenticated']);
});




// Campaign Routes
Route::get('/kampanye', [CampaignController::class, 'index'])->name('kampanye');
Route::get('/kampanye/{campaign}', [CampaignController::class, 'show'])->name('kampanye.show');

// Protected Campaign Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/buat', [CampaignController::class, 'create'])->name('buat');
    Route::post('/buat', [CampaignController::class, 'store'])->name('campaign.store');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    $popularCampaigns = Campaign::where('status', 'active')
        ->with('user')
        ->latest()
        ->take(3)
        ->get();

    return view('home', compact('popularCampaigns'));
})->name('home');


Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/donasi', function () {
    return view('donasi');
})->name('donasi');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

// ==============================================

use App\Http\Controllers\AdminController;

use App\Http\Controllers\FarmerController;

// Route untuk petani
Route::middleware(['auth'])->group(function () {
    Route::get('/petani/daftar', [FarmerController::class, 'create'])->name('petani.daftar');
    Route::post('/petani/daftar', [FarmerController::class, 'store'])->name('petani.store');
    Route::get('/petani/dashboard', [FarmerController::class, 'dashboard'])->name('petani.dashboard');
    Route::get('/petani/tanaman', [FarmerController::class, 'managePlants'])->name('petani.tanaman');
    Route::post('/petani/tanaman', [FarmerController::class, 'storePlant'])->name('petani.tanaman.store');
    Route::put('/petani/tanaman/{id}', [FarmerController::class, 'updatePlant'])->name('petani.tanaman.update');
    Route::delete('/petani/tanaman/{id}', [FarmerController::class, 'deletePlant'])->name('petani.tanaman.delete');
});

// Route admin (only accessible by users with role 'admin')
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/petani', [AdminController::class, 'manageFarmers'])->name('admin.petani');
    Route::post('/petani/{id}/approve', [AdminController::class, 'approveFarmer'])->name('admin.petani.approve');
    Route::post('/petani/{id}/reject', [AdminController::class, 'rejectFarmer'])->name('admin.petani.reject');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::post('/users/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('admin.users.toggle-status');
    Route::get('/kampanye', [AdminController::class, 'manageCampaigns'])->name('admin.kampanye');
});

// Route untuk relawan dan lokasi (placeholder)
Route::get('/relawan/daftar', function () {
    return view('relawan.daftar');
})->name('relawan.daftar');

Route::get('/lokasi/daftar', function () {
    return view('lokasi.daftar');
})->name('lokasi.daftar');

