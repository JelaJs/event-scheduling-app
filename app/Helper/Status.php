<?php

namespace App\Helper;

use App\Models\Reservations;

class Status {

    //Napomenuo si mi da je ova Helper funckija nepotrebna (kolko sam skontao na nju si mislio jer je jedina)
    //Sa njom ispisujem Constante unutar blade, prilikom if provera itd... Cini mi se da je ovako citljivije unutar blade pa bih ostavio
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