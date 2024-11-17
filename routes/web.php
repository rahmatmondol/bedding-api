<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\BidsController;
use App\Http\Controllers\WishlistController;
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
       
    });

    // Bids Routes
    Route::prefix('auth/bid')->name('auth-bid-')->group(function () {
        Route::get('/list', [BidsController::class, 'list'])->name('list');
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
