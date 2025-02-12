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
    Route::post('register', [AuthController::class, 'register']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});

// ===============================
// routes for guest
// ===============================

// get country routes
Route::get('get-countries', [AuthController::class, 'getCountry']);

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
Route::get('get-auctions', [ServicesController::class, 'get_auctions'])->name('get-auctions');

Route::get('get-auction/{id}', [ServicesController::class, 'singleAuction']);

// get single service routes
Route::get('get-service/{id}', [ServicesController::class, 'showSingle']);


// ===============================
// routes for authenticated
// ===============================
Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function () {

    // get my service routes
    Route::get('get-my-services', [ServicesController::class, 'my_services']);
    Route::get('get-my-auctions', [ServicesController::class, 'my_auctions']);
    Route::get('get-my-service/{id}', [ServicesController::class, 'my_service']);
    Route::get('get-my-auction/{id}', [ServicesController::class, 'my_auction']);

    // update profile routes
    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    // get user information
    Route::get('get-firebase', [AuthController::class, 'getFirebase']);
    Route::get('me', [AuthController::class, 'me']);

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
    Route::get('get-auction-biddings', [BidsController::class, 'auctionBids']);
    Route::get('get-bidding/{id}', [BidsController::class, 'show']);
    Route::get('get-bidding-info', [BidsController::class, 'info']);
    Route::post('create-bidding', [BidsController::class, 'store'])->name('create-bidding');
    Route::post('create-auction-bidding', [BidsController::class, 'auctionStore']);
    Route::get('get-my-auction-bidding', [BidsController::class, 'myAuctionBids']);
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

    // notification routes
    route::get('get-notifications', [AuthController::class, 'getNotifications']);
    route::get('get-unread-notifications', [AuthController::class, 'getUnreadNotifications']);
    route::get('get-read-notifications', [AuthController::class, 'getReadNotifications']);
    route::get('get-notification/{id}', [AuthController::class, 'getNotification']);
    route::get('read-notification/{id}', [AuthController::class, 'markNotificationAsRead']);

});
