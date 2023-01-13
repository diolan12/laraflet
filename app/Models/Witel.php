<?php

namespace App\Models;

// use LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;

class Witel extends BaseModel
{
    protected $fillable = [
        'name',
        'location'
    ];
    protected $casts = [
        'location' => Point::class
    ];
}
