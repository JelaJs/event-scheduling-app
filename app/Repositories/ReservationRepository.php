<?php

namespace App\Repositories;

use App\Models\Reservations;
use Auth;

class ReservationRepository {

    private $reservationModel;
    public function __construct() {

        $this->reservationModel = new Reservations();
    }

    public function checkIfReservationExists($request) {

        return $this->reservationModel->firstWhere([
            ['customer_id', Auth::id()],
            ['reservation_date', $request->reservation_date]
        ]);
    }

    public function checkIfChangedReservationExists($request, $reservation) {

        if($reservation->restaurant_id !== $request->reservation_id || $reservation->band_id !== $request->band_id || $reservation->reservation_date !== $request->reservation_date) {

            return $this->reservationModel->firstWhere([
                ['customer_id', Auth::id()],
                ['reservation_date', $request->reservation_date]
            ]);
        }
    }

    public function checkIfRestaurantDateIsBusy($request) {

        return $this->reservationModel->firstWhere([
            ['restaurant_id', $request->restaurant_id],
            ['reservation_date', $request->reservation_date],
            ['restaurant_status', 'approved'] 
        ]);
    }

    public function checkIfBandDateIsBusy($request) {

        return $this->reservationModel->firstWhere([
            ['band_id', $request->band_id],
            ['reservation_date', $request->reservation_date],
            ['band_status', 'approved'] 
        ]);
    }

    public function checkIfStatusIsPending($reservation) {

       if($reservation->restaurant_status == 'pending' && $reservation->band_status == 'pending') return true;

       return false;
    }

    public function store($request) {

        $this->reservationModel->create([

            'restaurant_id' => $request->restaurant_id,
            'band_id' => $request->band_id,
            'customer_id' => Auth::id(),
            'reservation_date' => $request->reservation_date
        ]);
    }

    public function update($restaurant, $request) {

        $restaurant->update([

            'restaurant_id' => $request->restaurant_id,
            'band_id' => $request->band_id,
            'reservation_date' => $request->reservation_date
        ]);
    }
}