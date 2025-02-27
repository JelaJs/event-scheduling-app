<?php

namespace App\Services;

use App\Models\Reservations;
use App\Models\Restaurants;
use Illuminate\Support\Facades\Auth;

class RestaurantService {

    public function checkIfUserAlreadyHaveRestaurant(): bool {

        return (bool) Restaurants::firstWhere('user_id', Auth::id());
    }

    public function checkIfRestaurantOrBandReservationIsPending($reservationType): bool {

        return $reservationType === Reservations::PENDING_STATUS;
    }

    public function checkIfUserOwnsImage($image): bool {

        return $image->user_id == Auth::id();
    }
}