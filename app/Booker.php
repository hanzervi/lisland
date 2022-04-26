<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booker extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'contact',
        'email'
    ];
}
