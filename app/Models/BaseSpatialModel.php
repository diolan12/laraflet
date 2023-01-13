<?php

namespace App\Models;


use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

/**
 * @property MultiPoint $line
 * @method static SpatialBuilder query()
 */
class BaseSpatialModel extends BaseModel
{
    use HasSpatial;

    public static function query(): SpatialBuilder
    {
        return parent::query();
    }
}