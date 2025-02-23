<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    const TABLE = 'reservations';

    const PENDING_STATUS = 'pending';
    const APPROVED_STATUS = 'approved';
    const REJECTED_STATUS = 'rejected';
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

       return $this->hasOne(Restaurants::class, 'id', 'restaurant_id');
    }

    public function band() {

        return $this->hasOne(Bands::class, 'id', 'band_id');
    }

    public static function getApprovedStatus() {
      return self::APPROVED_STATUS;
    }

    public static function getRejectedStatus() {
      return self::REJECTED_STATUS;
    }

    public static function getPendingStatus() {
      return self::PENDING_STATUS;
    }
}
