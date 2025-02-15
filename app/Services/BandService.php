<?php

namespace App\Services;

use App\Models\Bands;
use Illuminate\Support\Facades\Auth;

class BandService extends RestaurantService{

    public function checkIfUserAlreadyHaveBand(): bool {

        return Bands::firstWhere('user_id', Auth::id()) ? true : false;
    }
}