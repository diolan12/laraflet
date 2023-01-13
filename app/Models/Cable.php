<?php

namespace App\Models;

use MatanYadaev\EloquentSpatial\SpatialBuilder;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use MatanYadaev\EloquentSpatial\Objects\MultiPoint;

/**
 * @property MultiPoint $line
 * @method static SpatialBuilder query()
 */
class Cable extends BaseModel
{
    use HasSpatial;
    public static function query(): SpatialBuilder
    {
        return parent::query();
    }
    protected $fillable = [
        'name',
        'line'
    ];
    protected $casts = [
        'line' => MultiPoint::class
    ];
}