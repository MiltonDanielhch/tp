<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'province',
        'municipality',
        'active',
    ];
    public $additional_attributes = ['full_location'];
    public function getFullLocationAttribute()
    {
        $location = strtoupper($this->municipality);
        return "PROVINCIA: {$this->province} - LOCALIDAD: {$location}";
    }
}
