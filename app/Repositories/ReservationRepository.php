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

        $reservationExists = $this->reservationModel->firstWhere([
            ['customer_id', Auth::id()],
            ['reservation_date', $request->reservation_date]
        ]);

        return $reservationExists;
    }

    public function store($request) {

        $this->reservationModel->create([

            'restaurant_id' => $request->restaurant_id,
            'band_id' => $request->band_id,
            'customer_id' => Auth::id(),
            'reservation_date' => $request->reservation_date
        ]);
    }
}