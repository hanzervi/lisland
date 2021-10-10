<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'sex',
        'address',
        'idcard',
        'status',
        'created_by'
    ];
}
