<?php

namespace App\Helper;

use App\ReservationStatus;

class ReservationHelper {

    public function checkIfPassedStatusIsCorrect(string $status): bool {

        return $status === ReservationStatus::APPROVED_STATUS->value || $status === ReservationStatus::REJECTED_STATUS->value;
    }
}