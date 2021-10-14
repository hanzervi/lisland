<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'description',
        'images',
        'image360',
        'no_rooms',
        'price_wd',
        'price_we',
        'adults',
        'children',
        'infants',
        'includes',
        'status',
        'created_by'
    ];
}
