<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'address',
        'contact',
        'email',
        'status',
        'created_by'
    ];
}
