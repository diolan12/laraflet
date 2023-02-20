<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\LineString;

class Hop extends Model
{
    use HasFactory;
    protected $casts = [
        'line' => LineString::class
    ];
}
