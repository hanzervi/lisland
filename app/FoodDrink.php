<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodDrink extends Model
{
    protected $fillable = [
        'image',
        'name',
        'description',
        'category',
        'price',
        'status',
        'created_by'
    ];
}
