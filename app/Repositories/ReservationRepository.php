<?php

namespace App\Repositories;

use App\Models\Reservations;
use Illuminate\Support\Facades\Auth;

class ReservationRepository {

    public function __construct(private Reservations $reservationModel) {

    }

    public function checkIfReservationExists($request) {

        $reservation = $this->reservationModel->firstWhere([
            ['customer_id', Auth::id()],
            ['reservation_date', $request->reservation_date]
        ]);

        return $reservation ? true : false;
    }

    public function checkIfChangedReservationExists($request, $reservation) {

        if($reservation->restaurant_id !== $request->reservation_id || $reservation->band_id !== $request->band_id || $reservation->reservation_date !== $request->reservation_date) {

            $resrvation = $this->reservationModel->firstWhere([
                ['customer_id', Auth::id()],
                ['reservation_date', $request->reservation_date]
            ]);

            return $resrvation ? true : false;
        }
    }

    public function checkIfRestaurantDateIsBusy($request) {

        $restaurantDate = $this->reservationModel->firstWhere([
            ['restaurant_id', $request->restaurant_id],
            ['reservation_date', $request->reservation_date],
            ['restaurant_status', 'approved'] 
        ]);

        return $restaurantDate ? true : false;
    }

    public function checkIfBandDateIsBusy($request) {

        $bandDate = $this->reservationModel->firstWhere([
            ['band_id', $request->band_id],
            ['reservation_date', $request->reservation_date],
            ['band_status', 'approved'] 
        ]);

        return $bandDate ? true : false;
    }

    public function checkIfStatusIsPending($reservation) {

       return $reservation->restaurant_status == 'pending' && $reservation->band_status == 'pending';

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