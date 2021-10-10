<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image360',
        'images',
        'status',
        'created_by'
    ];
}
