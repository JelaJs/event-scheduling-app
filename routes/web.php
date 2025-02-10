<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantManagerController;
use App\Http\Middleware\RestaurantManagerMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::middleware(['auth', RestaurantManagerMiddleware::class])->group(function() {

    Route::get('/manager/restaurant', [RestaurantManagerController::class, 'index'])->name('manager.restaurant.index');
    Route::post('/manager/restaurant/store', [RestaurantManagerController::class, 'store'])->name('manager.restaurant.store');
    Route::get('/manager/restaurant/edit/{restaurant}', [RestaurantManagerController::class, 'edit'])->name('manager.restaurant.edit');
    Route::patch('/manager/restaurant/update/{restaurant}', [RestaurantManagerController::class, 'update'])->name('manager.restaurant.update');
    Route::delete('/manager/restaurant/delete/{restaurant}', [RestaurantManagerController::class, 'delete'])->name('manager.restaurant.delete');
});
////////////////////////////////
//AUTH

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
