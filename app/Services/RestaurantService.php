<?php

namespace App\Services;

use App\Models\Restaurants;
use App\ReservationStatus;
use Illuminate\Support\Facades\Auth;

class RestaurantService {

    public function checkIfUserAlreadyHaveRestaurant(): bool {

        return (bool) Restaurants::firstWhere('user_id', Auth::id());
    }

    public function checkIfRestaurantOrBandReservationIsPending($reservationType): bool {

        return $reservationType === ReservationStatus::PENDING_STATUS->value;
    }

    public function checkIfUserOwnsImage($image): bool {

        return $image->user_id == Auth::id();
    }
}