<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bands extends Model
{
    protected $table = "bands";

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
       'phone_number'
    ];
}
