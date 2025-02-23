<?php

namespace App\Helper;

use App\Models\Reservations;

class Status {

    public function pending(): string
    {
        return Reservations::PENDING_STATUS;
    }

    public function approved(): string 
    {
        return Reservations::APPROVED_STATUS;    
    }

    public function rejected(): string
    {
        return Reservations::REJECTED_STATUS;
    }
}