<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @property Point $point
 * @method static SpatialBuilder query()
 */
class ConnectionBreakpoint extends Model
{
    use HasSpatial;
    protected $casts = [
        'point' => Point::class
    ];
}
