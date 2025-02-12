<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    const TABLE = 'reservations';
    protected $table = self::TABLE;

    protected $fillable = [
       'restaurant_id',
       'band_id',
       'customer_id',
       'reservation_date',
       'restaurant_status',
       'band_status'
    ];

    public function user() {

       return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function restaurant() {

       return $this->hasOne(Restaurants::class, 'id', 'restaurants_id');
    }

    public function band() {

        return $this->hasOne(Bands::class, 'id', 'band_id');
    }
}
