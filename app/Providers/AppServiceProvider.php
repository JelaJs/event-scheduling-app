<?php

namespace App\Providers;

use App\Models\Bands;
use App\Models\Reservations;
use App\Models\Restaurants;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        Gate::define('edit-delete-reservation', function(User $user, Reservations $reservation) {
            return $reservation->customer_id == $user->id;
        });

        Gate::define('edit-delete-restaurant', function(User $user, Restaurants $restaurant) {
            return $restaurant->user_id == $user->id;
        });

        Gate::define('edit-delete-band', function(User $user, Bands $band) {
            return $band->user_id == $user->id;
        });
    }
}
