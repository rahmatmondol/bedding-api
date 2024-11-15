<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\BidsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// start route for frontend
route::get('/', function () {
    return view('home');
});

// user login route
route::get('/auth', function () {
    // check if user is logged in redirect to dashboard
    if(auth()->check()){
        return redirect()->route('auth-dashboard');
    }
    return view('auth.login');
})->name('auth-login');


route::get('/auth/singup', function () {
    return view('userAuth.singup');
})->name('auth-signup');

Route::get('service/{slug}', [ServicesController::class, 'show'])->name('service.details');



// start route for frontend
route::middleware('auth')->group(function () {
    //dashboard
    route::get('/auth/dashboard', function () {
        return view('dashboard');
    })->name('auth-dashboard');

    //service create
    route::get('/auth/service/create', [ServicesController::class, 'create'])->name('auth-service-create');
    route::post('/auth/service/store', [ServicesController::class, 'store'])->name('auth-service-store');

    //service edit
    route::get('/auth/service/edit/{id}', [ServicesController::class, 'edit'])->name('auth-service-edit');
    route::post('/auth/service/update/{id}', [ServicesController::class, 'update'])->name('auth-service-update');
       
    //service list
    route::get('/auth/services', [ServicesController::class, 'services'])->name('auth-services');

    // 

    //willing to work
    route::get('/auth/service/bids', function () {
        return view('user.service.bids');
    })->name('auth-service-bids');

    //completed
    route::get('/auth/service/completed', function () {
        return view('user.service.completed');
    })->name('auth-service-completed');

    //accept
    route::get('/auth/service/accept', function () {
        return view('user.service.accept');
    })->name('auth-service-accept');


    //service list for provider
    route::get('/auth/service/list', function () {
        return view('user.service.list');
    })->name('auth-service-list');

    Route::post('create-bidding', [BidsController::class, 'localstore'])->name('create-bidding');

});





require __DIR__.'/auth.php';
