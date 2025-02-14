<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BandImages extends Model
{
    
    const TABLE = 'band_images';

    protected $table = self::TABLE;

    protected $fillable = [
        'bands_id',
        'image',
    ];
}
