<?php

namespace App\Helper;

use App\Models\Reservations;

class Status {

    public function pending(): string
    {
        return Reservations::getPendingStatus();
    }

    public function approved(): string 
    {
        return Reservations::getApprovedStatus();    
    }

    public function rejected(): string
    {
        return Reservations::getRejectedStatus();
    }
}