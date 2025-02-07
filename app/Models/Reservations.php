<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $table = "reservations";

    protected $fillable = [
       'restaurant_id',
       'band_id',
       'customer_id',
       'reservation_date',
       'restaurant_status',
       'band_status'
    ];
}
