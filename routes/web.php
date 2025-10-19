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

// Note: removed duplicate closure routes for /buat and /kampanye so controller methods are used.