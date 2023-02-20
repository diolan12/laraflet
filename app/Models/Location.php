<?php

namespace App\Models;

use MatanYadaev\EloquentSpatial\Objects\Point;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'abbreviation',
        'type',
        'point'
    ];
    protected $casts = [
        'point' => Point::class
    ];

    // function connection() {
    //     return $this->hasOne('App\\Models\\Connection');
    // }
}
