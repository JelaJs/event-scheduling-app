<?php

use App\Http\Controllers\BandController;
use App\Http\Controllers\BandManagerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantManagerController;
use App\Http\Middleware\BandManagerMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\RestaurantManagerMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants');
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'find'])->name('restaurants.single');
Route::get('/bands', [BandController::class, 'index'])->name('bands');
Route::get('/bands/{band}', [BandController::class, 'find'])->name('bands.single');


//RESTAURANT MANAGER
Route::controller(RestaurantManagerController::class)->middleware(['auth', RestaurantManagerMiddleware::class])->prefix('/manager/restaurant')->name('manager.restaurant.')->group(function() {

    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{restaurant}', 'edit')->name('edit')->can('edit-delete-restaurant', 'restaurant');
    Route::patch('/update/{restaurant}', 'update')->name('update')->can('edit-delete-restaurant', 'restaurant');
    Route::delete('/delete/{restaurant}', 'delete')->name('delete')->can('edit-delete-restaurant', 'restaurant');
    Route::get('/status/{reservation}/{status}', 'updateReservationStatus')->name('status');
    Route::patch('/replace/{image}', 'replace')->name('replace');
    Route::delete('/delete-image/{image}', 'deleteImage')->name('deleteImage');
    Route::post('/create-image/{restaurant}', 'addImage')->name('addImage');
});


//BAND MANAGER 
Route::controller(BandManagerController::class)->middleware(['auth', BandManagerMiddleware::class])->prefix('/manager/band')->name('manager.band.')->group(function() {

    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{band}', 'edit')->name('edit')->can('edit-delete-band', 'band');
    Route::patch('/update/{band}', 'update')->name('update')->can('edit-delete-band', 'band');
    Route::delete('/delete/{band}', 'delete')->name('delete')->can('edit-delete-band', 'band');
    Route::get('/status/{reservation}/{status}', 'updateReservationStatus')->name('status');
    Route::patch('/replace/{image}', 'replace')->name('replace');
    Route::delete('/delete-image/{image}', 'deleteImage')->name('deleteImage');
    Route::post('/create-image/{restaurant}', 'addImage')->name('addImage');
});

//CUSTOMER BOOKING
Route::controller(CustomerController::class)->middleware(['auth', CustomerMiddleware::class])->prefix('/customer')->name('customer.')->group(function() {

    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('edit/{reservation}', 'edit')->name('edit')->can('edit-delete-reservation', 'reservation');
    Route::patch('/update/{reservation}', 'update')->name('update')->can('edit-delete-reservation', 'reservation');
    Route::delete('/delete/{reservation}', 'delete')->name('delete')->can('edit-delete-reservation', 'reservation');
});

////////////////////////////////
//PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
