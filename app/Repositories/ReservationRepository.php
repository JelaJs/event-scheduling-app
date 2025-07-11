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

            $reservation = $this->reservationModel->firstWhere([
                ['customer_id', Auth::id()],
                ['reservation_date', $request->reservation_date],
                ['id', '!=', $reservation->id]
            ]);

            return $reservation ? true : false;
        }
    }

    public function checkIfRestaurantDateIsBusy($request) {

        $restaurantDate = $this->reservationModel->firstWhere([
            ['restaurant_id', $request->restaurant_id],
            ['reservation_date', $request->reservation_date],
            ['restaurant_status', Reservations::APPROVED_STATUS] 
        ]);

        return $restaurantDate ? true : false;
    }

    public function checkIfBandDateIsBusy($request) {

        $bandDate = $this->reservationModel->firstWhere([
            ['band_id', $request->band_id],
            ['reservation_date', $request->reservation_date],
            ['band_status', Reservations::APPROVED_STATUS] 
        ]);

        return $bandDate ? true : false;
    }

    public function checkIfStatusIsPending($reservation) {

       return $reservation->restaurant_status == Reservations::PENDING_STATUS && $reservation->band_status == Reservations::PENDING_STATUS;

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