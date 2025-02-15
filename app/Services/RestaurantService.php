<?php

namespace App\Services;

use App\Models\Restaurants;
use Illuminate\Support\Facades\Auth;

class RestaurantService {

    public function checkIfUserAlreadyHaveRestaurant(): bool {

        return Restaurants::firstWhere('user_id', Auth::id()) ? true : false;
    }

    public function checkIfUserOwnsCurrentBandOrRestaurant($band_restaurant): bool {

        return $band_restaurant->user_id == Auth::id();
    }

    public function checkIfRestaurantOrBandReservationIsPending($reservationType): bool {

        return $reservationType === 'pending';
    }

    public function checkIfPassedStatusIsCorrect(string $status): bool {

        return $status === 'accepted' || $status === 'rejected';
    }

    public function checkIfUserOwnsImage($image): bool {

        return $image->user_id == Auth::id();
    }
}