<?php

namespace App\Models;

use MatanYadaev\EloquentSpatial\Objects\LineString;

class Fo extends BaseSpatialModel
{

    protected $fillable = [
        'name',
        'cable_line'
    ];
    protected $casts = [
        'cable_line' => LineString::class
    ];
}