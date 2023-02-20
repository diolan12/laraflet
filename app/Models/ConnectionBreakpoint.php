<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;

class ConnectionBreakpoint extends Model
{
    use HasFactory;
    protected $casts = [
        'point' => Point::class
    ];
}
