<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantImages extends Model
{
    const TABLE = 'restaurant_images';

    protected $table = self::TABLE;

    protected $fillable = [
        'restaurants_id',
        'image',
    ];
    
}
