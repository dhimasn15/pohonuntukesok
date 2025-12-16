<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\UserProfilController;
use App\Http\User;
use App\Models\Campaign;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\Auth\SocialController;

// Authentication Routes
Route::get('/login', [GoogleAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [GoogleAuthController::class, 'login'])->name('login.post');
Route::get('/register', [GoogleAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [GoogleAuthController::class, 'register'])->name('register.post');
Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');

// Social OAuth (Google)
// Pastikan route names 'social.redirect' dan 'social.callback' tersedia
Route::get('auth/{provider}/redirect', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('auth/{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');

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

// routes/web.php
Route::get('/profil-user', [UserProfilController::class, 'show'])->name('profil-user');

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
    // Kelola relawan
    Route::get('/relawan', [AdminController::class, 'manageVolunteers'])->name('admin.relawan');
    Route::post('/relawan/{id}/approve', [AdminController::class, 'approveVolunteer'])->name('admin.relawan.approve');
    Route::post('/relawan/{id}/reject', [AdminController::class, 'rejectVolunteer'])->name('admin.relawan.reject');
});

// Route untuk relawan
Route::middleware(['auth'])->group(function () {
    Route::get('/relawan/daftar', [VolunteerController::class, 'create'])->name('relawan.daftar');
    Route::post('/relawan/daftar', [VolunteerController::class, 'store'])->name('relawan.store');
});

Route::get('/lokasi/daftar', function () {
    return view('lokasi.daftar');
})->name('lokasi.daftar');



use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserBlogController;
use App\Http\Controllers\Admin\AdminBlog as AdminBlogController;

// Public Blog Routes (untuk membaca)
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{category}', [BlogController::class, 'category'])->name('blog.category');

// User Blog Routes (untuk menulis - butuh login)
Route::middleware(['auth'])->group(function () {
    Route::get('/my-blog', [UserBlogController::class, 'index'])->name('user.blog.index');
    Route::get('/my-blog/create', [UserBlogController::class, 'create'])->name('user.blog.create');
    Route::post('/my-blog', [UserBlogController::class, 'store'])->name('user.blog.store');
    Route::get('/my-blog/{blog}/edit', [UserBlogController::class, 'edit'])->name('user.blog.edit');
    Route::put('/my-blog/{blog}', [UserBlogController::class, 'update'])->name('user.blog.update');
    Route::delete('/my-blog/{blog}', [UserBlogController::class, 'destroy'])->name('user.blog.destroy');
});

// Admin Blog Routes (untuk approval dan management)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/blog', [AdminBlogController::class, 'index'])->name('admin.blog.index');
    Route::get('/blog/pending', [AdminBlogController::class, 'pending'])->name('admin.blog.pending');
    Route::post('/blog/{blog}/approve', [AdminBlogController::class, 'approve'])->name('admin.blog.approve');
    Route::get('/blog/{blog}/reject', [AdminBlogController::class, 'showRejectForm'])->name('admin.blog.show-reject-form');
    Route::post('/blog/{blog}/reject', [AdminBlogController::class, 'reject'])->name('admin.blog.reject');
    
    // Management lainnya
    Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/blog', [AdminBlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/blog/{blog}/edit', [AdminBlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/blog/{blog}', [AdminBlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/blog/{blog}', [AdminBlogController::class, 'destroy'])->name('admin.blog.destroy');
    Route::post('/blog/{blog}/toggle-featured', [AdminBlogController::class, 'toggleFeatured'])->name('admin.blog.toggle-featured');
});

// CKEditor Upload Route
Route::post('/ckeditor/upload', [UserBlogController::class, 'uploadImage'])
    ->name('ckeditor.upload')
    ->middleware('auth');
// ============================================================================

// API Routes for Location Data
Route::get('/api/provinces', [\App\Http\Controllers\LocationApiController::class, 'getProvinces']);
Route::get('/api/regencies/{provinceId}', [\App\Http\Controllers\LocationApiController::class, 'getRegencies']);
Route::get('/api/districts/{regencyId}', [\App\Http\Controllers\LocationApiController::class, 'getDistricts']);
Route::get('/api/villages', [\App\Http\Controllers\LocationApiController::class, 'getVillages']);

// Payment & Donation Routes
Route::post('/donate', [\App\Http\Controllers\DonationController::class, 'createDonation'])->name('donate');
Route::get('/donation-success-check', [\App\Http\Controllers\DonationController::class, 'successCheck'])->name('donation.success-check');
Route::get('/my-donations', [\App\Http\Controllers\DonationController::class, 'myDonations'])->middleware('auth')->name('my.donations');
Route::get('/donation/{donationId}', [\App\Http\Controllers\DonationController::class, 'getDonation'])->name('donation.show');
Route::get('/donation/{donationId}/success', [\App\Http\Controllers\DonationController::class, 'showSuccess'])->name('donation.success');
Route::get('/donation/{donationId}/handle-success', [\App\Http\Controllers\DonationController::class, 'handleSuccess'])->name('donation.handle-success');
Route::get('/donation/{donationId}/status', [\App\Http\Controllers\DonationController::class, 'checkStatus'])->name('donation.status');
Route::get('/campaign/{campaignId}/donations', [\App\Http\Controllers\DonationController::class, 'getCampaignDonations'])->name('campaign.donations');

// API Routes for Campaign Data (Progress Updates)
Route::get('/api/campaigns/{campaignId}', [\App\Http\Controllers\CampaignController::class, 'getCampaignData'])->name('api.campaign.data');

// Xendit Webhook (no CSRF required)
Route::post('/xendit/webhook', [\App\Http\Controllers\XenditWebhookController::class, 'handle'])->withoutMiddleware('web');

