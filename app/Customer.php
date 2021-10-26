<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'sex',
        'contact_no',
        'email',
        'idcard',
        'created_by'
    ];
}
