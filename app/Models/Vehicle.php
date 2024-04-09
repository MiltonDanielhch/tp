<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'photo',
        'class',
        'associate_id',
        'ruat',
        'brand',
        'motor',
        'year',
        'number_chassis',
        'number_plate',
        'crpva',
        'soat'
    ];
}
    