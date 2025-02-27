<?php

namespace App\Helper;

use App\ReservationStatus;

class Status {

    //Napomenuo si mi da je ova Helper funckija nepotrebna (kolko sam skontao na nju si mislio jer je jedina)
    //Sa njom ispisujem Constante unutar blade, prilikom if provera itd... Cini mi se da je ovako citljivije unutar blade pa bih ostavio
    public function pending(): string
    {
        return ReservationStatus::PENDING_STATUS->value;
    }

    public function approved(): string 
    {
        return ReservationStatus::APPROVED_STATUS->value;    
    }

    public function rejected(): string
    {
        return ReservationStatus::REJECTED_STATUS->value;
    }
}