<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\BidsController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewsController;

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});

// ===============================
// routes for guest
// ===============================


// get all category routes
Route::get('get-categories', [CategoriesController::class, 'index'])->name('get-categories');

// get single category routes
Route::get('get-category/{id}', [CategoriesController::class, 'show']);

// get subcategory routes
Route::get('get-subcategories', [SubCategoriesController::class, 'index'])->name('get-subcategories');

// get single subcategory routes
Route::get('get-subcategory/{id}', [SubCategoriesController::class, 'show']);

// get service routes
Route::get('get-services', [ServicesController::class, 'index'])->name('get-services');

// get single service routes
Route::get('get-service/{id}', [ServicesController::class, 'showSingle']);


// ===============================
// routes for authenticated
// ===============================
Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function () {

    // update profile routes
    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    // password update routes
    Route::post('change-password', [AuthController::class, 'changePassword']);


    // create category routes
    Route::post('create-category', [CategoriesController::class, 'store']);

    // update category routes
    Route::put('update-category/{id}', [CategoriesController::class, 'update']);

    // delete category routes
    Route::delete('delete-category/{id}', [CategoriesController::class, 'destroy']);

    // create service routes
    Route::post('create-service', [ServicesController::class, 'store']);


    // bidding routes
    Route::get('get-biddings', [BidsController::class, 'index']);
    Route::get('get-bidding/{id}', [BidsController::class, 'show']);
    Route::get('get-bidding-info', [BidsController::class, 'info']);
    Route::post('create-bidding', [BidsController::class, 'store'])->name('create-bidding');
    Route::put('update-bidding/{id}', [BidsController::class, 'update']);
    Route::delete('delete-bidding/{id}', [BidsController::class, 'destroy']);

    //booking routes
    Route::get('get-bookings', [BookingsController::class, 'index']);
    Route::get('get-booking/{id}', [BookingsController::class, 'show']);
    Route::post('create-booking', [BookingsController::class, 'store']);
    Route::post('update-booking/{booking}', [BookingsController::class, 'update']);
    Route::delete('delete-booking/{id}', [BookingsController::class, 'destroy']);

    // wishlist routes
    Route::get('get-wishlists', [WishlistController::class, 'index']);
    Route::post('create-wishlist', [WishlistController::class, 'store']);
    Route::delete('delete-wishlist/{wishlist}', [WishlistController::class, 'destroy']);

    // review routes
    Route::get('get-reviews', [ReviewsController::class, 'index']);
    Route::post('create-review', [ReviewsController::class, 'store']);

});
