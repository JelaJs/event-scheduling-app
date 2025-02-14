<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{  
    const TABLE = 'restaurants';
    protected $table = self::TABLE;

    protected $fillable = [
       'user_id',
       'name',
       'background_image',
       'image_1',
       'image_2',
       'image_3',
       'description',
       'instagram',
       'youtube',
       'phone_number',
       'address',
    ];

    public function reservations() {

        return $this->hasMany(Reservations::class, 'restaurant_id', 'id');
    }

    public function images() {

        return $this->hasMany(RestaurantImages::class, 'restaurants_id', 'id');
    }
}
