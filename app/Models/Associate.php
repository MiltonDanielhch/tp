<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associate extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'full_name',
        'ci',
        'expedition_ci',
        'created_at',
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
