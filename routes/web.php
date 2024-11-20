<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\BidsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ===========================
// Public Routes
// ===========================
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication Routes
Route::get('/auth', function () {
    return auth()->check() ? redirect()->route('auth-dashboard') : view('userAuth.login');
})->name('auth-login');

Route::get('/auth/singup', function () {
    return view('userAuth.singup');
})->name('auth-signup');

Route::get('/services', [ServicesController::class, 'services_archive'])->name('services');
Route::get('/get-all-services', [ServicesController::class, 'get_services'])->name('get-all-services');
Route::get('/terms-and-conditions', fn() => view('terms'))->name('terms');
Route::get('/privacy-policy', fn() => view('privacy'))->name('privacy');
Route::get('/provider-profile/{id}', fn() => view('privacy'))->name('provider-profile');


// ===========================
// Authenticated Routes
// ===========================
Route::middleware(['auth'])->group(function () {

    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Dashboard
    Route::get('/auth/dashboard', function () {
        return view('dashboard');
    })->name('auth-dashboard');

    // Service Routes
    Route::prefix('auth/service')->name('auth-service-')->group(function () {
        Route::get('/create', [ServicesController::class, 'create'])->name('create');
        Route::post('/store', [ServicesController::class, 'store'])->name('store');
        Route::get('/list', fn() => view('user.service.list'))->name('list');
        Route::get('/edit/{id}', [ServicesController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ServicesController::class, 'update'])->name('update');
        Route::get('/wishlist', fn() => view('user.service.wishlist'))->name('wishlist');
    });

    // Bids Routes
    Route::prefix('auth/bid')->name('auth-bid-')->group(function () {
        Route::get('/list', fn() => view('user.bid.list'))->name('list');
    });

    // booking Routes
    Route::prefix('auth/booking')->name('auth-booking-')->group(function () {
        Route::get('/list', fn() => view('user.booking.index'))->name('list');
    });

    // accounts Routes
    Route::prefix('auth/account')->name('auth-account-')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::get('/messages', fn() => view('user.account.messages'))->name('messages');
        Route::get('/notifications', fn() => view('user.account.notifications'))->name('notifications');
        route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('update');
    });

    
    // Wishlist Routes
    Route::prefix('auth')->name('auth-')->group(function () {
        Route::post('/create-wishlist', [WishlistController::class, 'store'])->name('create-wishlist');
        Route::delete('/remove-wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('remove-wishlist');
    });

    // Bidding Routes
    Route::post('/create-bidding', [BidsController::class, 'localstore'])->name('create-bidding');
});


// ===========================
// Service Details Route
// ===========================
Route::get('service/{slug}', [ServicesController::class, 'show'])->name('service.details');

// ===========================
// Auth Routes (from Laravel Breeze or custom auth)
// ===========================
require __DIR__.'/auth.php';
