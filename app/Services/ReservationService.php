<?php

namespace App\Services;

use App\Models\Reservations;
use Illuminate\Support\Facades\Auth;

class ReservationService {

    public function deleteReservationIfExpired() {

        Reservations::where('reservation_date', '<', date('Y-m-d'))->delete();
    }
    
    /*public function checkIfUserOwnsReservation($reservation) {

        return $reservation->customer_id == Auth::id();
    }*/
}