<?php

namespace App\Helper;

use App\Models\Reservations;

class ReservationHelper {

    public function checkIfPassedStatusIsCorrect(string $status): bool {

        return $status === Reservations::APPROVED_STATUS || $status === Reservations::REJECTED_STATUS;
    }
}