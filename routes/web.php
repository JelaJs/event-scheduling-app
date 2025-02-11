<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantManagerController;
use App\Http\Middleware\RestaurantManagerMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants');
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'find'])->name('restaurants.single');


//RESTAURANT MANAGER
Route::controller(RestaurantManagerController::class)->middleware(['auth', RestaurantManagerMiddleware::class])->prefix('/manager/restaurant')->name('manager.restaurant.')->group(function() {

    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{restaurant}', 'edit')->name('edit');
    Route::patch('/update/{restaurant}', 'update')->name('update');
    Route::delete('/delete/{restaurant}', 'delete')->name('delete');
});


//BAND MANAGER    //MOgu da dodam u modelima Cnst TABLE = naziv tab i onda u migrations Model::table i u protected $table mogu self::TABLE


////////////////////////////////
//PROFILE

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
