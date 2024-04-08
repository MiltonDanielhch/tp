<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'origin_id',
        'destination_id',
        'active',
    ];

    public $additional_attributes = ['full_route'];

    public function origin()
    {
        return $this->belongsTo(Location::class, 'origin_id');
    }

    public function destination()
    {
        return $this->belongsTo(Location::class, 'destination_id');
    }

    public function getFullRouteAttribute()
    {
        $origin = strtoupper($this->origin->municipality);
        $destination = strtoupper($this->destination->municipality);
        return "{$origin} - {$destination}";
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organization_route');
    }
}
