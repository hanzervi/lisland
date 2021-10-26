<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'type',
        'customer_id',
        'room_id',
        'adults',
        'children',
        'infants',
        'add_person',
        'check_in',
        'check_out',
        'priceTotal',
        'status',
        'remarks',
        'created_by'
    ];
}
