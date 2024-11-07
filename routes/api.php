<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\ServicesController;


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
    Route::post('change-password', [AuthController::class, 'changePassword']);
});

// ===============================
// routes for guest
// ===============================


// get all category routes
Route::get('get-categories', [CategoriesController::class, 'index']);

// get single category routes
Route::get('get-category/{id}', [CategoriesController::class, 'show']);

// get subcategory routes
Route::get('get-subcategories', [SubCategoriesController::class, 'index']);

// get single subcategory routes
Route::get('get-subcategory/{id}', [SubCategoriesController::class, 'show']);

// get service routes
Route::get('get-services', [ServicesController::class, 'index']);

// get single service routes
Route::get('get-service/{id}', [ServicesController::class, 'show']);


// ===============================
// routes for authenticated
// ===============================
Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function () {

    // set location
    Route::post('set-location', [AuthController::class, 'setLocation']);

    // create category routes
    Route::post('create-category', [CategoriesController::class, 'store']);

    // update category routes
    Route::put('update-category/{id}', [CategoriesController::class, 'update']);

    // delete category routes
    Route::delete('delete-category/{id}', [CategoriesController::class, 'destroy']);

    // create service routes
    Route::post('create-service', [ServicesController::class, 'store']);

});